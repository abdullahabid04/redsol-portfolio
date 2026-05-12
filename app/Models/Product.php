<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'slug',
        'category',
        'category_label',
        'tag',
        'icon',
        'tagline',
        'description',
        'features',
        'href',
        'sort_order',
        'is_active',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'features'   => 'array',
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    // ── Category constants ───────────────────────────────────
    const CAT_ADMINISTRATION  = 'administration';
    const CAT_PATIENT_JOURNEY = 'patient-journey';
    const CAT_CLINICAL        = 'clinical';
    const CAT_DIAGNOSTICS     = 'diagnostics';
    const CAT_OPERATIONS      = 'operations';

    const CATEGORIES = [
        self::CAT_ADMINISTRATION  => 'Administration & Security',
        self::CAT_PATIENT_JOURNEY => 'Patient Journey',
        self::CAT_CLINICAL        => 'Clinical & Departmental',
        self::CAT_DIAGNOSTICS     => 'Diagnostics & Imaging',
        self::CAT_OPERATIONS      => 'Operations & Supply',
    ];

    // ── Scopes ───────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function scopeInCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Returns products grouped by category in display order.
     * Usage: Product::grouped()
     */
    public static function grouped(): \Illuminate\Support\Collection
    {
        return static::active()
            ->ordered()
            ->get()
            ->groupBy('category');
    }

    // ── Accessors ────────────────────────────────────────────

    public function getMetaTitleAttribute($value): string
    {
        return $value ?: $this->name . ' | REDSOL HIS';
    }

    /**
     * Whether this category renders with a dark background on the products page.
     */
    public function hasDarkBackground(): bool
    {
        return in_array($this->category, [
            self::CAT_ADMINISTRATION,
            self::CAT_DIAGNOSTICS,
        ]);
    }

    // ── Boot ─────────────────────────────────────────────────

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

    // ── Helpers ──────────────────────────────────────────────

    public function toggle(): void
    {
        $this->update(['is_active' => ! $this->is_active]);
    }

    public function categoryLabel(): string
    {
        return self::CATEGORIES[$this->category] ?? ucfirst($this->category);
    }
}
