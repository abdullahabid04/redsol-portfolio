<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// app/Models/HisModuleSection.php

class HisModuleSection extends Model
{
    protected $table = 'his_module_sections';

    protected $fillable = [
        'module_id', 'section_type', 'sort_order', 'settings', 'is_active',
    ];

    protected $casts = [
        'settings' => 'array',
        'is_active' => 'boolean',
    ];

    public function module(): BelongsTo
    {
        return $this->belongsTo(HisModule::class, 'module_id');
    }
}
