<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendlyConfigurationHour extends Model
{
    protected $fillable = [
        'business_user_id',
        'hour',
    ];
}
