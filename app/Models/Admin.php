<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';
    protected $table = 'admins';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'is_active' => 'boolean',
        'last_login_at' => 'datetime',
    ];

    public function blogPosts(): HasMany
    {
        return $this->hasMany(BlogPost::class, 'author_id');
    }

    public function assignedContacts(): HasMany
    {
        return $this->hasMany(ContactSubmission::class, 'assigned_to');
    }

    public function repliedContacts(): HasMany
    {
        return $this->hasMany(ContactSubmission::class, 'replied_by');
    }

    public function assignedDemoRequests(): HasMany
    {
        return $this->hasMany(DemoRequest::class, 'assigned_to');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    public function can($permission, $arguments = []): bool
    {
        return true;
    }

    public function roleLabel(): string
    {
        return 'Admin';
    }

    public function roleBadgeClass(): string
    {
        return 'bg-crimson-500/10 text-crimson-600 border-crimson-500/20';
    }

    public function recordLogin(): void
    {
        $this->update(['last_login_at' => now()]);
    }

    public function deactivate(): void
    {
        $this->update(['is_active' => false]);
    }

    public function activate(): void
    {
        $this->update(['is_active' => true]);
    }

    public function toggle(): void
    {
        $this->update(['is_active' => !$this->is_active]);
    }
}