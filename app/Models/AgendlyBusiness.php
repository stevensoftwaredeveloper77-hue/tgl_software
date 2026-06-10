<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendlyBusiness extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'address',
        'phone',
        'email',
        'logo',
        'category_id',
    ];

    protected $appends = [
        'category_name',
        'settings_info'
        ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(AgendlyBusinessCategory::class, 'category_id');
    }

    public function settings()
    {
        return $this->hasOne(AgendlyBussinessSettings::class, 'user_id', 'user_id');
    }

    protected function getCategoryNameAttribute()
    {
        return $this->category?->name ?? 'Sin categoría';
    }

    protected function getSettingsInfoAttribute()
    {
        $settings = $this->settings;

        if (!$settings) {
            return [
                'duration' => 30,
                'availability' => []
            ];
        }

        return [
            'duration'     => $settings->duration,
            'availability' => $settings->availability, 
        ];
    }
}
