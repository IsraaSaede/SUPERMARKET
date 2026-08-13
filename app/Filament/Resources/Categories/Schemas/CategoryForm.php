<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('name')
                    ->label('اسم التصنيف')
                    ->placeholder('مثال: شيبس')
                    ->required()
                    ->maxLength(255)
                    ->autofocus(),

                FileUpload::make('image')
                    ->label('صورة التصنيف')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('categories')
                    ->visibility('public')
                    ->maxSize(2048)
                    ->helperText('يفضل استخدام صورة مربعة وواضحة.'),

                Toggle::make('is_active')
                    ->label('التصنيف فعال')
                    ->default(true)
                    ->onColor('success')
                    ->offColor('danger')
                    ->helperText('التصنيف الفعال يظهر للعملاء في المتجر.'),

            ]);
    }
}
