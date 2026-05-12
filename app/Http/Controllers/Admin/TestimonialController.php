<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TestimonialController extends Controller
{
    /**
     * Display a listing of testimonials.
     */
    public function index(Request $request)
    {
        $query = Testimonial::query();

        // ── Filters ──────────────────────────────────────────
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('author_name', 'like', "%{$search}%")
                    ->orWhere('author_role', 'like', "%{$search}%")
                    ->orWhere('hospital', 'like', "%{$search}%")
                    ->orWhere('quote', 'like', "%{$search}%");
            });
        }

        if ($request->get('status') === 'active') {
            $query->where('is_active', true);
        } elseif ($request->get('status') === 'inactive') {
            $query->where('is_active', false);
        }

        if ($request->get('featured') === 'yes') {
            $query->where('is_featured', true);
        }

        // ── Pagination ───────────────────────────────────────
        $testimonials = $query
            ->ordered()
            ->paginate(15)
            ->withQueryString();

        // ── Summary counts ───────────────────────────────────
        $stats = [
            'total' => Testimonial::count(),
            'active' => Testimonial::active()->count(),
            'featured' => Testimonial::featured()->count(),
        ];

        return view('admin.pages.testimonials.index', compact('testimonials', 'stats'));
    }

    /**
     * Show the form for creating a new testimonial.
     */
    public function create()
    {
        return view('admin.pages.testimonials.form', [
            'testimonial' => new Testimonial(),
            'isEdit' => false,
        ]);
    }

    /**
     * Store a newly created testimonial in storage.
     */
    public function store(Request $request)
    {


        $validated = $request->validate([
            'quote' => ['required', 'string', 'min:20', 'max:500'],
            'author_name' => ['required', 'string', 'min:2', 'max:100'],
            'author_role' => ['nullable', 'string', 'max:100'],
            'hospital' => ['nullable', 'string', 'max:150'],
            'author_initials' => ['nullable', 'string', 'max:5'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'avatar_gradient' => ['nullable', 'string', 'max:50'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'is_active' => ['boolean'],
            'is_featured' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],
        ], [
            'quote.required' => 'The testimonial quote is required.',
            'quote.min' => 'Quote must be at least 20 characters.',
            'author_name.required' => 'Author name is required.',
            'rating.required' => 'Please select a star rating.',
            'photo.image' => 'Photo must be a valid image file.',
            'photo.max' => 'Photo cannot exceed 2MB.',
        ]);

        try {
            // ── Handle photo upload ─────────────────────────
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('testimonials', 'public');
                $validated['photo'] = $path;
            }

            // ── Auto-generate initials if not provided ─────
            if (empty($validated['author_initials']) && !empty($validated['author_name'])) {
                $validated['author_initials'] = $this->generateInitials($validated['author_name']);
            }

            // ── Default values ─────────────────────────────
            $validated['is_active'] = $validated['is_active'] ?? true;
            $validated['is_featured'] = $validated['is_featured'] ?? false;
            $validated['sort_order'] = $validated['sort_order'] ?? Testimonial::max('sort_order') + 1;

            // ── Create ─────────────────────────────────────
            Testimonial::create($validated);

            return redirect()
                ->route('admin.testimonials.index')
                ->with('success', 'Testimonial created successfully.');

        } catch (\Exception $e) {
            // ── Rollback photo if DB insert fails ─────────
            if (isset($validated['photo']) && Storage::disk('public')->exists($validated['photo'])) {
                Storage::disk('public')->delete($validated['photo']);
            }

            \Log::error('Testimonial store failed: ' . $e->getMessage(), [
                'request' => $request->except('photo'),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Failed to create testimonial. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified testimonial.
     */
    public function edit(string $id)
    {


        $testimonial = Testimonial::findOrFail($id);

        return view('admin.pages.testimonials.form', [
            'testimonial' => $testimonial,
            'isEdit' => true,
        ]);
    }

    /**
     * Update the specified testimonial in storage.
     */
    public function update(Request $request, string $id)
    {


        $testimonial = Testimonial::findOrFail($id);

        $validated = $request->validate([
            'quote' => ['required', 'string', 'min:20', 'max:500'],
            'author_name' => ['required', 'string', 'min:2', 'max:100'],
            'author_role' => ['nullable', 'string', 'max:100'],
            'hospital' => ['nullable', 'string', 'max:150'],
            'author_initials' => ['nullable', 'string', 'max:5'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'avatar_gradient' => ['nullable', 'string', 'max:50'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'is_active' => ['boolean'],
            'is_featured' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],
        ], [
            'quote.required' => 'The testimonial quote is required.',
            'quote.min' => 'Quote must be at least 20 characters.',
            'author_name.required' => 'Author name is required.',
            'rating.required' => 'Please select a star rating.',
            'photo.image' => 'Photo must be a valid image file.',
            'photo.max' => 'Photo cannot exceed 2MB.',
        ]);

        try {
            // ── Handle photo replacement ───────────────────
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($testimonial->photo && Storage::disk('public')->exists($testimonial->photo)) {
                    Storage::disk('public')->delete($testimonial->photo);
                }
                $path = $request->file('photo')->store('testimonials', 'public');
                $validated['photo'] = $path;
            } else {
                // Keep existing photo
                unset($validated['photo']);
            }

            // ── Auto-generate initials if cleared ──────────
            if (empty($validated['author_initials']) && !empty($validated['author_name'])) {
                $validated['author_initials'] = $this->generateInitials($validated['author_name']);
            }

            // ── Update ─────────────────────────────────────
            $testimonial->update($validated);

            return redirect()
                ->route('admin.testimonials.index')
                ->with('success', 'Testimonial updated successfully.');

        } catch (\Exception $e) {
            // ── Rollback new photo if update fails ─────────
            if (isset($validated['photo']) && Storage::disk('public')->exists($validated['photo'])) {
                Storage::disk('public')->delete($validated['photo']);
            }

            \Log::error("Testimonial update failed for ID {$id}: " . $e->getMessage(), [
                'request' => $request->except('photo'),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Failed to update testimonial. Please try again.');
        }
    }

    /**
     * Toggle active status for a testimonial.
     */
    public function toggle(string $id)
    {


        try {
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->toggle();

            $status = $testimonial->is_active ? 'activated' : 'deactivated';
            return redirect()
                ->back()
                ->with('success', "Testimonial {$status}.");

        } catch (\Exception $e) {
            \Log::error("Testimonial toggle failed for ID {$id}: " . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Failed to update testimonial status.');
        }
    }

    /**
     * Toggle featured status for a testimonial.
     */
    public function toggleFeatured(string $id)
    {


        try {
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->update(['is_featured' => !$testimonial->is_featured]);

            $status = $testimonial->is_featured ? 'featured' : 'unfeatured';
            return redirect()
                ->back()
                ->with('success', "Testimonial marked as {$status}.");

        } catch (\Exception $e) {
            \Log::error("Testimonial featured toggle failed for ID {$id}: " . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Failed to update featured status.');
        }
    }

    /**
     * Remove the specified testimonial from storage.
     */
    public function destroy(string $id)
    {

        try {
            $testimonial = Testimonial::findOrFail($id);

            // ── Delete associated photo ────────────────────
            if ($testimonial->photo && Storage::disk('public')->exists($testimonial->photo)) {
                Storage::disk('public')->delete($testimonial->photo);
            }

            $name = $testimonial->author_name;
            $testimonial->delete();

            return redirect()
                ->route('admin.testimonials.index')
                ->with('success', "Testimonial by {$name} deleted successfully.");

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()
                ->route('admin.testimonials.index')
                ->with('error', 'Testimonial not found.');
        } catch (\Exception $e) {
            \Log::error("Testimonial deletion failed for ID {$id}: " . $e->getMessage());
            return redirect()
                ->route('admin.testimonials.index')
                ->with('error', 'Failed to delete testimonial. Please try again.');
        }
    }

    /**
     * Bulk action handler (activate, deactivate, delete, feature).
     */
    public function bulkAction(Request $request)
    {


        $validated = $request->validate([
            'action' => ['required', Rule::in(['activate', 'deactivate', 'delete', 'feature', 'unfeature'])],
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['required', 'exists:testimonials,id'],
        ]);

        $count = 0;
        $errors = [];

        foreach ($validated['ids'] as $id) {
            try {
                $testimonial = Testimonial::findOrFail($id);

                match ($validated['action']) {
                    'activate' => $testimonial->update(['is_active' => true]),
                    'deactivate' => $testimonial->update(['is_active' => false]),
                    'feature' => $testimonial->update(['is_featured' => true]),
                    'unfeature' => $testimonial->update(['is_featured' => false]),
                    'delete' => $this->deleteTestimonialWithPhoto($testimonial),
                    default => null,
                };
                $count++;
            } catch (\Exception $e) {
                $errors[] = "ID {$id}: " . $e->getMessage();
                \Log::error("Bulk action failed for testimonial {$id}: " . $e->getMessage());
            }
        }

        $actionLabel = ucfirst(str_replace('_', ' ', $validated['action']));
        $message = "{$count} testimonial" . ($count !== 1 ? 's' : '') . " {$actionLabel} successfully.";

        if (!empty($errors)) {
            $message .= ' Some items failed.';
        }

        return redirect()
            ->back()
            ->with('success', $message)
            ->with('errors', $errors);
    }

    /**
     * Helper: Generate initials from author name.
     */
    private function generateInitials(string $name): string
    {
        $clean = preg_replace('/^(Dr\.|Mr\.|Ms\.|Mrs\.)\s*/i', '', trim($name));
        $words = explode(' ', $clean);
        $initials = '';

        foreach (array_slice($words, 0, 2) as $word) {
            if ($word !== '') {
                $initials .= strtoupper(mb_substr($word, 0, 1));
            }
        }

        return $initials ?: Str::upper(Str::substr($name, 0, 2));
    }

    /**
     * Helper: Delete testimonial and its photo safely.
     */
    private function deleteTestimonialWithPhoto(Testimonial $testimonial): void
    {
        if ($testimonial->photo && Storage::disk('public')->exists($testimonial->photo)) {
            Storage::disk('public')->delete($testimonial->photo);
        }
        $testimonial->delete();
    }
}