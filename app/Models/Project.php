<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'title',
        'slug',
        'client_name',
        'client_city',
        'client_province',
        'client_type',
        'summary',
        'description',
        'modules_deployed',
        'outcomes',
        'featured_image',
        'featured_image_alt',
        'gallery',
        'start_date',
        'completion_date',
        'duration_months',
        'stats',
        'testimonial_id',
        'services_provided',
        'meta_title',
        'meta_description',
        'is_active',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'modules_deployed' => 'array',
        'outcomes' => 'array',
        'gallery' => 'array',
        'stats' => 'array',
        'services_provided' => 'array',
        'start_date' => 'date',
        'completion_date' => 'date',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
        'duration_months' => 'integer',
    ];

    const TYPE_GOVERNMENT = 'government';
    const TYPE_PRIVATE = 'private';
    const TYPE_SEMI_GOVERNMENT = 'semi-government';
    const TYPE_NGO = 'ngo';
    const TYPE_OTHER = 'other';

    const CLIENT_TYPES = [
        self::TYPE_GOVERNMENT => 'Government',
        self::TYPE_PRIVATE => 'Private',
        self::TYPE_SEMI_GOVERNMENT => 'Semi-Government',
        self::TYPE_NGO => 'NGO',
        self::TYPE_OTHER => 'Other',
    ];
    public function testimonial(): BelongsTo
    {
        return $this->belongsTo(Testimonial::class, 'testimonial_id');
    }

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
        return $query->orderBy('sort_order')->orderByDesc('completion_date');
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('client_type', $type);
    }

    public function scopeSearch($query, string $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
                ->orWhere('client_name', 'like', "%{$term}%")
                ->orWhere('summary', 'like', "%{$term}%")
                ->orWhere('client_city', 'like', "%{$term}%");
        });
    }
    public function getMetaTitleAttribute($value): string
    {
        return $value ?: $this->title . ' | REDSOL';
    }
    public function getMetaDescriptionAttribute($value): string
    {
        return $value ?: Str::limit(strip_tags($this->summary), 155);
    }
    public function featuredImageUrl(): ?string
    {
        return $this->featured_image
            ? asset('storage/' . $this->featured_image)
            : null;
    }
    public function galleryUrls(): array
    {
        if (empty($this->gallery))
            return [];
        return array_map(fn($path) => asset('storage/' . $path), $this->gallery);
    }
    public function clientTypeLabel(): string
    {
        return self::CLIENT_TYPES[$this->client_type] ?? ucfirst($this->client_type ?? '');
    }
    public function clientTypeBadgeClass(): string
    {
        return match ($this->client_type) {
            self::TYPE_GOVERNMENT => 'bg-blue-50 text-blue-700 border-blue-200',
            self::TYPE_PRIVATE => 'bg-purple-50 text-purple-700 border-purple-200',
            self::TYPE_SEMI_GOVERNMENT => 'bg-orange-50 text-orange-700 border-orange-200',
            self::TYPE_NGO => 'bg-green-50 text-green-700 border-green-200',
            default => 'bg-gray-100 text-gray-600 border-gray-200',
        };
    }
    public function locationString(): string
    {
        return collect([$this->client_city, $this->client_province])
            ->filter()
            ->implode(', ');
    }
    public function durationLabel(): string
    {
        $months = $this->duration_months;

        if (!$months && $this->start_date && $this->completion_date) {
            $months = (int) $this->start_date->diffInMonths($this->completion_date);
        }

        if (!$months)
            return 'Ongoing';

        if ($months < 1)
            return 'Under 1 month';
        if ($months === 1)
            return '1 month';
        if ($months < 12)
            return "{$months} months";

        $years = intdiv($months, 12);
        $rem = $months % 12;
        $label = $years . ' year' . ($years > 1 ? 's' : '');
        if ($rem)
            $label .= ' ' . $rem . ' month' . ($rem > 1 ? 's' : '');
        return $label;
    }
    public function moduleCount(): int
    {
        return is_array($this->modules_deployed) ? count($this->modules_deployed) : 0;
    }
    public function moduleNames(): \Illuminate\Support\Collection
    {
        if (empty($this->modules_deployed))
            return collect();

        return Product::whereIn('slug', $this->modules_deployed)
            ->pluck('name');
    }
    public function serviceNames(): \Illuminate\Support\Collection
    {
        if (empty($this->services_provided))
            return collect();

        return Service::whereIn('slug', $this->services_provided)
            ->pluck('name');
    }
    public function summaryPreview(int $chars = 120): string
    {
        return Str::limit(strip_tags($this->summary), $chars);
    }

    protected static function boot(): void
    {
        parent::boot();

        // Auto-generate slug from title on create
        static::creating(function (Project $project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });

        // Auto-calculate duration_months when both dates are present
        static::saving(function (Project $project) {
            if (
                $project->start_date &&
                $project->completion_date &&
                !$project->duration_months
            ) {
                $project->duration_months = (int) $project->start_date
                    ->diffInMonths($project->completion_date);
            }
        });
    }

    public function toggle(): void
    {
        $this->update(['is_active' => !$this->is_active]);
    }

    public function toggleFeatured(): void
    {
        $this->update(['is_featured' => !$this->is_featured]);
    }
    public static function activeCount(): int
    {
        return static::where('is_active', true)->count();
    }
    public static function featuredCount(): int
    {
        return static::where('is_featured', true)->count();
    }
}