<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('tagline', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($tag = $request->get('tag')) {
            $query->where('tag', $tag);
        }

        if ($status = $request->get('status')) {
            $query->where('is_active', $status === 'active');
        }

        $services = $query
            ->ordered()
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'total' => Service::count(),
            'active' => Service::active()->count(),
            'featured' => Service::featured()->count(),
            'inactive' => Service::where('is_active', false)->count(),
        ];

        // Tag breakdown for stats pills
        $tagCounts = Service::selectRaw('tag, count(*) as total')
            ->groupBy('tag')
            ->pluck('total', 'tag');

        return view('admin.pages.services.index', compact('services', 'stats', 'tagCounts'));
    }
    public function create()
    {
        return view('admin.pages.services.form', [
            'service' => new Service(),
            'isEdit' => false,
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Identity
            'name' => ['required', 'string', 'min:3', 'max:120'],
            'slug' => ['required', 'string', 'alpha_dash', 'max:120', 'unique:services,slug'],
            'tagline' => ['required', 'string', 'min:10', 'max:160'],
            'icon' => ['nullable', 'string', 'max:20'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],

            // Content
            'description' => ['required', 'string', 'min:50', 'max:2000'],
            'features' => ['nullable', 'array', 'max:15'],
            'features.*' => ['nullable', 'string', 'max:200'],

            // Tagging
            'tag' => ['required', Rule::in(Service::TAGS)],

            // URL & SEO
            'href' => ['nullable', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:70'],
            'meta_description' => ['nullable', 'string', 'max:165'],

            // Status
            'is_active' => ['boolean'],
            'is_featured' => ['boolean'],
        ], [
            'name.required' => 'Service name is required.',
            'name.min' => 'Name must be at least 3 characters.',
            'slug.required' => 'Slug is required.',
            'slug.unique' => 'This slug is already in use.',
            'slug.alpha_dash' => 'Slug can only contain letters, numbers, dashes and underscores.',
            'tagline.required' => 'Tagline is required.',
            'tagline.min' => 'Tagline must be at least 10 characters.',
            'description.required' => 'Description is required.',
            'description.min' => 'Description must be at least 50 characters.',
            'tag.required' => 'Please select a service tag.',
            'tag.in' => 'Invalid tag selected.',
        ]);

        try {
            if (empty($validated['slug'])) {
                $validated['slug'] = Str::slug($validated['name']);
            }

            if (empty($validated['href'])) {
                $validated['href'] = '/services/' . $validated['slug'];
            }

            $validated['is_active'] = $validated['is_active'] ?? true;
            $validated['is_featured'] = $validated['is_featured'] ?? false;
            $validated['sort_order'] = $validated['sort_order'] ?? (Service::max('sort_order') ?? 0) + 1;

            if (isset($validated['features']) && is_array($validated['features'])) {
                $validated['features'] = array_filter(array_map('trim', $validated['features']));
            }

            Service::create($validated);

            return redirect()
                ->route('admin.services.index')
                ->with('success', 'Service created successfully.');

        } catch (\Illuminate\Database\QueryException $e) {
            // Handle unique constraint violations (slug)
            if (Str::contains($e->getMessage(), ['Duplicate entry', 'unique'])) {
                return back()
                    ->withInput()
                    ->withErrors(['slug' => 'This slug is already in use. Please try a different one.']);
            }
            throw $e;
        } catch (\Exception $e) {
            \Log::error('Service store failed: ' . $e->getMessage(), [
                'request' => $request->all(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Failed to create service. Please try again.');
        }
    }
    public function edit(string $id)
    {
        $service = Service::findOrFail($id);

        return view('admin.pages.services.form', [
            'service' => $service,
            'isEdit' => true,
        ]);
    }
    public function update(Request $request, string $id)
    {
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            // Identity
            'name' => ['required', 'string', 'min:3', 'max:120'],
            'slug' => ['required', 'string', 'alpha_dash', 'max:120', 'unique:services,slug,' . $service->id],
            'tagline' => ['required', 'string', 'min:10', 'max:160'],
            'icon' => ['nullable', 'string', 'max:20'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],

            // Content
            'description' => ['required', 'string', 'min:50', 'max:2000'],
            'features' => ['nullable', 'array', 'max:15'],
            'features.*' => ['nullable', 'string', 'max:200'],

            // Tagging
            'tag' => ['required', Rule::in(Service::TAGS)],

            // URL & SEO
            'href' => ['nullable', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:70'],
            'meta_description' => ['nullable', 'string', 'max:165'],

            // Status
            'is_active' => ['boolean'],
            'is_featured' => ['boolean'],
        ], [
            'name.required' => 'Service name is required.',
            'slug.required' => 'Slug is required.',
            'slug.unique' => 'This slug is already in use.',
            'slug.alpha_dash' => 'Slug can only contain letters, numbers, dashes and underscores.',
            'tagline.required' => 'Tagline is required.',
            'description.required' => 'Description is required.',
            'tag.required' => 'Please select a service tag.',
        ]);

        try {
            if (empty($validated['slug'])) {
                $validated['slug'] = Str::slug($validated['name']);
            }

            if (empty($validated['href'])) {
                $validated['href'] = '/services/' . $validated['slug'];
            }

            if (isset($validated['features']) && is_array($validated['features'])) {
                $validated['features'] = array_filter(array_map('trim', $validated['features']));
            }

            $service->update($validated);

            return redirect()
                ->route('admin.services.index')
                ->with('success', 'Service updated successfully.');

        } catch (\Illuminate\Database\QueryException $e) {
            if (Str::contains($e->getMessage(), ['Duplicate entry', 'unique'])) {
                return back()
                    ->withInput()
                    ->withErrors(['slug' => 'This slug is already in use. Please try a different one.']);
            }
            throw $e;
        } catch (\Exception $e) {
            \Log::error("Service update failed for ID {$id}: " . $e->getMessage(), [
                'request' => $request->all(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Failed to update service. Please try again.');
        }
    }
    public function toggle(string $id)
    {
        try {
            $service = Service::findOrFail($id);
            $service->toggle();

            $status = $service->is_active ? 'activated' : 'deactivated';
            return redirect()
                ->back()
                ->with('success', "Service {$status}.");

        } catch (\Exception $e) {
            \Log::error("Service toggle failed for ID {$id}: " . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Failed to update service status.');
        }
    }
    public function toggleFeatured(string $id)
    {
        try {
            $service = Service::findOrFail($id);
            $service->update(['is_featured' => !$service->is_featured]);

            $status = $service->is_featured ? 'featured' : 'unfeatured';
            return redirect()
                ->back()
                ->with('success', "Service marked as {$status}.");

        } catch (\Exception $e) {
            \Log::error("Service featured toggle failed for ID {$id}: " . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Failed to update featured status.');
        }
    }
    public function destroy(string $id)
    {
        try {
            $service = Service::findOrFail($id);
            $name = $service->name;
            $service->delete();

            return redirect()
                ->route('admin.services.index')
                ->with('success', "Service \"{$name}\" deleted successfully.");

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()
                ->route('admin.services.index')
                ->with('error', 'Service not found.');
        } catch (\Exception $e) {
            \Log::error("Service deletion failed for ID {$id}: " . $e->getMessage());
            return redirect()
                ->route('admin.services.index')
                ->with('error', 'Failed to delete service. Please try again.');
        }
    }
}