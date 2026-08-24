<?php

namespace App\Filament\Resources\Orders\Pages;

use App\Filament\Resources\Orders\OrderResource;
use App\Filament\Widgets\OrderStatsOverview;
use App\Filament\Widgets\BestSellingProducts;
use App\Filament\Widgets\TopAreasOrders;
use App\Filament\Widgets\OrderSalesChart;
use Filament\Resources\Pages\ListRecords;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            OrderStatsOverview::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            BestSellingProducts::class,
            TopAreasOrders::class,
            OrderSalesChart::class,
        ];
    }
}
