<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StoreStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalProducts = Product::count();

        $activeProducts = Product::where('is_active', true)->count();

        $totalCategories = Category::count();

        $lowStock = Product::where('stock', '<=', 3)
            ->where('is_active', true)
            ->count();

        return [
            Stat::make(
                'إجمالي المنتجات',
                $totalProducts
            )
                ->description('جميع المنتجات في المتجر')
                ->descriptionIcon('heroicon-m-cube')
                ->color('primary')
                ->url('/admin/products'),

            Stat::make(
                'المنتجات النشطة',
                $activeProducts
            )
                ->description('منتجات ظاهرة في المتجر')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->url('/admin/products'),

            Stat::make(
                'التصنيفات',
                $totalCategories
            )
                ->description('أقسام المتجر')
                ->descriptionIcon('heroicon-m-squares-2x2')
                ->color('info')
                ->url('/admin/categories'),

            Stat::make(
                'مخزون منخفض',
                $lowStock
            )
                ->description('منتجات تحتاج إلى متابعة')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($lowStock > 0 ? 'danger' : 'success')
                ->url('/admin/products/low-stock')
        ];
    }
}
