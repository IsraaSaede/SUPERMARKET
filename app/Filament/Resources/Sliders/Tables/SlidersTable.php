<?php

namespace App\Filament\Resources\Sliders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SlidersTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->columns([

                ImageColumn::make('image')
                    ->label('الصورة')
                    ->height(70)
                    ->width(120)
                    ->extraImgAttributes([
                        'class' => 'rounded-lg object-cover',
                    ]),

                TextColumn::make('title')
                    ->label('العنوان')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->wrap()
                    ->placeholder('بدون عنوان'),

                TextColumn::make('description')
                    ->label('الوصف')
                    ->limit(60)
                    ->wrap()
                    ->placeholder('لا يوجد وصف'),

                TextColumn::make('order')
                    ->label('الترتيب')
                    ->sortable()
                    ->alignCenter()
                    ->badge(),

                IconColumn::make('is_active')
                    ->label('الحالة')
                    ->boolean()
                    ->alignCenter(),

                TextColumn::make('created_at')
                    ->label('تاريخ الإضافة')
                    ->dateTime('Y-m-d H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])

            ->defaultSort('order', 'asc')

            ->recordActions([
                EditAction::make()
                    ->label('تعديل')
                    ->icon('heroicon-o-pencil-square'),
            ])

            ->toolbarActions([

                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('حذف المحدد'),
                ]),

            ])

            ->emptyStateHeading('لا توجد سلايدرات')

            ->emptyStateDescription(
                'لم تتم إضافة أي سلايدر حتى الآن.'
            )

            ->striped();
    }
}
