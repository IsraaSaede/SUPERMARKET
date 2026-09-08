<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\LatestProducts;
use App\Filament\Widgets\LocalSalesPurchasesChart;
use App\Filament\Widgets\LocalSalesPurchasesStats;
use App\Filament\Widgets\LowStockProductsWidget;
use App\Filament\Widgets\StoreStatsOverview;
use App\Models\User;
use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        $user = Auth::user();

        // السوبر أدمن يرى لوحة المتجر كاملة
        if ($user instanceof User && $user->hasRole('super_admin')) {
            return [
                LocalSalesPurchasesStats::class,
                LocalSalesPurchasesChart::class,

                StoreStatsOverview::class,
                LatestProducts::class,
                LowStockProductsWidget::class,
            ];
        }

        // باقي المستخدمين يرون فقط الإحصائيات المحلية
        return [
            LocalSalesPurchasesStats::class,
            LocalSalesPurchasesChart::class,
        ];
    }
}
