<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInquiry extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'company',
        'country',
        'department',
        'service_interest',
        'message',
        'status',
        'ip_address',
    ];
}
