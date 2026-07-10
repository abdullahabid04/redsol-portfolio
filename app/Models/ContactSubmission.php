<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    protected $table = 'contact_submissions';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'organisation',
        'subject',
        'message',
        'status',
        'ip_address',
        'user_agent',
        'is_spam',
    ];

    protected $casts = [
        'is_spam' => 'boolean',
    ];

    const STATUS_NEW = 'new';
    const STATUS_READ = 'read';
    const STATUS_REPLIED = 'replied';
    const STATUS_ARCHIVED = 'archived';

    const STATUSES = [
        self::STATUS_NEW => 'New',
        self::STATUS_READ => 'Read',
        self::STATUS_REPLIED => 'Replied',
        self::STATUS_ARCHIVED => 'Archived',
    ];

    public function scopeNew($query)
    {
        return $query->where('status', self::STATUS_NEW);
    }

    public function scopeUnread($query)
    {
        return $query->whereIn('status', [self::STATUS_NEW, self::STATUS_READ]);
    }

    public function scopeNotSpam($query)
    {
        return $query->where('is_spam', false);
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderByDesc('created_at');
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst($this->status);
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_NEW => 'bg-crimson-500/10 text-crimson-600 border-crimson-500/20',
            self::STATUS_READ => 'bg-blue-100 text-blue-700 border-blue-200',
            self::STATUS_REPLIED => 'bg-green-100 text-green-700 border-green-200',
            self::STATUS_ARCHIVED => 'bg-gray-100 text-gray-500 border-gray-200',
            default => 'bg-gray-100 text-gray-500 border-gray-200',
        };
    }
    public function getMessagePreviewAttribute(int $chars = 100): string
    {
        $message = $this->message ?? '';
        return strlen($message) > $chars
            ? substr($message, 0, $chars) . '…'
            : $message;
    }
    public function markAsRead(): void
    {
        if ($this->status === self::STATUS_NEW) {
            $this->update(['status' => self::STATUS_READ]);
        }
    }
    public function markAsReplied(): void
    {
        $this->update([
            'status' => self::STATUS_REPLIED,
        ]);
    }
    public function archive(): void
    {
        $this->update(['status' => self::STATUS_ARCHIVED]);
    }
    public function flagAsSpam(): void
    {
        $this->update(['is_spam' => true, 'status' => self::STATUS_ARCHIVED]);
    }
    public function restoreToRead(): void
    {
        $this->update(['is_spam' => false, 'status' => self::STATUS_READ]);
    }
    public static function unreadCount(): int
    {
        return static::where('is_spam', false)
            ->whereIn('status', [self::STATUS_NEW, self::STATUS_READ])
            ->count();
    }
    public static function newCount(): int
    {
        return static::where('status', self::STATUS_NEW)
            ->where('is_spam', false)
            ->count();
    }
}