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
        Schema::create('his_module_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')
                ->constrained('his_modules')
                ->cascadeOnDelete();
            // Types: hero | overview | features_grid | workflow | integration | specifications | cta
            $table->string('section_type');
            $table->unsignedInteger('sort_order')->default(0);
            $table->json('settings')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('his_module_sections');
    }
};
