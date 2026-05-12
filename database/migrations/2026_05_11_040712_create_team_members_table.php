<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();

            // ── Identity ──────────────────────────────────────
            $table->string('name');
            $table->string('position');                         // e.g. "Chief Executive Officer"
            $table->string('department')->nullable();           // e.g. "Engineering", "Sales"

            // ── Bio ───────────────────────────────────────────
            $table->text('bio')->nullable();                    // Short paragraph shown on about/team page

            // ── Media ─────────────────────────────────────────
            $table->string('photo')->nullable();                // Path: storage/app/public/team/...
            $table->string('photo_alt')->nullable();

            // ── Social links ──────────────────────────────────
            // Stored as a JSON object for flexibility:
            // {"linkedin": "https://...", "twitter": "https://...", "email": "name@redsol.com"}
            $table->json('social_links')->nullable();

            // ── Display control ───────────────────────────────
            $table->unsignedSmallInteger('sort_order')->default(0);  // Drag-and-drop order on the team page
            $table->boolean('is_visible')->default(true);       // Show/hide on public site
            $table->boolean('is_leadership')->default(false);   // Appears in leadership section vs general team

            $table->timestamps();

            $table->index('is_visible');
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};