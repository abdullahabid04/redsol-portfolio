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

            $table->text('quote');                              // The testimonial text

            $table->string('author_name');                      // e.g. "Dr. Muhammad Arif"
            $table->string('author_role');                      // e.g. "Medical Superintendent"
            $table->string('author_initials', 5);              // e.g. "MA" — shown in avatar circle
            $table->string('hospital');                         // e.g. "DHQ Hospital"

            // Optional real photo. If null, initials + gradient are shown instead.
            $table->string('photo')->nullable();

            // Tailwind gradient string for the avatar circle background
            // e.g. "from-crimson-500 to-crimson-700"
            $table->string('avatar_gradient')->default('from-crimson-500 to-crimson-700');

            $table->unsignedTinyInteger('rating')
                ->default(5);                                 // 1-5 stars

            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);     // Featured on homepage
            $table->unsignedSmallInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index('is_active');
            $table->index('is_featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};