<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class OrderStatsOverview extends BaseWidget
{

    protected function getStats(): array
    {

        $stats = Cache::remember('order_stats', 60, function () {

            return [

                'totalOrders' => Order::count(),

                'totalSales' => Order::sum('total'),

                'averageOrder' => Order::avg('total') ?? 0,

                'todaySales' => Order::whereBetween('created_at', [
                    now()->startOfDay(),
                    now()->endOfDay()
                ])->sum('total'),


                'weekSales' => Order::whereBetween('created_at', [
                    now()->startOfWeek(),
                    now()->endOfWeek()
                ])->sum('total'),


                'monthSales' => Order::whereBetween('created_at', [
                    now()->startOfMonth(),
                    now()->endOfMonth()
                ])->sum('total'),


                'todayOrders' => Order::whereBetween('created_at', [
                    now()->startOfDay(),
                    now()->endOfDay()
                ])->count(),

            ];

        });


        return [

            Stat::make(
                'إجمالي الطلبات',
                $stats['totalOrders']
            )
            ->color('primary'),


            Stat::make(
                'إجمالي المبيعات',
                number_format($stats['totalSales'],2).' ل.س'
            )
            ->color('success'),


            Stat::make(
                'متوسط الطلب',
                number_format($stats['averageOrder'],2).' ل.س'
            )
            ->color('info'),


            Stat::make(
                'مبيعات اليوم',
                number_format($stats['todaySales'],2).' ل.س'
            )
            ->description("طلبات اليوم {$stats['todayOrders']}")
            ->color('warning'),


            Stat::make(
                'مبيعات الأسبوع',
                number_format($stats['weekSales'],2).' ل.س'
            )
            ->color('primary'),


            Stat::make(
                'مبيعات الشهر',
                number_format($stats['monthSales'],2).' ل.س'
            )
            ->color('success'),

        ];
    }
}
