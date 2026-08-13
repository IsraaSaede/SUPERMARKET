<?php

namespace App\Filament\Resources\Sliders\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class SliderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->maxLength(255),

                FileUpload::make('image')
                    ->image()
                    ->directory('sliders')
                    ->required(),

                Textarea::make('description')
                    ->columnSpanFull(),

                Toggle::make('is_active')
                    ->default(true),

                TextInput::make('order')
                    ->numeric()
                    ->default(0),
            ]);
    }
}