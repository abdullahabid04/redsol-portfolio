<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // ── Identity ──────────────────────────────────────
            $table->string('name');
            $table->string('slug')->unique();

            // ── Categorisation ────────────────────────────────
            $table->enum('category', [
                'administration',
                'patient-journey',
                'clinical',
                'diagnostics',
                'operations',
            ]);
            $table->string('category_label');
            $table->string('tag')->nullable();

            // ── Display ───────────────────────────────────────
            $table->string('icon')->nullable();
            $table->string('tagline');
            $table->text('description');

            // ── Key features — JSON array of strings ──────────
            $table->json('features')->nullable();

            // ── Linking ───────────────────────────────────────
            $table->string('href')->nullable();

            // ── Display control ───────────────────────────────
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            // ── SEO ───────────────────────────────────────────
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->timestamps();

            $table->index('category');
            $table->index('is_active');
            $table->index('sort_order');
        });

        // Seed all 25 HIS modules
        $products = [
            // Administration
            ['name' => 'System Security & Administration', 'slug' => 'system-security', 'category' => 'administration', 'category_label' => 'Administration & Security', 'icon' => '🔐', 'sort_order' => 1],
            ['name' => 'Front Desk / Inquiry & Information', 'slug' => 'front-desk', 'category' => 'administration', 'category_label' => 'Administration & Security', 'icon' => '🗂️', 'sort_order' => 2],
            ['name' => 'Statistics Dashboard', 'slug' => 'statistics-dashboard', 'category' => 'administration', 'category_label' => 'Administration & Security', 'icon' => '📊', 'sort_order' => 3],
            ['name' => 'HR Management', 'slug' => 'hr-management', 'category' => 'administration', 'category_label' => 'Administration & Security', 'icon' => '👥', 'sort_order' => 4],
            ['name' => 'Assets Management', 'slug' => 'assets-management', 'category' => 'administration', 'category_label' => 'Administration & Security', 'icon' => '🏷️', 'sort_order' => 5],
            // Patient Journey
            ['name' => 'Patient Registration', 'slug' => 'patient-registration', 'category' => 'patient-journey', 'category_label' => 'Patient Journey', 'icon' => '👤', 'sort_order' => 6],
            ['name' => 'Integrated Appointment System', 'slug' => 'integrated-appointment-system', 'category' => 'patient-journey', 'category_label' => 'Patient Journey', 'icon' => '📅', 'sort_order' => 7],
            ['name' => 'Patient Queue Management', 'slug' => 'queue-management', 'category' => 'patient-journey', 'category_label' => 'Patient Journey', 'icon' => '🔢', 'sort_order' => 8],
            ['name' => 'Patient Welfare Management', 'slug' => 'patient-welfare', 'category' => 'patient-journey', 'category_label' => 'Patient Journey', 'icon' => '🤝', 'sort_order' => 9],
            ['name' => 'Admission & Discharge System', 'slug' => 'admission-discharge', 'category' => 'patient-journey', 'category_label' => 'Patient Journey', 'icon' => '🛏️', 'sort_order' => 10],
            // Clinical
            ['name' => 'Outdoor Clinics & Consultant Practice', 'slug' => 'outdoor-clinics', 'category' => 'clinical', 'category_label' => 'Clinical & Departmental', 'icon' => '🩺', 'sort_order' => 11],
            ['name' => 'Emergency Center Management', 'slug' => 'emergency-center', 'category' => 'clinical', 'category_label' => 'Clinical & Departmental', 'icon' => '🚨', 'sort_order' => 12],
            ['name' => 'Nursing Counter / Wards Management', 'slug' => 'nursing-wards', 'category' => 'clinical', 'category_label' => 'Clinical & Departmental', 'icon' => '🏥', 'sort_order' => 13],
            ['name' => 'Operation Theatre Management', 'slug' => 'operation-theatre', 'category' => 'clinical', 'category_label' => 'Clinical & Departmental', 'icon' => '⚕️', 'sort_order' => 14],
            ['name' => 'Gynecology Management System', 'slug' => 'gynecology', 'category' => 'clinical', 'category_label' => 'Clinical & Departmental', 'icon' => '👶', 'sort_order' => 15],
            ['name' => 'Dialysis Center Management', 'slug' => 'dialysis-center', 'category' => 'clinical', 'category_label' => 'Clinical & Departmental', 'icon' => '💉', 'sort_order' => 16],
            ['name' => 'Doctor Share', 'slug' => 'doctor-share', 'category' => 'clinical', 'category_label' => 'Clinical & Departmental', 'icon' => '💼', 'sort_order' => 17],
            // Diagnostics
            ['name' => 'Laboratory (LIMS)', 'slug' => 'laboratory-lims', 'category' => 'diagnostics', 'category_label' => 'Diagnostics & Imaging', 'icon' => '🧪', 'sort_order' => 18],
            ['name' => 'Radiology Information System', 'slug' => 'radiology-ris', 'category' => 'diagnostics', 'category_label' => 'Diagnostics & Imaging', 'icon' => '🩻', 'sort_order' => 19],
            ['name' => 'PACS', 'slug' => 'pacs', 'category' => 'diagnostics', 'category_label' => 'Diagnostics & Imaging', 'icon' => '🖥️', 'sort_order' => 20],
            ['name' => 'Voice-Based Report Generation', 'slug' => 'voice-reporting', 'category' => 'diagnostics', 'category_label' => 'Diagnostics & Imaging', 'icon' => '🎙️', 'sort_order' => 21],
            ['name' => 'DICOM Image Compression', 'slug' => 'dicom-compression', 'category' => 'diagnostics', 'category_label' => 'Diagnostics & Imaging', 'icon' => '🗜️', 'sort_order' => 22],
            // Operations
            ['name' => 'Patient Billing System', 'slug' => 'patient-billing-system', 'category' => 'operations', 'category_label' => 'Operations & Supply', 'icon' => '💳', 'sort_order' => 23],
            ['name' => 'Pharmacy Management', 'slug' => 'pharmacy', 'category' => 'operations', 'category_label' => 'Operations & Supply', 'icon' => '💊', 'sort_order' => 24],
            ['name' => 'Inventory Management', 'slug' => 'inventory', 'category' => 'operations', 'category_label' => 'Operations & Supply', 'icon' => '📦', 'sort_order' => 25],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert(array_merge($product, [
                'tagline' => '',
                'description' => '',
                'features' => json_encode([]),
                'href' => '/products/' . $product['slug'],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};