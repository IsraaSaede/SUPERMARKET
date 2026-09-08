<?php

namespace App\Filament\Resources\Sliders\Schemas;

use Cloudinary\Cloudinary;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class SliderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('معلومات السلايدر')
                    ->description('أدخل المعلومات التي ستظهر للزوار في السلايدر.')
                    ->schema([

                        Grid::make(2)
                            ->schema([

                                TextInput::make('title')
                                    ->label('عنوان السلايدر')
                                    ->placeholder('مثال: عروض الصيف')
                                    ->maxLength(255)
                                    ->columnSpan(1),

                                TextInput::make('order')
                                    ->label('ترتيب العرض')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0)
                                    ->helperText('الأرقام الأصغر تظهر أولاً.')
                                    ->columnSpan(1),

                            ]),

                        Textarea::make('description')
                            ->label('وصف السلايدر')
                            ->placeholder('اكتب وصفًا مختصرًا يظهر للزبون...')
                            ->rows(4)
                            ->maxLength(1000)
                            ->columnSpanFull(),

                    ])
                    ->columns(2),

                Section::make('صورة السلايدر')
                    ->description('ارفع الصورة التي ستظهر للزبائن في الصفحة الرئيسية.')
                    ->schema([

                        FileUpload::make('image')
                            ->label('صورة السلايدر')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '3:1',
                                '2:1',
                            ])
                            ->maxSize(4096)
                            ->helperText('الحد الأقصى 4MB. يفضل استخدام صورة أفقية عالية الجودة.')
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
                            ->required()
                            ->columnSpanFull(),

                    ]),

                Section::make('حالة السلايدر')
                    ->schema([

                        Toggle::make('is_active')
                            ->label('السلايدر فعال')
                            ->helperText('عند التفعيل سيظهر السلايدر للزبائن في الموقع.')
                            ->default(true)
                            ->inline(false),

                    ]),

            ]);
    }
}
