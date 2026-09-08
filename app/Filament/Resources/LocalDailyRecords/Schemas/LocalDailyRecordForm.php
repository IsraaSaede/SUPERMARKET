<?php

namespace App\Filament\Resources\LocalDailyRecords\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LocalDailyRecordForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DatePicker::make('date')
                    ->label('التاريخ')
                    ->required()
                    ->default(now()->format('Y-m-d'))
                    ->maxDate(now())
                    ->native(false),

                TextInput::make('sales_total')
                    ->label('مجموع المبيعات')
                    ->numeric()
                    ->suffix(' ل.س')
                    ->required()
                    ->default(0)
                    ->minValue(0)
                    ->step(0.01),

                TextInput::make('purchases_total')
                    ->label('مجموع المشتريات')
                    ->numeric()
                    ->suffix(' ل.س')
                    ->required()
                    ->default(0)
                    ->minValue(0)
                    ->step(0.01),

                Textarea::make('notes')
                    ->label('ملاحظات')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
