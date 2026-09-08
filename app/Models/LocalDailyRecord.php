<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalDailyRecord extends Model
{
    protected $fillable = [
        'date',
        'sales_total',
        'purchases_total',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'sales_total' => 'decimal:2',
            'purchases_total' => 'decimal:2',
        ];
    }
}
