<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $table = 'team_members';

    protected $fillable = [
        'name',
        'position',
        'department',
        'bio',
        'photo',
        'photo_alt',
        'social_links',
        'sort_order',
        'is_visible',
        'is_leadership',
    ];

    protected $casts = [
        'social_links'  => 'array',
        'is_visible'    => 'boolean',
        'is_leadership' => 'boolean',
        'sort_order'    => 'integer',
    ];

    // ── Scopes ───────────────────────────────────────────────

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeLeadership($query)
    {
        return $query->where('is_leadership', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    // ── Accessors ────────────────────────────────────────────

    /**
     * Returns the member's initials for avatar fallback.
     * "Dr. Muhammad Arif" → "MA"
     */
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', preg_replace('/^(Dr\.|Mr\.|Ms\.|Mrs\.)\s*/i', '', $this->name));
        $initials = '';
        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        return $initials ?: strtoupper(substr($this->name, 0, 2));
    }

    /**
     * Returns the photo URL or null if no photo is stored.
     * Usage in Blade: {{ $member->photoUrl() ?? '/images/placeholder.png' }}
     */
    public function photoUrl(): ?string
    {
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }

    /**
     * Pull a specific social link by key.
     * Usage: $member->socialLink('linkedin')
     */
    public function socialLink(string $platform): ?string
    {
        return $this->social_links[$platform] ?? null;
    }

    // ── Helpers ──────────────────────────────────────────────

    public function toggle(): void
    {
        $this->update(['is_visible' => ! $this->is_visible]);
    }
}
