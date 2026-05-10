<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // database/migrations/xxxx_create_his_modules_table.php

        Schema::create('his_modules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon')->default('🏥');
            $table->string('tagline')->nullable();
            $table->text('description')->nullable();
            $table->string('category');                   // e.g. 'administration', 'clinical'
            $table->string('cat_label');                  // e.g. 'Administration', 'Clinical'
            $table->string('badge_bg')->nullable();       // Tailwind class
            $table->string('badge_text')->nullable();
            $table->string('card_bg')->default('bg-white');
            $table->string('card_text')->default('text-gray-900');
            $table->string('accent_bg')->default('bg-crimson-500');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->json('seo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('his_modules');
    }
};
