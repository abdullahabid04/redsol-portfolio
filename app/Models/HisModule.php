<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

// app/Models/HisModule.php

class HisModule extends Model
{
    protected $table = 'his_modules';

    protected $fillable = [
        'name', 'slug', 'icon', 'tagline', 'description',
        'category', 'cat_label', 'badge_bg', 'badge_text',
        'card_bg', 'card_text', 'accent_bg',
        'sort_order', 'is_published', 'seo',
    ];

    protected $casts = [
        'seo' => 'array',
        'is_published' => 'boolean',
    ];

    public function features(): HasMany
    {
        return $this->hasMany(HisModuleFeature::class, 'module_id')
            ->orderBy('sort_order');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(HisModuleSection::class, 'module_id')
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeByCategory(Builder $query, string $cat): Builder
    {
        return $query->where('category', $cat);
    }
}
