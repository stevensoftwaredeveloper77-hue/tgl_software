<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendlyBussinessSettings extends Model
{
    protected $fillable = ['availability', 'duration', 'user_id'];

  
    protected $casts = [
        'availability' => 'array', 
        'duration' => 'integer',
    ];

    public function business()
    {
        return $this->belongsTo(AgendlyBusiness::class, 'user_id', 'user_id');
    }
}
