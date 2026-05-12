<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'assigned_to',
        'admin_notes',
        'replied_at',
        'replied_by',
        'ip_address',
        'user_agent',
        'is_spam',
    ];

    protected $casts = [
        'replied_at' => 'datetime',
        'is_spam' => 'boolean',
    ];

    // ── Status constants ─────────────────────────────────────
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

    // ── Relationships ────────────────────────────────────────

    public function assignedAdmin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'assigned_to');
    }

    public function repliedByAdmin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'replied_by');
    }

    // ── Scopes ───────────────────────────────────────────────

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

    public function scopeLatest($query)
    {
        return $query->orderByDesc('created_at');
    }

    // ── Accessors ────────────────────────────────────────────

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst($this->status);
    }

    public function statusBadgeClass(): string
    {
        return match ($this->status) {
            self::STATUS_NEW => 'bg-crimson-500/10 text-crimson-600 border-crimson-500/20',
            self::STATUS_READ => 'bg-blue-100 text-blue-700 border-blue-200',
            self::STATUS_REPLIED => 'bg-green-100 text-green-700 border-green-200',
            self::STATUS_ARCHIVED => 'bg-gray-100 text-gray-500 border-gray-200',
            default => 'bg-gray-100 text-gray-500 border-gray-200',
        };
    }

    /**
     * Short preview of the message for listing views.
     */
    public function messagePreview(int $chars = 100): string
    {
        return strlen($this->message) > $chars
            ? substr($this->message, 0, $chars) . '…'
            : $this->message;
    }

    // ── Helpers ──────────────────────────────────────────────

    /**
     * Mark as read if it's currently new.
     */
    public function markAsRead(): void
    {
        if ($this->status === self::STATUS_NEW) {
            $this->update(['status' => self::STATUS_READ]);
        }
    }

    public function markAsReplied(Admin $admin): void
    {
        $this->update([
            'status' => self::STATUS_REPLIED,
            'replied_at' => now(),
            'replied_by' => $admin->id,
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

    /**
     * Count of unread (new) submissions — for the sidebar badge.
     */
    public static function unreadCount(): int
    {
        return static::where('status', self::STATUS_NEW)
            ->where('is_spam', false)
            ->count();
    }
}