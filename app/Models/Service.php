<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'name',
        'slug',
        'tagline',
        'description',
        'icon',
        'tag',
        'features',
        'href',
        'sort_order',
        'is_active',
        'is_featured',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'features'    => 'array',
        'is_active'   => 'boolean',
        'is_featured' => 'boolean',
        'sort_order'  => 'integer',
    ];

    // ── Tag constants ────────────────────────────────────────
    const TAG_HIS      = 'HIS-Related';
    const TAG_CUSTOM   = 'Custom Dev';
    const TAG_SUPPORT  = 'Support';
    const TAG_ADVISORY = 'Advisory';

    const TAGS = [
        self::TAG_HIS,
        self::TAG_CUSTOM,
        self::TAG_SUPPORT,
        self::TAG_ADVISORY,
    ];

    // ── Scopes ───────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    // ── Accessors ────────────────────────────────────────────

    public function getMetaTitleAttribute($value): string
    {
        return $value ?: $this->name;
    }

    /**
     * Returns Tailwind badge classes matching the red/white/black theme.
     */
    public function tagBadgeClass(): string
    {
        return match($this->tag) {
            self::TAG_HIS      => 'bg-crimson-500/10 text-crimson-600 border-crimson-500/25',
            self::TAG_CUSTOM   => 'bg-gray-100 text-gray-600 border-gray-200',
            self::TAG_SUPPORT  => 'bg-gray-100 text-gray-600 border-gray-200',
            self::TAG_ADVISORY => 'bg-gray-100 text-gray-600 border-gray-200',
            default            => 'bg-gray-100 text-gray-600 border-gray-200',
        };
    }

    // ── Boot ─────────────────────────────────────────────────

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Service $service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->name);
            }
            if (empty($service->href)) {
                $service->href = '/services/' . $service->slug;
            }
        });
    }

    // ── Helpers ──────────────────────────────────────────────

    public function toggle(): void
    {
        $this->update(['is_active' => ! $this->is_active]);
    }
}
