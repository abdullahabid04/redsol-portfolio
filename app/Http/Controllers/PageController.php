<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\HisModule;
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
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function services()
    {
        $services = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->whereIn('sort_order', [1, 2])
            ->get();

        $smallServices = Service::where('is_active', true)
            ->orderBy('sort_order')
            ->whereNotIn('sort_order', [1, 2])
            ->get();

        $products = HisModule::where('is_published', true)
            ->orderBy('sort_order')
            ->get();

        return view('pages.services.index', compact('services', 'smallServices', 'products'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function productsIndex()
    {
        $allModules = HisModule::published()
            ->orderBy('sort_order')
            ->get();

        return view('pages.products.index', compact('allModules'));
    }

    public function projectsIndex()
    {
        $projects = Project::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.projects.index', compact('projects'));
    }

    public function servicesCustomDev()
    {
        return view('pages.services.custom-dev');
    }

    public function blogIndex()
    {
        return view('pages.blog.index');
    }

    public function blogShow($slug)
    {
        return view('pages.blog.show', compact('slug'));
    }
}
