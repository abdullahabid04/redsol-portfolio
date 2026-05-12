<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();

            // ── Content ───────────────────────────────────────
            $table->string('title');
            $table->string('slug')->unique();                   // URL-friendly, auto-generated from title
            $table->text('excerpt')->nullable();                // Short summary shown on listing pages
            $table->longText('body');                           // Full post content (HTML or Markdown)

            // ── Media ─────────────────────────────────────────
            $table->string('featured_image')->nullable();       // Stored path: storage/app/public/blog/...
            $table->string('featured_image_alt')->nullable();   // Alt text for accessibility + SEO

            // ── Categorisation ────────────────────────────────
            $table->string('category')->nullable();             // e.g. "HIS Implementation", "Digital Health"
            $table->json('tags')->nullable();                   // ["pacs","lims","radiology"] — array of strings

            // ── Authorship ────────────────────────────────────
            $table->foreignId('author_id')
                ->constrained('admins')
                ->restrictOnDelete();                         // Can't delete an admin who has posts

            // ── Publication ───────────────────────────────────
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();      // Null = not yet published

            // ── SEO ───────────────────────────────────────────
            $table->string('meta_title')->nullable();           // Falls back to title if null
            $table->text('meta_description')->nullable();       // 150-160 chars recommended

            // ── Engagement ────────────────────────────────────
            $table->unsignedInteger('read_time_minutes')
                ->default(0);                                 // Auto-calculated on save
            $table->unsignedBigInteger('view_count')->default(0);

            $table->timestamps();

            // ── Indexes ───────────────────────────────────────
            $table->index('status');
            $table->index('published_at');
            $table->index('category');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};