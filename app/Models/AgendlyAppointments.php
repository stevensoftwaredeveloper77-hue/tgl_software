<?php

namespace App\Models;

use App\Models\User;
use App\Models\AgendlyStates AS State;
use Illuminate\Database\Eloquent\Model;

class AgendlyAppointments extends Model
{
    protected $fillable = [
        'customer_user_id',
        'business_user_id',
        'date',
        'hour',
        'state_id',
        'reason',
    ];

    protected $appends = ['customer_info', 'business_info', 'state_name'];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_user_id');
    }

    public function business()
    {
        return $this->belongsTo(AgendlyBusiness::class, 'business_user_id', 'user_id');
    }

    public function status()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function getCustomerInfoAttribute()
    {
        return $this->customer()->first(); 
    }

    public function getBusinessInfoAttribute()
    {
        return $this->business()->first();
    }

    public function getStateNameAttribute()
    {
        return $this->status()->first()->name;
    }
}
