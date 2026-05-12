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

            // ── Identity ──────────────────────────────────────
            $table->string('name');                             // Hospital / organisation name
            $table->string('city')->nullable();                 // City where the hospital is located
            $table->string('province')->nullable();             // Province / state

            // ── Media ─────────────────────────────────────────
            $table->string('logo_path')->nullable();            // Path: storage/app/public/clients/...
            $table->string('logo_alt')->nullable();             // Alt text for the logo image

            // ── Classification ────────────────────────────────
            $table->enum('type', [
                'government',
                'private',
                'semi-government',
                'ngo',
            ])->default('government');

            // ── Display control ───────────────────────────────
            $table->boolean('is_featured')->default(false);     // Shown in the homepage ticker
            $table->boolean('is_active')->default(true);        // Shown on the clients page
            $table->unsignedSmallInteger('sort_order')->default(0);

            // ── Optional extras ───────────────────────────────
            $table->string('website_url')->nullable();
            $table->year('year_deployed')->nullable();          // Year HIS was deployed at this client
            $table->text('notes')->nullable();                  // Internal admin notes — not shown publicly

            $table->timestamps();

            $table->index('is_featured');
            $table->index('is_active');
        });

        // ── Seed with hospitals from the website copy ─────────
        $clients = [
            ['name' => 'Sheikh Zayed Hospital', 'city' => 'Rahim Yar Khan', 'province' => 'Punjab', 'type' => 'government', 'is_featured' => true],
            ['name' => 'Bahawal Victoria Hospital', 'city' => 'Bahawalpur', 'province' => 'Punjab', 'type' => 'government', 'is_featured' => true],
            ['name' => 'Civil Hospital Karachi', 'city' => 'Karachi', 'province' => 'Sindh', 'type' => 'government', 'is_featured' => true],
            ['name' => 'PIMS Islamabad', 'city' => 'Islamabad', 'province' => 'ICT', 'type' => 'government', 'is_featured' => true],
            ['name' => 'Services Hospital Lahore', 'city' => 'Lahore', 'province' => 'Punjab', 'type' => 'government', 'is_featured' => true],
            ['name' => 'Jinnah Hospital', 'city' => 'Lahore', 'province' => 'Punjab', 'type' => 'government', 'is_featured' => true],
            ['name' => 'Allied Hospital Faisalabad', 'city' => 'Faisalabad', 'province' => 'Punjab', 'type' => 'government', 'is_featured' => true],
            ['name' => 'DHQ Hospital RYK', 'city' => 'Rahim Yar Khan', 'province' => 'Punjab', 'type' => 'government', 'is_featured' => true],
            ['name' => 'Nishtar Hospital Multan', 'city' => 'Multan', 'province' => 'Punjab', 'type' => 'government', 'is_featured' => true],
            ['name' => 'CMH Lahore', 'city' => 'Lahore', 'province' => 'Punjab', 'type' => 'government', 'is_featured' => true],
            ['name' => 'Mayo Hospital', 'city' => 'Lahore', 'province' => 'Punjab', 'type' => 'government', 'is_featured' => true],
            ['name' => 'Holy Family Hospital', 'city' => 'Rawalpindi', 'province' => 'Punjab', 'type' => 'government', 'is_featured' => true],
        ];

        foreach ($clients as $i => $client) {
            DB::table('clients')->insert(array_merge($client, [
                'sort_order' => $i + 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};