<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('demo_requests', function (Blueprint $table) {
            $table->id();

            $table->string('hospital_name');
            $table->string('hospital_city')->nullable();
            $table->enum('hospital_type', [
                'government',
                'private',
                'semi-government',
                'ngo',
                'other',
            ])->nullable();
            $table->unsignedSmallInteger('bed_count')->nullable(); // Approximate number of beds

            $table->string('contact_name');
            $table->string('contact_role')->nullable();         // e.g. "Medical Superintendent", "IT Manager"
            $table->string('email');
            $table->string('phone');

            // JSON array of module slugs they expressed interest in
            // e.g. ["laboratory-lims", "pacs", "patient-registration"]
            $table->json('modules_interest')->nullable();

            // Free-text: anything extra they wrote in the request form
            $table->text('requirements')->nullable();

            $table->date('preferred_date')->nullable();
            $table->enum('preferred_time', [
                'morning',      // 9am – 12pm
                'afternoon',    // 12pm – 5pm
                'flexible',
            ])->default('flexible');

            // new         → just submitted
            // contacted   → sales has reached out
            // scheduled   → demo date is confirmed
            // completed   → demo was delivered
            // converted   → became a client
            // lost        → went cold or chose someone else
            $table->enum('status', [
                'new',
                'contacted',
                'scheduled',
                'completed',
                'converted',
                'lost',
            ])->default('new');

            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('admins')
                ->nullOnDelete();
            $table->text('admin_notes')->nullable();            // Internal sales notes
            $table->date('demo_date')->nullable();              // Confirmed demo date
            $table->time('demo_time')->nullable();              // Confirmed demo time
            $table->string('meeting_link')->nullable();         // Zoom / Meet / Teams URL

            $table->string('source')->nullable();               // e.g. "website", "referral", "direct"
            $table->string('ip_address', 45)->nullable();

            $table->timestamps();

            $table->index('status');
            $table->index('created_at');
            $table->index('assigned_to');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demo_requests');
    }
};