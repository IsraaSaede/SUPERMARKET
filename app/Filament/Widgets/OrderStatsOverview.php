<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\OrderItem;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {

        $totalOrders = Order::count();

        $totalSales = Order::sum('total');


        $averageOrder = Order::avg('total') ?? 0;


        $todaySales = Order::whereDate(
            'created_at',
            today()
        )->sum('total');


        $weekSales = Order::whereBetween(
            'created_at',
            [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]
        )->sum('total');


        $monthSales = Order::whereMonth(
            'created_at',
            now()->month
        )->sum('total');


        $todayOrders = Order::whereDate(
            'created_at',
            today()
        )->count();



        return [

            Stat::make(
                'إجمالي الطلبات',
                $totalOrders
            )
            ->description('كل الطلبات')
            ->descriptionIcon('heroicon-m-shopping-cart')
            ->color('primary'),


            Stat::make(
                'إجمالي المبيعات',
                number_format($totalSales,2).' ل.س'
            )
            ->description('كل المبيعات')
            ->descriptionIcon('heroicon-m-banknotes')
            ->color('success'),



            Stat::make(
                'متوسط الطلب',
                number_format($averageOrder,2).' ل.س'
            )
            ->description('متوسط قيمة الطلب')
            ->descriptionIcon('heroicon-m-calculator')
            ->color('info'),



            Stat::make(
                'مبيعات اليوم',
                number_format($todaySales,2).' ل.س'
            )
            ->description("طلبات اليوم {$todayOrders}")
            ->color('warning'),



            Stat::make(
                'مبيعات الأسبوع',
                number_format($weekSales,2).' ل.س'
            )
            ->description('هذا الأسبوع')
            ->color('primary'),

            Stat::make(
                'مبيعات الشهر',
                number_format($monthSales,2).' ل.س'
            )
            ->description('هذا الشهر')
            ->color('success'),

        ];
    }
}
