<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// app/Models/HisModuleFeature.php

class HisModuleFeature extends Model
{
    protected $table = 'his_module_features';

    protected $fillable = ['module_id', 'feature_text', 'sort_order'];

    public function module(): BelongsTo
    {
        return $this->belongsTo(HisModule::class, 'module_id');
    }
}
