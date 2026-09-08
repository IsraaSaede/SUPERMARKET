<?php

namespace App\Filament\Widgets;

use App\Models\LocalDailyRecord;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LocalSalesPurchasesStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $today = LocalDailyRecord::whereDate('date', today())->first();

        $todaySales = (float) ($today?->sales_total ?? 0);
        $todayPurchases = (float) ($today?->purchases_total ?? 0);

        $weekSales = (float) LocalDailyRecord::whereBetween('date', [
            now()->startOfWeek()->toDateString(),
            now()->endOfWeek()->toDateString(),
        ])->sum('sales_total');

        $weekPurchases = (float) LocalDailyRecord::whereBetween('date', [
            now()->startOfWeek()->toDateString(),
            now()->endOfWeek()->toDateString(),
        ])->sum('purchases_total');

        $monthSales = (float) LocalDailyRecord::whereBetween('date', [
            now()->startOfMonth()->toDateString(),
            now()->endOfMonth()->toDateString(),
        ])->sum('sales_total');

        $monthPurchases = (float) LocalDailyRecord::whereBetween('date', [
            now()->startOfMonth()->toDateString(),
            now()->endOfMonth()->toDateString(),
        ])->sum('purchases_total');

        $todayDifference = $todaySales - $todayPurchases;
        $monthDifference = $monthSales - $monthPurchases;

        return [
            Stat::make(
                'مبيعات اليوم',
                number_format($todaySales, 0) . ' ل.س'
            )
                ->description('إجمالي المبيعات المحلية اليوم')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make(
                'مشتريات اليوم',
                number_format($todayPurchases, 0) . ' ل.س'
            )
                ->description('إجمالي المشتريات المحلية اليوم')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('warning'),

            Stat::make(
                'الفرق اليوم',
                number_format($todayDifference, 0) . ' ل.س'
            )
                ->description('المبيعات ناقص المشتريات')
                ->descriptionIcon(
                    $todayDifference >= 0
                        ? 'heroicon-m-arrow-trending-up'
                        : 'heroicon-m-arrow-trending-down'
                )
                ->color($todayDifference >= 0 ? 'success' : 'danger'),

            Stat::make(
                'مبيعات هذا الشهر',
                number_format($monthSales, 0) . ' ل.س'
            )
                ->description('إجمالي المبيعات المحلية منذ بداية الشهر')
                ->color('success'),

            Stat::make(
                'مشتريات هذا الشهر',
                number_format($monthPurchases, 0) . ' ل.س'
            )
                ->description('إجمالي المشتريات المحلية منذ بداية الشهر')
                ->color('warning'),

            Stat::make(
                'الفرق هذا الشهر',
                number_format($monthDifference, 0) . ' ل.س'
            )
                ->description('المبيعات ناقص المشتريات')
                ->color($monthDifference >= 0 ? 'success' : 'danger'),
        ];
    }
}
