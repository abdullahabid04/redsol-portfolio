<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'name',
        'city',
        'province',
        'logo_path',
        'logo_alt',
        'type',
        'is_featured',
        'is_active',
        'sort_order',
        'website_url',
        'year_deployed',
        'notes',
    ];

    protected $casts = [
        'is_featured'   => 'boolean',
        'is_active'     => 'boolean',
        'sort_order'    => 'integer',
        'year_deployed' => 'integer',
    ];

    // ── Type constants ───────────────────────────────────────
    const TYPE_GOVERNMENT      = 'government';
    const TYPE_PRIVATE         = 'private';
    const TYPE_SEMI_GOVERNMENT = 'semi-government';
    const TYPE_NGO             = 'ngo';

    const TYPES = [
        self::TYPE_GOVERNMENT      => 'Government',
        self::TYPE_PRIVATE         => 'Private',
        self::TYPE_SEMI_GOVERNMENT => 'Semi-Government',
        self::TYPE_NGO             => 'NGO',
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

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    // ── Accessors ────────────────────────────────────────────

    public function logoUrl(): ?string
    {
        return $this->logo_path ? asset('storage/' . $this->logo_path) : null;
    }

    public function typeLabel(): string
    {
        return self::TYPES[$this->type] ?? ucfirst($this->type);
    }

    public function typeBadgeClass(): string
    {
        return match($this->type) {
            self::TYPE_GOVERNMENT      => 'bg-blue-100 text-blue-700 border-blue-200',
            self::TYPE_PRIVATE         => 'bg-purple-100 text-purple-700 border-purple-200',
            self::TYPE_SEMI_GOVERNMENT => 'bg-orange-100 text-orange-700 border-orange-200',
            self::TYPE_NGO             => 'bg-green-100 text-green-700 border-green-200',
            default                    => 'bg-gray-100 text-gray-600 border-gray-200',
        };
    }

    /**
     * Full location string: "Lahore, Punjab"
     */
    public function locationString(): string
    {
        return collect([$this->city, $this->province])
            ->filter()
            ->implode(', ');
    }

    // ── Helpers ──────────────────────────────────────────────

    public function toggleFeatured(): void
    {
        $this->update(['is_featured' => ! $this->is_featured]);
    }

    public function toggle(): void
    {
        $this->update(['is_active' => ! $this->is_active]);
    }
}
