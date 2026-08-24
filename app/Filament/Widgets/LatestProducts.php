<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\Widget;

class LatestProducts extends Widget
{
    protected string $view = 'filament.widgets.latest-products';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = [
        'default' => 'full',
        'lg' => 2,
    ];

    public function getProducts()
    {
        return Product::query()
            ->with('category')
            ->latest()
            ->limit(6)
            ->get();
    }
}
