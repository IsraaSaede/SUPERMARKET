<?php

namespace App\Filament\Resources\Products\Schemas;

use Cloudinary\Cloudinary;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Select::make('category_id')
                    ->label('التصنيف')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Textarea::make('description')
                    ->columnSpanFull(),

                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),

                FileUpload::make('image')
                    ->label('صورة المنتج')
                    ->image()
                    ->imageEditor()
                    ->maxSize(2048)
                    ->saveUploadedFileUsing(function ($file) {
                        $cloudinary = new Cloudinary([
                            'cloud' => [
                                'cloud_name' => config('services.cloudinary.cloud_name'),
                                'api_key' => config('services.cloudinary.api_key'),
                                'api_secret' => config('services.cloudinary.api_secret'),
                            ],
                        ]);

                        $result = $cloudinary
                            ->uploadApi()
                            ->upload(
                                $file->getRealPath(),
                                [
                                    'folder' => 'supermarket/products',
                                    'resource_type' => 'image',
                                    'transformation' => [
                                        'width' => 800,
                                        'height' => 800,
                                        'crop' => 'limit',
                                        'quality' => 'auto',
                                        'fetch_format' => 'auto',
                                    ],

                                ]
                            );

                        return $result['secure_url'];
                    }),

                TextInput::make('stock')
                    ->required()
                    ->numeric()
                    ->default(0),

                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}
