<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    protected $table = 'blog_posts';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'featured_image',
        'featured_image_alt',
        'category',
        'tags',
        'author_id',
        'status',
        'published_at',
        'meta_title',
        'meta_description',
        'read_time_minutes',
        'view_count',
    ];

    protected $casts = [
        'tags'              => 'array',
        'published_at'      => 'datetime',
        'read_time_minutes' => 'integer',
        'view_count'        => 'integer',
    ];

    // ── Status constants ─────────────────────────────────────
    const STATUS_DRAFT     = 'draft';
    const STATUS_PUBLISHED = 'published';
    const STATUS_ARCHIVED  = 'archived';

    // ── Relationships ────────────────────────────────────────

    public function author(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'author_id');
    }

    // ── Scopes ───────────────────────────────────────────────

    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED)
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', self::STATUS_DRAFT);
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    // ── Accessors ────────────────────────────────────────────

    /**
     * Fallback to title if meta_title is not set.
     */
    public function getMetaTitleAttribute($value): string
    {
        return $value ?: $this->title;
    }

    /**
     * Returns a status badge Tailwind class string.
     */
    public function statusBadgeClass(): string
    {
        return match($this->status) {
            self::STATUS_PUBLISHED => 'bg-green-100 text-green-700 border-green-200',
            self::STATUS_DRAFT     => 'bg-yellow-100 text-yellow-700 border-yellow-200',
            self::STATUS_ARCHIVED  => 'bg-gray-100 text-gray-500 border-gray-200',
            default                => 'bg-gray-100 text-gray-500 border-gray-200',
        };
    }

    public function statusLabel(): string
    {
        return ucfirst($this->status);
    }

    // ── Mutators / Boot ──────────────────────────────────────

    protected static function boot(): void
    {
        parent::boot();

        // Auto-generate slug from title on create if not provided
        static::creating(function (BlogPost $post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });

        // Auto-calculate read time from body word count
        static::saving(function (BlogPost $post) {
            if ($post->isDirty('body') && $post->body) {
                $wordCount = str_word_count(strip_tags($post->body));
                $post->read_time_minutes = (int) max(1, ceil($wordCount / 200));
            }
        });
    }

    // ── Helpers ──────────────────────────────────────────────

    public function isPublished(): bool
    {
        return $this->status === self::STATUS_PUBLISHED;
    }

    public function isDraft(): bool
    {
        return $this->status === self::STATUS_DRAFT;
    }

    /**
     * Increment view count without triggering model events.
     */
    public function incrementViews(): void
    {
        $this->increment('view_count');
    }
}
