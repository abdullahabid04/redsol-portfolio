<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('tagline', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($category = $request->get('category')) {
            $query->where('category', $category);
        }

        if ($status = $request->get('status')) {
            $query->where('is_active', $status === 'active');
        }

        $products = $query
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'total' => Product::count(),
            'active' => Product::active()->count(),
            'inactive' => Product::count() - Product::active()->count(),
        ];

        // Category breakdown for stats pills
        $categoryCounts = Product::selectRaw('category, count(*) as total')
            ->groupBy('category')
            ->pluck('total', 'category');

        return view('admin.pages.products.index', compact('products', 'stats', 'categoryCounts'));
    }
    public function create()
    {
        return view('admin.pages.products.form', [
            'product' => new Product(),
            'isEdit' => false,
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Identity
            'name' => ['required', 'string', 'min:3', 'max:120'],
            'slug' => ['required', 'string', 'alpha_dash', 'max:120', 'unique:products,slug'],
            'tagline' => ['required', 'string', 'min:10', 'max:160'],
            'icon' => ['nullable', 'string', 'max:20'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],

            // Content
            'description' => ['required', 'string', 'min:50', 'max:2000'],
            'features' => ['nullable', 'array', 'max:15'],
            'features.*' => ['nullable', 'string', 'max:200'],

            // Categorization
            'category' => ['required', 'string', 'in:' . implode(',', array_keys(Product::CATEGORIES))],
            'category_label' => ['nullable', 'string', 'max:100'],
            'tag' => ['nullable', 'string', 'in:HIS-Related,Custom Dev,Support,Advisory'],

            // URL & SEO
            'href' => ['nullable', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:70'],
            'meta_description' => ['nullable', 'string', 'max:165'],

            // Status
            'is_active' => ['boolean'],
        ], [
            'name.required' => 'Module name is required.',
            'name.min' => 'Name must be at least 3 characters.',
            'slug.required' => 'Slug is required.',
            'slug.unique' => 'This slug is already in use.',
            'slug.alpha_dash' => 'Slug can only contain letters, numbers, dashes and underscores.',
            'tagline.required' => 'Tagline is required.',
            'tagline.min' => 'Tagline must be at least 10 characters.',
            'description.required' => 'Description is required.',
            'description.min' => 'Description must be at least 50 characters.',
            'category.required' => 'Please select a category.',
            'category.in' => 'Invalid category selected.',
        ]);

        try {
            if (empty($validated['slug'])) {
                $validated['slug'] = Str::slug($validated['name']);
            }

            if (empty($validated['href'])) {
                $validated['href'] = '/products/' . $validated['slug'];
            }

            if (empty($validated['category_label']) && isset(Product::CATEGORIES[$validated['category']])) {
                $validated['category_label'] = Product::CATEGORIES[$validated['category']];
            }

            $validated['is_active'] = $validated['is_active'] ?? true;
            $validated['sort_order'] = $validated['sort_order'] ?? (Product::max('sort_order') ?? 0) + 1;

            if (isset($validated['features']) && is_array($validated['features'])) {
                $validated['features'] = array_filter(array_map('trim', $validated['features']));
            }

            Product::create($validated);

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Product module created successfully.');

        } catch (\Illuminate\Database\QueryException $e) {
            // Handle unique constraint violations (slug)
            if (Str::contains($e->getMessage(), 'Duplicate entry') || Str::contains($e->getMessage(), 'unique')) {
                return back()
                    ->withInput()
                    ->withErrors(['slug' => 'This slug is already in use. Please try a different one.']);
            }
            throw $e;
        } catch (\Exception $e) {
            \Log::error('Product store failed: ' . $e->getMessage(), [
                'request' => $request->all(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Failed to create product. Please try again.');
        }
    }
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        return view('admin.pages.products.form', [
            'product' => $product,
            'isEdit' => true,
        ]);
    }
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            // Identity
            'name' => ['required', 'string', 'min:3', 'max:120'],
            'slug' => ['required', 'string', 'alpha_dash', 'max:120', 'unique:products,slug,' . $product->id],
            'tagline' => ['required', 'string', 'min:10', 'max:160'],
            'icon' => ['nullable', 'string', 'max:20'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999'],

            // Content
            'description' => ['required', 'string', 'min:50', 'max:2000'],
            'features' => ['nullable', 'array', 'max:15'],
            'features.*' => ['nullable', 'string', 'max:200'],

            // Categorization
            'category' => ['required', 'string', 'in:' . implode(',', array_keys(Product::CATEGORIES))],
            'category_label' => ['nullable', 'string', 'max:100'],
            'tag' => ['nullable', 'string', 'in:HIS-Related,Custom Dev,Support,Advisory'],

            // URL & SEO
            'href' => ['nullable', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:70'],
            'meta_description' => ['nullable', 'string', 'max:165'],

            // Status
            'is_active' => ['boolean'],
        ], [
            'name.required' => 'Module name is required.',
            'slug.required' => 'Slug is required.',
            'slug.unique' => 'This slug is already in use.',
            'slug.alpha_dash' => 'Slug can only contain letters, numbers, dashes and underscores.',
            'tagline.required' => 'Tagline is required.',
            'description.required' => 'Description is required.',
            'category.required' => 'Please select a category.',
        ]);

        try {
            if (empty($validated['slug'])) {
                $validated['slug'] = Str::slug($validated['name']);
            }

            if (empty($validated['href'])) {
                $validated['href'] = '/products/' . $validated['slug'];
            }

            if (empty($validated['category_label']) && isset(Product::CATEGORIES[$validated['category']])) {
                $validated['category_label'] = Product::CATEGORIES[$validated['category']];
            }

            if (isset($validated['features']) && is_array($validated['features'])) {
                $validated['features'] = array_filter(array_map('trim', $validated['features']));
            }

            $product->update($validated);

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Product module updated successfully.');

        } catch (\Illuminate\Database\QueryException $e) {
            if (Str::contains($e->getMessage(), 'Duplicate entry') || Str::contains($e->getMessage(), 'unique')) {
                return back()
                    ->withInput()
                    ->withErrors(['slug' => 'This slug is already in use. Please try a different one.']);
            }
            throw $e;
        } catch (\Exception $e) {
            \Log::error("Product update failed for ID {$id}: " . $e->getMessage(), [
                'request' => $request->all(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Failed to update product. Please try again.');
        }
    }
    public function toggle(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->toggle();

            $status = $product->is_active ? 'activated' : 'deactivated';
            return redirect()
                ->back()
                ->with('success', "Product {$status}.");

        } catch (\Exception $e) {
            \Log::error("Product toggle failed for ID {$id}: " . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Failed to update product status.');
        }
    }
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $name = $product->name;
            $product->delete();

            return redirect()
                ->route('admin.products.index')
                ->with('success', "Product \"{$name}\" deleted successfully.");

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()
                ->route('admin.products.index')
                ->with('error', 'Product not found.');
        } catch (\Exception $e) {
            \Log::error("Product deletion failed for ID {$id}: " . $e->getMessage());
            return redirect()
                ->route('admin.products.index')
                ->with('error', 'Failed to delete product. Please try again.');
        }
    }
}