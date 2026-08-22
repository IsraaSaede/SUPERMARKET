<?php

namespace App\Filament\Resources\Sliders\Schemas;

use Cloudinary\Cloudinary;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
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
                    ->label('صورة السلايدر')
                    ->image()
                    ->imageEditor()
                    ->maxSize(4096)
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
                                    'folder' => 'supermarket/sliders',
                                    'resource_type' => 'image',
                                ]
                            );

                        return $result['secure_url'];
                    })
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
