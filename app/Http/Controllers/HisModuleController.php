<?php

namespace App\Http\Controllers;

// app/Http/Controllers/HisModuleController.php

use App\Models\HisModule;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HisModuleController extends Controller
{
    public function index()
    {
        // Cache the listing for 1 hour, invalidate on seeder/admin changes
        $groupedModules = Cache::remember('his_modules_listing', 3600, function () {
            return HisModule::published()
                ->with('features')
                ->orderBy('sort_order')
                ->get()
                ->groupBy('category');
        });

        $categories = [
            'administration' => ['label' => 'Administration & Security', 'desc' => 'The operational and security foundation of the entire platform.'],
            'patient-journey' => ['label' => 'Patient Journey', 'desc' => 'Every touchpoint from first registration to final discharge.'],
            'clinical' => ['label' => 'Clinical & Departmental', 'desc' => 'Department-level clinical modules covering consultation, emergency, wards, and more.'],
            'diagnostics' => ['label' => 'Diagnostics & Imaging', 'desc' => 'Full lab, radiology and PACS suite with DICOM, analyzers, and voice reporting.'],
            'operations' => ['label' => 'Operations & Supply Chain', 'desc' => 'Billing, pharmacy dispensing, and inventory management.'],
        ];

        return view('pages.products.index', compact('groupedModules', 'categories'));
    }

    public function show(string $slug)
    {
        Log::info("Fetching HIS module details for slug: {$slug}");
        $module = Cache::remember("his_module_{$slug}", 3600, function () use ($slug) {
            return HisModule::published()
                ->where('slug', $slug)
                ->with(['features', 'sections'])
                ->firstOrFail();
        });
        Log::info("Successfully retrieved HIS module: {$module->name}");

        return view('pages.products.show', compact('module'));
    }
}
