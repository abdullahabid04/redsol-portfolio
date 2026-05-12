<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contact_submissions', function (Blueprint $table) {
            $table->id();

            // ── Submitter details ─────────────────────────────
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('organisation')->nullable();         // Hospital / company name
            $table->string('subject')->nullable();              // Optional subject line

            // ── Message ───────────────────────────────────────
            $table->text('message');

            // ── Status workflow ───────────────────────────────
            // new      → just submitted, nobody has looked at it
            // read     → an admin has opened it
            // replied  → a response has been sent
            // archived → no action needed, moved out of inbox
            $table->enum('status', ['new', 'read', 'replied', 'archived'])
                ->default('new');

            // ── Admin tracking ────────────────────────────────
            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('admins')
                ->nullOnDelete();                             // Which sales/admin is handling it
            $table->text('admin_notes')->nullable();            // Internal notes — not visible to submitter
            $table->timestamp('replied_at')->nullable();        // When a reply was sent
            $table->foreignId('replied_by')
                ->nullable()
                ->constrained('admins')
                ->nullOnDelete();

            // ── Security / audit ──────────────────────────────
            $table->string('ip_address', 45)->nullable();       // IPv4 or IPv6
            $table->text('user_agent')->nullable();
            $table->boolean('is_spam')->default(false);         // Flag obvious spam

            $table->timestamps();

            // ── Indexes for the admin listing/filtering ───────
            $table->index('status');
            $table->index('created_at');
            $table->index('is_spam');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_submissions');
    }
};