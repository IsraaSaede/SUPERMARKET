<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class StoreStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $stats = Cache::remember('store_dashboard_stats', 60, function () {

            return [
                'totalProducts' => Product::count(),

                'activeProducts' => Product::where('is_active', true)->count(),

                'totalCategories' => Category::count(),

                'totalOrders' => Order::count(),

                'newOrders' => Order::where('status', 'new')->count(),

                'todaySales' => Order::whereBetween('created_at', [
                    now()->startOfDay(),
                    now()->endOfDay(),
                ])->sum('total'),

                'lowStock' => Product::where('stock', '<=', 5)
                    ->where('is_active', true)
                    ->count(),
            ];
        });


        return [

            Stat::make(
                'إجمالي المنتجات',
                $stats['totalProducts']
            )
            ->description('جميع المنتجات')
            ->descriptionIcon('heroicon-m-cube')
            ->color('primary')
            ->url('/admin/products'),


            Stat::make(
                'المنتجات النشطة',
                $stats['activeProducts']
            )
            ->description('منتجات ظاهرة')
            ->descriptionIcon('heroicon-m-check-circle')
            ->color('success')
            ->url('/admin/products'),


            Stat::make(
                'التصنيفات',
                $stats['totalCategories']
            )
            ->description('أقسام المتجر')
            ->descriptionIcon('heroicon-m-squares-2x2')
            ->color('info')
            ->url('/admin/categories'),


            Stat::make(
                'مخزون منخفض',
                $stats['lowStock']
            )
            ->description('تحتاج متابعة')
            ->descriptionIcon('heroicon-m-exclamation-triangle')
            ->color(
                $stats['lowStock'] > 0
                ? 'danger'
                : 'success'
            )
            ->url('/admin/products'),


            Stat::make(
                'إجمالي الطلبات',
                $stats['totalOrders']
            )
            ->description('كل الطلبات')
            ->descriptionIcon('heroicon-m-shopping-cart')
            ->color('primary')
            ->url('/admin/orders'),


            Stat::make(
                'طلبات جديدة',
                $stats['newOrders']
            )
            ->description('تحتاج متابعة')
            ->descriptionIcon('heroicon-m-bell')
            ->color('warning')
            ->url('/admin/orders'),


            Stat::make(
                'مبيعات اليوم',
                number_format($stats['todaySales'], 2).' ل.س'
            )
            ->description('إجمالي اليوم')
            ->descriptionIcon('heroicon-m-banknotes')
            ->color('success'),

        ];
    }
}
