<?php

namespace App\Filament\Resources\Settings\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('logo')
                    ->label('الشعار')
                    ->disk('public')
                    ->size(60),

                TextColumn::make('store_name')
                    ->label('اسم المتجر')
                    ->searchable(),

                TextColumn::make('whatsapp_number')
                    ->label('واتساب'),

                TextColumn::make('phone')
                    ->label('الهاتف'),

                TextColumn::make('delivery_fee')
                    ->label('رسوم التوصيل')
                    ->suffix(' ل.س'),

                TextColumn::make('free_delivery_threshold')
                    ->label('التوصيل المجاني فوق')
                    ->suffix(' ل.س'),

            ])
            ->recordActions([
                EditAction::make()
                    ->label('تعديل'),
            ])
            ->toolbarActions([]);
    }
}
