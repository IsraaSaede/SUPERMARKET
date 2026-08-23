<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                // صورة المنتج
                ImageColumn::make('image')
                    ->label('الصورة')
                    ->disk('public')
                    ->square()
                    ->size(60),

                // اسم المنتج - تعديل مباشر
                TextInputColumn::make('name')
                    ->label('اسم المنتج')
                    ->searchable()
                    ->sortable()
                    ->rules([
                        'required',
                        'string',
                        'max:255',
                    ])
                    ->width('250px'),

                // التصنيف
                TextColumn::make('category.name')
                    ->label('التصنيف')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                // السعر - تعديل مباشر
                TextInputColumn::make('price')
                    ->label('السعر')
                    ->rules([
                        'required',
                        'numeric',
                        'min:0',
                    ])
                    ->sortable()
                    ->width('140px'),

                // المخزون - تعديل مباشر
                TextInputColumn::make('stock')
                    ->label('المخزون')
                    ->rules([
                        'required',
                        'integer',
                        'min:0',
                    ])
                    ->sortable()
                    ->width('120px')
                    ->color(fn ($record) => match (true) {
                        $record->stock <= 0 => 'danger',
                        $record->stock <= 5 => 'warning',
                        default => 'success',
                    }),

                // الحالة
                IconColumn::make('is_active')
                    ->label('الحالة')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                // تاريخ الإضافة
                TextColumn::make('created_at')
                    ->label('تاريخ الإضافة')
                    ->date('Y-m-d')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])

            // الفلاتر
            ->filters([

                SelectFilter::make('category_id')
                    ->label('التصنيف')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),

                TernaryFilter::make('is_active')
                    ->label('الحالة')
                    ->placeholder('كل المنتجات')
                    ->trueLabel('منتجات فعالة')
                    ->falseLabel('منتجات غير فعالة'),

            ])

            // أزرار كل منتج
            ->recordActions([

                EditAction::make()
                    ->label('تعديل')
                    ->icon('heroicon-o-pencil-square'),

                DeleteAction::make()
                    ->label('حذف')
                    ->icon('heroicon-o-trash')
                    ->requiresConfirmation(),

            ])

            // العمليات الجماعية
            ->toolbarActions([

                BulkActionGroup::make([

                    DeleteBulkAction::make()
                        ->label('حذف المحدد'),

                ]),

            ])

            ->defaultSort('created_at', 'desc');
    }
}
