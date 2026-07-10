<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->unique();

            $table->string('client_name');                      // Hospital or organisation name
            $table->string('client_city')->nullable();
            $table->string('client_province')->nullable();
            $table->enum('client_type', [
                'government',
                'private',
                'semi-government',
                'ngo',
                'other',
            ])->default('government');

            $table->text('summary');                            // Short paragraph shown on listing cards
            $table->longText('description')->nullable();        // Full case study / detail page content

            // JSON array of module slugs deployed at this hospital
            // e.g. ["laboratory-lims", "pacs", "patient-registration"]
            $table->json('modules_deployed')->nullable();

            // JSON array of outcome strings shown as bullet points
            // e.g. ["Reduced patient registration time by 70%", "PACS live across 3 modalities"]
            $table->json('outcomes')->nullable();

            $table->string('featured_image')->nullable();       // storage/app/public/projects/...
            $table->string('featured_image_alt')->nullable();
            $table->json('gallery')->nullable();                // Array of additional image paths

            $table->date('start_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->unsignedSmallInteger('duration_months')->nullable(); // How long the project took

            // e.g. beds, departments, staff trained — flexible key-value JSON
            // {"beds": "400+", "departments": "12", "staff_trained": "150+"}
            $table->json('stats')->nullable();

            // Optional FK to testimonials table — links the project to a quote
            $table->foreignId('testimonial_id')
                ->nullable()
                ->constrained('testimonials')
                ->nullOnDelete();

            // JSON array of service slugs, e.g. ["his-implementation", "annual-maintenance"]
            $table->json('services_provided')->nullable();

            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->boolean('is_active')->default(true);        // Show on public projects page
            $table->boolean('is_featured')->default(false);     // Show on homepage / featured section
            $table->unsignedSmallInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index('is_active');
            $table->index('is_featured');
            $table->index('sort_order');
            $table->index('client_type');
            $table->index('completion_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};