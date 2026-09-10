<?php

namespace App\Filament\Resources\LocalDailyRecords\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\CreateAction;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class LocalDailyRecordsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('date', 'desc')
            ->columns([
                TextColumn::make('date')
                    ->label('التاريخ واليوم')
                    ->formatStateUsing(function ($state) {
                        if (! $state) {
                            return null;
                        }

                        return Carbon::parse($state)
                            ->locale('ar')
                            ->translatedFormat('l، d/m/Y');
                    })
                    ->sortable()
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->where('date', 'like', "%{$search}%");
                    }),

                TextInputColumn::make('sales_total')
                    ->label('مجموع المبيعات')
                    ->rules(['required', 'numeric', 'min:0'])
                    ->sortable()
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->where('sales_total', 'like', "%{$search}%");
                    }),

                TextInputColumn::make('purchases_total')
                    ->label('مجموع المشتريات')
                    ->rules(['required', 'numeric', 'min:0'])
                    ->sortable()
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->where('purchases_total', 'like', "%{$search}%");
                    }),

                TextInputColumn::make('notes')
                    ->label('ملاحظات')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('تاريخ الإدخال')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([
                Filter::make('date_range')
                    ->form([
                        \Filament\Forms\Components\DatePicker::make('from')->label('من تاريخ'),
                        \Filament\Forms\Components\DatePicker::make('until')->label('إلى تاريخ'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'], fn ($q) => $q->whereDate('date', '>=', $data['from']))
                            ->when($data['until'], fn ($q) => $q->whereDate('date', '<=', $data['until']));
                    }),
            ])
            ->recordActions([
                EditAction::make()
                    ->label('تعديل كامل'),
            ])
            ->toolbarActions([

                CreateAction::make()
                    ->label('إضافة سجل جديد')
                    ->icon('heroicon-o-plus'),

                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('حذف المحدد'),
                ]),
            ]);
    }
}
