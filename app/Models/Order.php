<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{

    protected $fillable = [
        'customer_name',
        'phone',
        'area',
        'street',
        'building',
        'floor',
        'notes',
        'subtotal',
        'delivery_fee',
        'total',
        'status',
    ];


    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

}
