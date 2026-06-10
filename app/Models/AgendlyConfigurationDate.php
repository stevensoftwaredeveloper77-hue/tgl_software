<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendlyConfigurationDate extends Model
{
    protected $fillable = [
        'business_user_id',
        'date',
    ];
}
