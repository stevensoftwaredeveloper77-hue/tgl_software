<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
   protected $fillable = [
    'customer_id',
    'request_type_id',
    'message',
    'date'	

   ];
}
