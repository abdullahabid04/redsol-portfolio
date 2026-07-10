<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::query();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($category = $request->get('category')) {
            $query->byCategory($category);
        }

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        $posts = $query
            ->latest('published_at')
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view('admin.pages.blog.index', compact('posts'));
    }
    public function create()
    {
        return view('admin.pages.blog.form');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'alpha_dash', 'max:255', 'unique:blog_posts,slug'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['required', 'string'],
            'category' => ['required', 'string', 'max:100'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'featured_image_alt' => ['nullable', 'string', 'max:255'],
            'is_published' => ['boolean'],
            'published_at' => ['nullable', 'date'],
            'read_time' => ['nullable', 'integer', 'min:1', 'max:60'],
            'meta_title' => ['nullable', 'string', 'max:70'],
            'meta_description' => ['nullable', 'string', 'max:165'],
        ], [
            'title.required' => 'Post title is required.',
            'body.required' => 'Content cannot be empty.',
            'category.required' => 'Please select a category.',
            'cover_image.image' => 'Cover image must be a valid image file.',
            'cover_image.max' => 'Cover image cannot exceed 2MB.',
        ]);

        try {
            $validated['status'] = !empty($validated['is_published'])
                ? BlogPost::STATUS_PUBLISHED
                : BlogPost::STATUS_DRAFT;
            unset($validated['is_published']);

            if (isset($validated['read_time'])) {
                $validated['read_time_minutes'] = $validated['read_time'];
                unset($validated['read_time']);
            }

            // Map cover_image input → featured_image column
            if ($request->hasFile('cover_image')) {
                $validated['featured_image'] = $request->file('cover_image')->store('blog', 'public');
            }
            unset($validated['cover_image']);

            $validated['author_id'] = Auth::guard('admin')->id();

            if ($validated['status'] === BlogPost::STATUS_PUBLISHED && empty($validated['published_at'])) {
                $validated['published_at'] = now();
            }

            BlogPost::create($validated);

            return redirect()
                ->route('admin.blog.index')
                ->with('success', 'Blog post created successfully.');

        } catch (\Illuminate\Database\QueryException $e) {
            if (Str::contains($e->getMessage(), ['Duplicate entry', 'unique'])) {
                return back()->withInput()->withErrors(['slug' => 'This slug is already in use.']);
            }
            throw $e;
        } catch (\Exception $e) {
            if (isset($validated['featured_image']) && Storage::disk('public')->exists($validated['featured_image'])) {
                Storage::disk('public')->delete($validated['featured_image']);
            }
            \Log::error('BlogPost store failed: ' . $e->getMessage(), [
                'request' => $request->except('cover_image'),
                'trace' => $e->getTraceAsString(),
            ]);
            return back()->withInput()->with('error', 'Failed to create post. Please try again.');
        }
    }
    public function edit(string $id)
    {
        $post = BlogPost::findOrFail($id);
        return view('admin.pages.blog.form', compact('post'));
    }
    public function update(Request $request, string $id)
    {
        $post = BlogPost::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'alpha_dash', 'max:255', 'unique:blog_posts,slug,' . $post->id],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['required', 'string'],
            'category' => ['required', 'string', 'max:100'],
            'cover_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'featured_image_alt' => ['nullable', 'string', 'max:255'],
            'is_published' => ['boolean'],
            'published_at' => ['nullable', 'date'],
            'read_time' => ['nullable', 'integer', 'min:1', 'max:60'],
            'meta_title' => ['nullable', 'string', 'max:70'],
            'meta_description' => ['nullable', 'string', 'max:165'],
        ], [
            'title.required' => 'Post title is required.',
            'body.required' => 'Content cannot be empty.',
            'category.required' => 'Please select a category.',
            'cover_image.image' => 'Cover image must be a valid image file.',
            'cover_image.max' => 'Cover image cannot exceed 2MB.',
        ]);

        try {
            $validated['status'] = !empty($validated['is_published'])
                ? BlogPost::STATUS_PUBLISHED
                : BlogPost::STATUS_DRAFT;
            unset($validated['is_published']);

            if (isset($validated['read_time'])) {
                $validated['read_time_minutes'] = $validated['read_time'];
                unset($validated['read_time']);
            }

            if ($request->hasFile('cover_image')) {
                if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
                    Storage::disk('public')->delete($post->featured_image);
                }
                $validated['featured_image'] = $request->file('cover_image')->store('blog', 'public');
            } else {
                unset($validated['cover_image']);
                unset($validated['featured_image']);
            }

            if ($validated['status'] === BlogPost::STATUS_PUBLISHED && !$post->published_at) {
                $validated['published_at'] = now();
            }

            $post->update($validated);

            return redirect()
                ->route('admin.blog.index')
                ->with('success', 'Blog post updated successfully.');

        } catch (\Illuminate\Database\QueryException $e) {
            if (Str::contains($e->getMessage(), ['Duplicate entry', 'unique'])) {
                return back()->withInput()->withErrors(['slug' => 'This slug is already in use.']);
            }
            throw $e;
        } catch (\Exception $e) {
            if (isset($validated['featured_image']) && Storage::disk('public')->exists($validated['featured_image'])) {
                Storage::disk('public')->delete($validated['featured_image']);
            }
            \Log::error("BlogPost update failed for ID {$id}: " . $e->getMessage(), [
                'request' => $request->except('cover_image'),
                'trace' => $e->getTraceAsString(),
            ]);
            return back()->withInput()->with('error', 'Failed to update post. Please try again.');
        }
    }
    public function toggle(string $id)
    {
        try {
            $post = BlogPost::findOrFail($id);

            if ($post->status === BlogPost::STATUS_PUBLISHED) {
                $post->update(['status' => BlogPost::STATUS_DRAFT]);
                $message = 'Post moved to drafts.';
            } else {
                $post->update([
                    'status' => BlogPost::STATUS_PUBLISHED,
                    'published_at' => $post->published_at ?? now(),
                ]);
                $message = 'Post published successfully.';
            }

            return back()->with('success', $message);

        } catch (\Exception $e) {
            \Log::error("BlogPost toggle failed for ID {$id}: " . $e->getMessage());
            return back()->with('error', 'Failed to update post status.');
        }
    }
    public function destroy(string $id)
    {
        try {
            $post = BlogPost::findOrFail($id);

            if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
                Storage::disk('public')->delete($post->featured_image);
            }

            $title = $post->title;
            $post->delete();

            return redirect()
                ->route('admin.blog.index')
                ->with('success', "Post \"{$title}\" deleted successfully.");

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.blog.index')->with('error', 'Post not found.');
        } catch (\Exception $e) {
            \Log::error("BlogPost deletion failed for ID {$id}: " . $e->getMessage());
            return redirect()->route('admin.blog.index')->with('error', 'Failed to delete post.');
        }
    }
}