<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\StoreStatsOverview;
use App\Filament\Widgets\LatestProducts;
use App\Filament\Widgets\LowStockProductsWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            StoreStatsOverview::class,
            LatestProducts::class,
            LowStockProductsWidget::class,
        ];
    }
}
