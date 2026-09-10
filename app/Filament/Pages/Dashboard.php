<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\LatestProducts;
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

        if ($user instanceof User && $user->hasRole('super_admin')) {
            return [
                StoreStatsOverview::class,
                LatestProducts::class,
                LowStockProductsWidget::class,
            ];
        }

        return [];
    }
}
