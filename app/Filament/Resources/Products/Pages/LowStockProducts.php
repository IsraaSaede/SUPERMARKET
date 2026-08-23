<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class LowStockProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected static ?string $title = 'المخزون المنخفض';

    public function getHeading(): string
    {
        return 'المنتجات منخفضة المخزون';
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()
            ->where('is_active', true)
            ->where('stock', '<=', 5)
            ->orderBy('stock', 'asc');
    }
}
