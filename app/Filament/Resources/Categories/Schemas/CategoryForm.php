<?php

namespace App\Filament\Resources\Categories\Schemas;

use Cloudinary\Cloudinary;
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
                                    'folder' => 'supermarket/categories',
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
                    })
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
