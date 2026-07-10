<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

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
        'social_links' => 'array',
        'is_visible' => 'boolean',
        'is_leadership' => 'boolean',
        'sort_order' => 'integer',
    ];

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
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', preg_replace('/^(Dr\.|Mr\.|Ms\.|Mrs\.)\s*/i', '', $this->name));
        $initials = '';
        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        return $initials ?: strtoupper(substr($this->name, 0, 2));
    }
    public function photoUrl(): ?string
    {
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }
    public function socialLink(string $platform): ?string
    {
        Log::info("Retrieving social link for platform: {$platform} for team member ID {$this->id}");
        Log::info("Current social links: ", $this->social_links);
        Log::info($this->social_links[$platform] ?? null);
        // [{"url":"https://www.linkedin.com/in/shazil-rajpoot-a09a2322a/","platform":"linkedin"}]
        return $this->social_links[$platform] ?? null;
    }

    public function toggle(): void
    {
        $this->update(['is_visible' => !$this->is_visible]);
    }
}
