<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'customer_id',
        'appointment_type_id',
        'message',
        'date',
        'hour'	
    ];
}
