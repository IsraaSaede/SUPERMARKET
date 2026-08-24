<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestProducts extends BaseWidget
{
    protected static ?string $heading = 'أحدث المنتجات';

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = [
        'default' => 'full',
        'lg' => 2,
    ];

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->with('category')
                    ->latest()
                    ->limit(6)
            )
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('الصورة')
                    ->square()
                    ->size(45),

                Tables\Columns\TextColumn::make('name')
                    ->label('المنتج')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('التصنيف')
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('price')
                    ->label('السعر')
                    ->suffix(' ل.س')
                    ->numeric(),

                Tables\Columns\TextColumn::make('stock')
                    ->label('المخزون')
                    ->badge()
                    ->color(fn ($state) =>
                        $state <= 5
                            ? 'danger'
                            : ($state <= 10 ? 'warning' : 'success')
                    ),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('الحالة')
                    ->boolean(),
            ])
            ->paginated(false);
    }
}
