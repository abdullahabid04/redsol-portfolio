<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();

            // ── Quote ─────────────────────────────────────────
            $table->text('quote');                              // The testimonial text

            // ── Author ────────────────────────────────────────
            $table->string('author_name');                      // e.g. "Dr. Muhammad Arif"
            $table->string('author_role');                      // e.g. "Medical Superintendent"
            $table->string('author_initials', 5);              // e.g. "MA" — shown in avatar circle
            $table->string('hospital');                         // e.g. "DHQ Hospital"

            // ── Avatar ────────────────────────────────────────
            // Optional real photo. If null, initials + gradient are shown instead.
            $table->string('photo')->nullable();

            // ── Visual ────────────────────────────────────────
            // Tailwind gradient string for the avatar circle background
            // e.g. "from-crimson-500 to-crimson-700"
            $table->string('avatar_gradient')->default('from-crimson-500 to-crimson-700');

            // ── Rating ────────────────────────────────────────
            $table->unsignedTinyInteger('rating')
                ->default(5);                                 // 1-5 stars

            // ── Display control ───────────────────────────────
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);     // Featured on homepage
            $table->unsignedSmallInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index('is_active');
            $table->index('is_featured');
        });

        // ── Seed from the website copy ────────────────────────
        $testimonials = [
            [
                'quote' => "REDSOL's HIS transformed our entire patient flow. What used to take hours at registration now takes minutes. The LIMS integration alone saved our lab team immeasurable time every single day.",
                'author_name' => 'Dr. Muhammad Arif',
                'author_role' => 'Medical Superintendent',
                'author_initials' => 'MA',
                'hospital' => 'DHQ Hospital',
                'avatar_gradient' => 'from-crimson-500 to-crimson-700',
                'rating' => 5,
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'quote' => 'The PACS system they integrated is world-class. Our radiologists can access patient imaging from any workstation in the hospital. The voice recognition reporting feature is a game changer for our department.',
                'author_name' => 'Dr. Sarah Hassan',
                'author_role' => 'Head of Radiology',
                'author_initials' => 'SH',
                'hospital' => 'Civil Hospital',
                'avatar_gradient' => 'from-gray-700 to-gray-900',
                'rating' => 5,
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'quote' => 'We deployed REDSOL across 4 hospital branches. Their team configured each location perfectly and the training was thorough. The AMC support is prompt and professional — exactly what a hospital needs.',
                'author_name' => 'Mr. Khalid Mehmood',
                'author_role' => 'Hospital Administrator',
                'author_initials' => 'KM',
                'hospital' => 'Allied Medical Center',
                'avatar_gradient' => 'from-crimson-600 to-gray-800',
                'rating' => 5,
                'is_featured' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($testimonials as $t) {
            DB::table('testimonials')->insert(array_merge($t, [
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};