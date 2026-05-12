<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            // ── Identity ──────────────────────────────────────
            $table->string('name');
            $table->string('slug')->unique();

            // ── Display ───────────────────────────────────────
            $table->string('tagline')->nullable();              // Short one-line descriptor under the title
            $table->text('description');                        // Full description shown on the services page
            $table->string('icon')->nullable();                 // SVG path string OR heroicon name OR emoji

            // ── Categorisation ────────────────────────────────
            // Matches the two service tag types used on the homepage cards
            $table->enum('tag', ['HIS-Related', 'Custom Dev', 'Support', 'Advisory'])
                ->default('HIS-Related');

            // ── Key features ──────────────────────────────────
            // Stored as a JSON array of strings, e.g.:
            // ["ICD-10 & DICOM 3.0", "One Database Architecture", ...]
            $table->json('features')->nullable();

            // ── Linking ───────────────────────────────────────
            $table->string('href')->nullable();                 // Public URL path, e.g. /services/his-implementation

            // ── Display control ───────────────────────────────
            $table->unsignedSmallInteger('sort_order')->default(0); // Drag-and-drop ordering
            $table->boolean('is_active')->default(true);        // Show/hide on public site
            $table->boolean('is_featured')->default(false);     // Show on homepage services section

            // ── SEO ───────────────────────────────────────────
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->timestamps();

            $table->index('is_active');
            $table->index('sort_order');
        });

        // ── Seed core services from the PDF ───────────────────
        $services = [
            [
                'name' => 'HIS Implementation',
                'slug' => 'his-implementation',
                'tagline' => 'Full-scale hospital information system deployment',
                'tag' => 'HIS-Related',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Custom Hospital Software',
                'slug' => 'custom-hospital-software',
                'tagline' => 'Bespoke systems built around your workflows',
                'tag' => 'Custom Dev',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Patient Portal Development',
                'slug' => 'patient-portal',
                'tagline' => 'Secure online access to appointments and records',
                'tag' => 'Custom Dev',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'LIMS / PACS / RIS Integration',
                'slug' => 'lims-pacs-ris-integration',
                'tagline' => 'Lab, radiology and imaging fully integrated',
                'tag' => 'HIS-Related',
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Healthcare Mobile Apps',
                'slug' => 'healthcare-mobile-apps',
                'tagline' => 'iOS and Android apps for clinical environments',
                'tag' => 'Custom Dev',
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'AMC & Support',
                'slug' => 'annual-maintenance',
                'tagline' => 'Year-round maintenance and dedicated support',
                'tag' => 'Support',
                'is_featured' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'Healthcare IT Consulting',
                'slug' => 'healthcare-it-consulting',
                'tagline' => 'Expert advisory on HIS procurement and architecture',
                'tag' => 'Advisory',
                'is_featured' => false,
                'sort_order' => 7,
            ],
        ];

        foreach ($services as $service) {
            DB::table('services')->insert(array_merge($service, [
                'description' => '',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};