<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class TopAreasOrders extends TableWidget
{
    protected static ?string $heading = 'أكثر الأحياء طلباً';

    protected int|string|array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()
                    ->selectRaw('area as id, area, COUNT(*) as total_orders')
                    ->groupBy('area')
                    ->orderByDesc('total_orders')
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('area')
                    ->label('الحي'),

                Tables\Columns\TextColumn::make('total_orders')
                    ->label('عدد الطلبات')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('info'),
            ])
            ->paginated(false);
    }
}
