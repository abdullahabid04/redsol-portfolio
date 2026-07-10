<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('cat_label')->nullable()->after('category_label');
            $table->string('badge_bg')->nullable()->after('cat_label');
            $table->string('badge_text')->nullable()->after('badge_bg');
            $table->string('card_bg')->default('bg-white')->after('badge_text');
            $table->string('card_text')->default('text-gray-900')->after('card_bg');
            $table->string('accent_bg')->default('bg-crimson-500')->after('card_text');
            $table->string('badge_border')->nullable()->after('accent_bg');
            $table->string('icon_bg')->nullable()->after('badge_border');
            $table->string('icon_border')->nullable()->after('icon_bg');
            $table->string('icon_text')->nullable()->after('icon_border');
            $table->string('card_hover')->nullable()->after('icon_text');
            $table->json('sections')->nullable()->after('card_hover');
            $table->boolean('is_published')->default(true)->after('is_active');
            $table->json('seo')->nullable()->after('is_published');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'cat_label',
                'badge_bg',
                'badge_text',
                'card_bg',
                'card_text',
                'accent_bg',
                'badge_border',
                'icon_bg',
                'icon_border',
                'icon_text',
                'card_hover',
                'sections',
                'is_published',
                'seo',
            ]);
        });
    }
};
