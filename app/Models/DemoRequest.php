<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DemoRequest extends Model
{
    protected $table = 'demo_requests';

    protected $fillable = [
        'hospital_name',
        'hospital_city',
        'hospital_type',
        'bed_count',
        'contact_name',
        'contact_role',
        'email',
        'phone',
        'modules_interest',
        'requirements',
        'preferred_date',
        'preferred_time',
        'status',
        'assigned_to',
        'admin_notes',
        'demo_date',
        'demo_time',
        'meeting_link',
        'source',
        'ip_address',
    ];

    protected $casts = [
        'modules_interest' => 'array',
        'preferred_date' => 'date',
        'demo_date' => 'date',
        'bed_count' => 'integer',
    ];

    // ── Status constants ─────────────────────────────────────
    const STATUS_NEW = 'new';
    const STATUS_CONTACTED = 'contacted';
    const STATUS_SCHEDULED = 'scheduled';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CONVERTED = 'converted';
    const STATUS_LOST = 'lost';

    const STATUSES = [
        self::STATUS_NEW => 'New',
        self::STATUS_CONTACTED => 'Contacted',
        self::STATUS_SCHEDULED => 'Scheduled',
        self::STATUS_COMPLETED => 'Completed',
        self::STATUS_CONVERTED => 'Converted',
        self::STATUS_LOST => 'Lost',
    ];

    // ── Hospital type constants ───────────────────────────────
    const TYPES = [
        'government' => 'Government',
        'private' => 'Private',
        'semi-government' => 'Semi-Government',
        'ngo' => 'NGO',
        'other' => 'Other',
    ];

    // ── Relationships ────────────────────────────────────────

    public function assignedAdmin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'assigned_to');
    }

    // ── Scopes ───────────────────────────────────────────────

    public function scopeNew($query)
    {
        return $query->where('status', self::STATUS_NEW);
    }

    public function scopeActive($query)
    {
        return $query->whereNotIn('status', [
            self::STATUS_CONVERTED,
            self::STATUS_LOST,
        ]);
    }

    public function scopeAssignedTo($query, int $adminId)
    {
        return $query->where('assigned_to', $adminId);
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
            self::STATUS_CONTACTED => 'bg-blue-100 text-blue-700 border-blue-200',
            self::STATUS_SCHEDULED => 'bg-yellow-100 text-yellow-700 border-yellow-200',
            self::STATUS_COMPLETED => 'bg-purple-100 text-purple-700 border-purple-200',
            self::STATUS_CONVERTED => 'bg-green-100 text-green-700 border-green-200',
            self::STATUS_LOST => 'bg-gray-100 text-gray-500 border-gray-200',
            default => 'bg-gray-100 text-gray-500 border-gray-200',
        };
    }

    public function hospitalTypeLabel(): string
    {
        return self::TYPES[$this->hospital_type] ?? ucfirst($this->hospital_type ?? '');
    }

    /**
     * Returns module names from slugs for display.
     * Resolves against the Product model.
     */
    public function moduleNames(): \Illuminate\Support\Collection
    {
        if (empty($this->modules_interest)) {
            return collect();
        }

        return Product::whereIn('slug', $this->modules_interest)
            ->pluck('name');
    }

    /**
     * How many days since this request was submitted.
     */
    public function daysOld(): int
    {
        return (int) $this->created_at->diffInDays(now());
    }

    // ── Helpers ──────────────────────────────────────────────

    public function advanceTo(string $status): void
    {
        if (array_key_exists($status, self::STATUSES)) {
            $this->update(['status' => $status]);
        }
    }

    public function isActive(): bool
    {
        return !in_array($this->status, [
            self::STATUS_CONVERTED,
            self::STATUS_LOST,
        ]);
    }

    /**
     * Count of new unassigned demo requests — for the sidebar badge.
     */
    public static function newCount(): int
    {
        return static::where('status', self::STATUS_NEW)->count();
    }
}