<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

            $table->string('name');                             // Hospital / organisation name
            $table->string('city')->nullable();                 // City where the hospital is located
            $table->string('province')->nullable();             // Province / state

            $table->string('logo_path')->nullable();            // Path: storage/app/public/clients/...
            $table->string('logo_alt')->nullable();             // Alt text for the logo image

            $table->enum('type', [
                'government',
                'private',
                'semi-government',
                'ngo',
            ])->default('government');

            $table->boolean('is_featured')->default(false);     // Shown in the homepage ticker
            $table->boolean('is_active')->default(true);        // Shown on the clients page
            $table->unsignedSmallInteger('sort_order')->default(0);

            $table->json('modules')->nullable();

            $table->string('website_url')->nullable();
            $table->year('year_deployed')->nullable();          // Year HIS was deployed at this client
            $table->text('notes')->nullable();                  // Internal admin notes — not shown publicly

            $table->timestamps();

            $table->index('is_featured');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};