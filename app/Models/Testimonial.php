<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'testimonials';

    protected $fillable = [
        'quote',
        'author_name',
        'author_role',
        'author_initials',
        'hospital',
        'photo',
        'avatar_gradient',
        'rating',
        'is_active',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

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

    public function photoUrl(): ?string
    {
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }
    public function starsArray(): array
    {
        return array_map(
            fn($i) => $i <= $this->rating,
            range(1, 5)
        );
    }
    public function getAuthorInitialsAttribute($value): string
    {
        if ($value)
            return $value;

        $words = explode(' ', preg_replace('/^(Dr\.|Mr\.|Ms\.|Mrs\.)\s*/i', '', $this->author_name));
        $initials = '';
        foreach (array_slice($words, 0, 2) as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }
        return $initials;
    }

    public function toggle(): void
    {
        $this->update(['is_active' => !$this->is_active]);
    }
}
