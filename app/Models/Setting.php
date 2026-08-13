<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $fillable = [
    'store_name',
    'whatsapp_number',
    'phone',
    'address',
    'logo',
        'delivery_fee',
    'free_delivery_threshold',
];
}
