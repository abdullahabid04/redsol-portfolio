<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects.
     */
    public function index(Request $request)
    {
        $query = Project::query();

        // ── Filters ──────────────────────────────────────────
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('client_name', 'like', "%{$search}%")
                    ->orWhere('summary', 'like', "%{$search}%")
                    ->orWhere('client_city', 'like', "%{$search}%");
            });
        }

        if ($type = $request->get('type')) {
            $query->ofType($type);
        }

        if ($status = $request->get('status')) {
            $query->where('is_active', $status === 'active');
        }

        // ── Pagination ───────────────────────────────────────
        $projects = $query
            ->ordered()
            ->paginate(15)
            ->withQueryString();

        // ── Summary counts ───────────────────────────────────
        $stats = [
            'total' => Project::count(),
            'active' => Project::active()->count(),
            'featured' => Project::featured()->count(),
        ];

        return view('admin.pages.projects.index', compact('projects', 'stats'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        return view('admin.pages.projects.form', [
            'project' => new Project(),
            'isEdit' => false,
        ]);
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:200'],
            'slug' => ['required', 'string', 'alpha_dash', 'max:200', 'unique:projects,slug'],
            'summary' => ['required', 'string', 'min:20', 'max:1000'],
            'description' => ['nullable', 'string', 'max:5000'],

            'client_name' => ['required', 'string', 'min:2', 'max:200'],
            'client_city' => ['nullable', 'string', 'max:100'],
            'client_province' => ['nullable', 'string', 'max:100'],
            'client_type' => ['required', Rule::in(array_keys(Project::CLIENT_TYPES))],

            'testimonial_id' => ['nullable', 'integer', 'exists:testimonials,id'],
            'start_date' => ['nullable', 'date'],
            'completion_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'duration_months' => ['nullable', 'integer', 'min:0', 'max:120'],

            'modules_deployed' => ['nullable', 'array'],
            'services_provided' => ['nullable', 'array'],
            'outcomes' => ['nullable', 'array'],
            'stat_keys' => ['nullable', 'array'],
            'stat_values' => ['nullable', 'array'],

            'featured_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'featured_image_alt' => ['nullable', 'string', 'max:200'],

            'meta_title' => ['nullable', 'string', 'max:70'],
            'meta_description' => ['nullable', 'string', 'max:165'],

            'is_active' => ['boolean'],
            'is_featured' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],
        ], [
            'title.required' => 'Project title is required.',
            'slug.unique' => 'This slug is already in use.',
            'summary.required' => 'Project summary is required.',
            'client_name.required' => 'Client/Hospital name is required.',
            'client_type.required' => 'Please select an organisation type.',
            'completion_date.after_or_equal' => 'Completion date cannot be before start date.',
            'featured_image.image' => 'Featured image must be a valid image file.',
            'featured_image.max' => 'Image cannot exceed 2MB.',
        ]);

        try {
            // ── Handle featured image upload ─────────────────
            if ($request->hasFile('featured_image')) {
                $validated['featured_image'] = $request->file('featured_image')->store('projects', 'public');
            }

            // ── Merge stat_keys + stat_values into stats array ─
            $stats = [];
            if ($request->filled('stat_keys') && $request->filled('stat_values')) {
                foreach ($request->stat_keys as $i => $key) {
                    $key = trim($key);
                    $val = trim($request->stat_values[$i] ?? '');
                    if ($key !== '' && $val !== '') {
                        $stats[$key] = $val;
                    }
                }
            }
            $validated['stats'] = $stats;

            // ── Clean up empty array values ──────────────────
            $validated['modules_deployed'] = array_filter(array_map('trim', $validated['modules_deployed'] ?? []));
            $validated['services_provided'] = array_filter(array_map('trim', $validated['services_provided'] ?? []));
            $validated['outcomes'] = array_filter(array_map('trim', $validated['outcomes'] ?? []));

            // ── Defaults ─────────────────────────────────────
            $validated['is_active'] = $validated['is_active'] ?? true;
            $validated['is_featured'] = $validated['is_featured'] ?? false;
            $validated['sort_order'] = $validated['sort_order'] ?? (Project::max('sort_order') ?? 0) + 1;

            // ── Create ───────────────────────────────────────
            Project::create($validated);

            return redirect()
                ->route('admin.projects.index')
                ->with('success', 'Project created successfully.');

        } catch (\Illuminate\Database\QueryException $e) {
            if (Str::contains($e->getMessage(), ['Duplicate entry', 'unique'])) {
                return back()->withInput()->withErrors(['slug' => 'This slug is already in use.']);
            }
            throw $e;
        } catch (\Exception $e) {
            if (isset($validated['featured_image']) && Storage::disk('public')->exists($validated['featured_image'])) {
                Storage::disk('public')->delete($validated['featured_image']);
            }
            \Log::error('Project store failed: ' . $e->getMessage(), [
                'request' => $request->except('featured_image'),
                'trace' => $e->getTraceAsString(),
            ]);
            return back()->withInput()->with('error', 'Failed to create project. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);

        return view('admin.pages.projects.form', [
            'project' => $project,
            'isEdit' => true,
        ]);
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'min:5', 'max:200'],
            'slug' => ['required', 'string', 'alpha_dash', 'max:200', 'unique:projects,slug,' . $project->id],
            'summary' => ['required', 'string', 'min:20', 'max:1000'],
            'description' => ['nullable', 'string', 'max:5000'],

            'client_name' => ['required', 'string', 'min:2', 'max:200'],
            'client_city' => ['nullable', 'string', 'max:100'],
            'client_province' => ['nullable', 'string', 'max:100'],
            'client_type' => ['required', Rule::in(array_keys(Project::CLIENT_TYPES))],

            'testimonial_id' => ['nullable', 'integer', 'exists:testimonials,id'],
            'start_date' => ['nullable', 'date'],
            'completion_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'duration_months' => ['nullable', 'integer', 'min:0', 'max:120'],

            'modules_deployed' => ['nullable', 'array'],
            'services_provided' => ['nullable', 'array'],
            'outcomes' => ['nullable', 'array'],
            'stat_keys' => ['nullable', 'array'],
            'stat_values' => ['nullable', 'array'],

            'featured_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'featured_image_alt' => ['nullable', 'string', 'max:200'],

            'meta_title' => ['nullable', 'string', 'max:70'],
            'meta_description' => ['nullable', 'string', 'max:165'],

            'is_active' => ['boolean'],
            'is_featured' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],
        ], [
            'title.required' => 'Project title is required.',
            'slug.unique' => 'This slug is already in use.',
            'summary.required' => 'Project summary is required.',
            'client_name.required' => 'Client/Hospital name is required.',
            'client_type.required' => 'Please select an organisation type.',
            'completion_date.after_or_equal' => 'Completion date cannot be before start date.',
            'featured_image.image' => 'Featured image must be a valid image file.',
            'featured_image.max' => 'Image cannot exceed 2MB.',
        ]);

        try {
            // ── Handle featured image replacement ────────────
            if ($request->hasFile('featured_image')) {
                if ($project->featured_image && Storage::disk('public')->exists($project->featured_image)) {
                    Storage::disk('public')->delete($project->featured_image);
                }
                $validated['featured_image'] = $request->file('featured_image')->store('projects', 'public');
            }

            // ── Merge stat_keys + stat_values ────────────────
            $stats = [];
            if ($request->filled('stat_keys') && $request->filled('stat_values')) {
                foreach ($request->stat_keys as $i => $key) {
                    $key = trim($key);
                    $val = trim($request->stat_values[$i] ?? '');
                    if ($key !== '' && $val !== '') {
                        $stats[$key] = $val;
                    }
                }
            }
            $validated['stats'] = $stats;

            // ── Clean up empty arrays ────────────────────────
            $validated['modules_deployed'] = array_filter(array_map('trim', $validated['modules_deployed'] ?? []));
            $validated['services_provided'] = array_filter(array_map('trim', $validated['services_provided'] ?? []));
            $validated['outcomes'] = array_filter(array_map('trim', $validated['outcomes'] ?? []));

            // ── Update ───────────────────────────────────────
            $project->update($validated);

            return redirect()
                ->route('admin.projects.index')
                ->with('success', 'Project updated successfully.');

        } catch (\Illuminate\Database\QueryException $e) {
            if (Str::contains($e->getMessage(), ['Duplicate entry', 'unique'])) {
                return back()->withInput()->withErrors(['slug' => 'This slug is already in use.']);
            }
            throw $e;
        } catch (\Exception $e) {
            if (isset($validated['featured_image']) && Storage::disk('public')->exists($validated['featured_image'])) {
                Storage::disk('public')->delete($validated['featured_image']);
            }
            \Log::error("Project update failed for ID {$id}: " . $e->getMessage(), [
                'request' => $request->except('featured_image'),
                'trace' => $e->getTraceAsString(),
            ]);
            return back()->withInput()->with('error', 'Failed to update project. Please try again.');
        }
    }

    /**
     * Toggle active status for a project.
     */
    public function toggle(string $id)
    {
        try {
            $project = Project::findOrFail($id);
            $project->toggle();

            $status = $project->is_active ? 'activated' : 'deactivated';
            return redirect()->back()->with('success', "Project {$status}.");
        } catch (\Exception $e) {
            \Log::error("Project toggle failed for ID {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update project status.');
        }
    }

    /**
     * Toggle featured status for a project.
     */
    public function toggleFeatured(string $id)
    {
        try {
            $project = Project::findOrFail($id);
            $project->toggleFeatured();

            $status = $project->is_featured ? 'featured' : 'unfeatured';
            return redirect()->back()->with('success', "Project marked as {$status}.");
        } catch (\Exception $e) {
            \Log::error("Project featured toggle failed for ID {$id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update featured status.');
        }
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(string $id)
    {
        try {
            $project = Project::findOrFail($id);

            // ── Delete featured image if exists ──────────────
            if ($project->featured_image && Storage::disk('public')->exists($project->featured_image)) {
                Storage::disk('public')->delete($project->featured_image);
            }

            $title = $project->title;
            $project->delete();

            return redirect()
                ->route('admin.projects.index')
                ->with('success', "Project \"{$title}\" deleted successfully.");

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.projects.index')->with('error', 'Project not found.');
        } catch (\Exception $e) {
            \Log::error("Project deletion failed for ID {$id}: " . $e->getMessage());
            return redirect()->route('admin.projects.index')->with('error', 'Failed to delete project. Please try again.');
        }
    }
}