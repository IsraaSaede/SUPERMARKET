<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\LatestProducts;
use App\Filament\Widgets\LocalSalesPurchasesChart;
use App\Filament\Widgets\LocalSalesPurchasesStats;
use App\Filament\Widgets\LowStockProductsWidget;
use App\Filament\Widgets\StoreStatsOverview;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;

class Dashboard extends BaseDashboard
{
    use HasFiltersForm;

    public function filtersForm(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('فلترة المبيعات والمشتريات')
                    ->schema([
                        DatePicker::make('start_date')
                            ->label('من تاريخ')
                            ->default(now()->startOfMonth())
                            ->live(),

                        DatePicker::make('end_date')
                            ->label('إلى تاريخ')
                            ->default(now())
                            ->live(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }

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
