<?php

namespace App\Filament\Widgets;

use App\Models\OrderItem;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class BestSellingProducts extends TableWidget
{
    protected static ?string $heading = 'أفضل المنتجات مبيعاً';

    protected int|string|array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                OrderItem::query()
                    ->selectRaw('MIN(order_items.id) as row_id, product_name, SUM(quantity) as sold')
                    ->groupBy('product_name')
                    ->orderByDesc('sold')
                    ->limit(10)
            )

            ->recordTitleAttribute('product_name')

            ->columns([

                Tables\Columns\TextColumn::make('product_name')
                    ->label('المنتج'),

                Tables\Columns\TextColumn::make('sold')
                    ->label('الكمية المباعة')
                    ->numeric()
                    ->badge()
                    ->color('success'),

            ])

            ->paginated(false);
    }
}
