<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'category',
        'category_label',
        'cat_label',
        'tag',
        'icon',
        'tagline',
        'description',
        'features',
        'href',
        'sort_order',
        'is_active',
        'is_published',
        'meta_title',
        'meta_description',
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
        'seo',
    ];

    protected $casts = [
        'features' => 'array',
        'sections' => 'array',
        'seo' => 'array',
        'is_active' => 'boolean',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    const CAT_ADMINISTRATION = 'administration';
    const CAT_PATIENT_JOURNEY = 'patient-journey';
    const CAT_CLINICAL = 'clinical';
    const CAT_DIAGNOSTICS = 'diagnostics';
    const CAT_OPERATIONS = 'operations';

    const CATEGORIES = [
        self::CAT_ADMINISTRATION => 'Administration & Security',
        self::CAT_PATIENT_JOURNEY => 'Patient Journey',
        self::CAT_CLINICAL => 'Clinical & Departmental',
        self::CAT_DIAGNOSTICS => 'Diagnostics & Imaging',
        self::CAT_OPERATIONS => 'Operations & Supply',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function scopeInCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByCategory(Builder $query, string $cat): Builder
    {
        return $query->where('category', $cat);
    }
    public static function grouped(): \Illuminate\Support\Collection
    {
        return static::active()
            ->ordered()
            ->get()
            ->groupBy('category');
    }

    public function features(): HasMany
    {
        return $this->hasMany(ProductFeature::class, 'product_id')
            ->orderBy('sort_order');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(ProductSection::class, 'product_id')
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    public function getMetaTitleAttribute($value): string
    {
        return $value ?: $this->name . ' | REDSOL HIS';
    }

    public function getFeaturesAttribute($value)
    {
        if ($this->relationLoaded('features')) {
            return $this->getRelationValue('features');
        }

        if ($this->relationLoaded('featureItems')) {
            return $this->getRelationValue('featureItems');
        }

        if ($value === null || $value === '') {
            return $this->getRelationValue('features');
        }

        if (is_array($value)) {
            return $value;
        }

        $decoded = json_decode($value, true);
        if (is_array($decoded)) {
            return collect($decoded)->map(function ($item) {
                if (is_array($item)) {
                    return (object) $item;
                }

                return (object) ['feature_text' => (string) $item];
            });
        }

        return collect();
    }

    public function getSectionsAttribute($value)
    {
        if ($this->relationLoaded('sections')) {
            return $this->getRelationValue('sections');
        }

        if ($value === null || $value === '') {
            return $this->getRelationValue('sections');
        }

        if (is_array($value)) {
            return collect($value)->map(function ($item) {
                return (object) $item;
            });
        }

        $decoded = json_decode($value, true);
        if (is_array($decoded)) {
            return collect($decoded)->map(function ($item) {
                return (object) $item;
            });
        }

        return collect();
    }

    public function setFeaturesAttribute($value): void
    {
        $this->attributes['features'] = is_array($value) ? json_encode(array_values(array_filter(array_map('trim', $value)))) : $value;
    }
    public function hasDarkBackground(): bool
    {
        return in_array($this->category, [
            self::CAT_ADMINISTRATION,
            self::CAT_DIAGNOSTICS,
        ]);
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Product $product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
            if (empty($product->href)) {
                $product->href = '/products/' . $product->slug;
            }
            // Set category_label from the constants map if not explicitly provided
            if (empty($product->category_label) && isset(self::CATEGORIES[$product->category])) {
                $product->category_label = self::CATEGORIES[$product->category];
            }
        });
    }

    public function toggle(): void
    {
        $this->update(['is_active' => !$this->is_active]);
    }

    public function categoryLabel(): string
    {
        return self::CATEGORIES[$this->category] ?? ucfirst($this->category);
    }
}
