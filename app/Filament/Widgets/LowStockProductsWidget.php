<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LowStockProductsWidget extends BaseWidget
{
    protected static ?string $heading = 'تنبيه المخزون';

    protected static ?int $sort = 3;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->where('is_active', true)
                    ->where('stock', '<=', 5)
                    ->orderBy('stock')
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('المنتج')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('التصنيف'),

                Tables\Columns\TextColumn::make('stock')
                    ->label('الكمية المتبقية')
                    ->badge()
                    ->color('danger'),

                Tables\Columns\TextColumn::make('price')
                    ->label('السعر')
                    ->suffix(' ل.س'),
            ])
            ->emptyStateHeading('المخزون جيد')
            ->emptyStateDescription('لا توجد منتجات ذات مخزون منخفض حاليًا.')
            ->emptyStateIcon('heroicon-o-check-circle')
            ->paginated(false);
    }
}
