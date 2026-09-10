<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\Client;
use App\Models\ContactSubmission;
use App\Models\DemoRequest;
use App\Models\Product;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\TeamMember;
use App\Models\Project;


class PageController extends Controller
{
    public function home()
    {
        $featuredServices = Service::active()
            ->featured()
            ->ordered()
            ->get();

        $featuredProjects = Project::active()
            ->featured()
            ->ordered()
            ->take(3)
            ->get();

        $featuredModules = Product::published()
            ->orderBy('sort_order')
            ->get();

        $moduleCount = $featuredModules->count();
        $hospitalCount = Client::active()->count();

        $recentBlogPosts = BlogPost::published()
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $featuredClients = Client::active()
            ->featured()
            ->ordered()
            ->get();

        $teamMembers = TeamMember::visible()
            ->ordered()
            ->get();


        $testimonials = Testimonial::active()
            ->ordered()
            ->take(3)
            ->get();

        return view('pages.home', compact(
            'featuredServices',
            'featuredProjects',
            'featuredModules',
            'moduleCount',
            'hospitalCount',
            'recentBlogPosts',
            'featuredClients',
            'teamMembers',
            'testimonials'
        ));
    }

    public function about()
    {
        $teamMembers = TeamMember::visible()
            ->ordered()
            ->get();

        $moduleCount = Product::published()->count();
        $hospitalCount = Client::active()->count();

        return view('pages.about', compact('teamMembers', 'moduleCount', 'hospitalCount'));
    }

    public function servicesIndex()
    {
        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->whereIn('sort_order', [1, 2])
            ->get();

        $smallServices = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->whereNotIn('sort_order', [1, 2])
            ->get();

        $products = Product::where('is_published', true)
            ->orderBy('sort_order')
            ->get();

        $moduleCount = Product::published()->count();
        $hospitalCount = Client::active()->count();

        return view('pages.services.index', compact('services', 'smallServices', 'products', 'moduleCount', 'hospitalCount'));
    }

    public function serviceShow(string $slug)
    {
        $service = Cache::remember("service_{$slug}", 3600, function () use ($slug) {
            return Service::where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();
        });

        $moduleCount = Product::published()->count();
        $hospitalCount = Client::active()->count();

        return view('pages.services.show', compact('service', 'moduleCount', 'hospitalCount'));
    }

    public function contactCreate()
    {
        return view('pages.contact');
    }

    public function contactStore(Request $request)
    {
        if (cache()->has('contact_rate_limit_' . $request->ip())) {
            return back()
                ->withInput()
                ->withErrors(['rate_limit' => 'Please wait a few minutes before submitting again.']);
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'company' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:100',
            'service_interest' => 'required|in:his,cms,custom_dev,other',
            'message' => 'required|string|min:10|max:2000',
        ], [
            'service_interest.in' => 'Please select a valid service option.',
            'message.min' => 'Please provide a more detailed message (at least 10 characters).',
            'message.max' => 'Message is too long. Please keep it under 2000 characters.',
        ]);

        $submission = ContactSubmission::create([
            'name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'organisation' => $validated['company'],
            'subject' => 'Inquiry: ' . ($validated['service_interest'] ?? 'General'),
            'message' => $validated['message'],
            'status' => ContactSubmission::STATUS_NEW,
            'ip_address' => $request->ip(),
            'user_agent' => request()->userAgent(),
            'is_spam' => false,
        ]);

        Mail::to(config('mail.admin_email', 'admin@yourdomain.com'))
            ->send(new ContactFormMail(
                $validated['full_name'],
                $validated['email'],
                ($validated['service_interest'] ?? 'General Inquiry'),
                $validated['message']
            ));
        cache()->put('contact_rate_limit_' . $request->ip(), true, 300);

        return redirect()->route('contact.create')
            ->with('success', 'Thank you! We\'ll get back to you within 24 hours.');
    }

    public function clientsIndex()
    {
        $featured = Client::active()
            ->featured()
            ->ordered()
            ->take(8)
            ->get();

        $clientsByType = Client::active()
            ->ordered()
            ->get()
            ->groupBy('type');


        $hospitalCount = Client::active()->count();

        $stats = [
            ['value' => Client::active()->count() . '+', 'label' => 'Hospitals Served'],
            ['value' => '4+', 'label' => 'Provinces'],
            ['value' => '12+', 'label' => 'Years Experience'], // Keep hardcoded or calculate from earliest year_deployed
            ['value' => '99%', 'label' => 'Retention Rate'],   // Keep hardcoded (business metric)
        ];

        return view('pages.clients.index', compact('featured', 'clientsByType', 'stats', 'hospitalCount'));
    }

    public function productsIndex()
    {
        $allModules = Product::published()
            ->orderBy('sort_order')
            ->get();

        $moduleCount = Product::published()->count();
        $hospitalCount = Client::active()->count();

        return view('pages.products.index', compact('allModules', 'moduleCount', 'hospitalCount'));
    }

    public function productsShow(string $slug)
    {
        $module = Cache::remember("his_module_{$slug}", 3600, function () use ($slug) {
            return Product::published()
                ->where('slug', $slug)
                ->firstOrFail();
        });

        Log::info("Module: {$module}");

        return view('pages.products.show', compact('module'));
    }

    public function projectsIndex(Request $request)
    {
        $query = Project::where('is_active', true);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('client_name', 'like', "%{$search}%")
                    ->orWhere('summary', 'like', "%{$search}%");
            });
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('client_type', $request->input('type'));
        }

        $projects = $query->orderBy('created_at', 'desc')
            ->paginate(9);

        $featured = Project::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        $featuredClients = Client::active()
            ->featured()
            ->ordered()
            ->take(8)
            ->get();

        $total = Project::where('is_active', true)->count();

        $projectStats = [
            [$total . '+', 'Projects Delivered', 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
            ['150+', 'Hospitals Served', 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
            ['12+', 'Years Experience', 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
        ];

        $trustItems = ['Full training included', '24/7 AMC support', 'ICD-10 compliant'];
        $moduleCount = Product::published()->count();
        $hospitalCount = Client::active()->count();

        return view('pages.projects.index', compact(
            'projects',
            'featured',
            'featuredClients',
            'total',
            'projectStats',
            'trustItems',
            'moduleCount',
            'hospitalCount'
        ));
    }

    public function projectShow(string $slug)
    {
        $project = Cache::remember("project_{$slug}", 3600, function () use ($slug) {
            return Project::where('slug', $slug)
                ->firstOrFail();
        });

        $moduleCount = Product::published()->count();
        $hospitalCount = Client::active()->count();

        Log::info("Project accessed: {$project->name} (ID: {$project->id})");
        Log::debug("Project stats: " . json_encode($project->stats) . "Type: " . gettype($project->stats));
        return view('pages.projects.show', compact('project', 'moduleCount', 'hospitalCount'));
    }

    public function blogIndex()
    {
        $blogPosts = BlogPost::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(3);

        return view('pages.blog.index', compact('blogPosts'));
    }

    public function blogShow($slug)
    {
        $blog = Cache::remember("blog_{$slug}", 3600, function () use ($slug) {
            return BlogPost::where('slug', $slug)
                ->where('status', 'published')
                ->firstOrFail();
        });

        return view('pages.blog.show', compact('blog'));
    }

    public function testimonialShow()
    {
        // Fetch all active testimonials for the full page
        $testimonials = Testimonial::active()
            ->ordered()
            ->get();

        return view('pages.testimonials.index', compact('testimonials'));
    }
}
