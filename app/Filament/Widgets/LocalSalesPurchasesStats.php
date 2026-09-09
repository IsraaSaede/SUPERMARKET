<?php

namespace App\Filament\Widgets;

use App\Models\LocalDailyRecord;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LocalSalesPurchasesStats extends BaseWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $startDate = $this->pageFilters['start_date']
            ?? now()->startOfMonth()->toDateString();

        $endDate = $this->pageFilters['end_date']
            ?? now()->toDateString();

        $records = LocalDailyRecord::query()
            ->whereBetween('date', [
                $startDate,
                $endDate,
            ]);

        $sales = (float) (clone $records)->sum('sales_total');
        $purchases = (float) (clone $records)->sum('purchases_total');

        $difference = $sales - $purchases;

        return [
            Stat::make(
                'مبيعات الفترة',
                number_format($sales, 0) . ' ل.س'
            )
                ->description("من {$startDate} إلى {$endDate}")
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make(
                'مشتريات الفترة',
                number_format($purchases, 0) . ' ل.س'
            )
                ->description("من {$startDate} إلى {$endDate}")
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('warning'),

            Stat::make(
                'الفرق',
                number_format($difference, 0) . ' ل.س'
            )
                ->description('المبيعات ناقص المشتريات')
                ->descriptionIcon(
                    $difference >= 0
                        ? 'heroicon-m-arrow-trending-up'
                        : 'heroicon-m-arrow-trending-down'
                )
                ->color(
                    $difference >= 0
                        ? 'success'
                        : 'danger'
                ),
        ];
    }
}
