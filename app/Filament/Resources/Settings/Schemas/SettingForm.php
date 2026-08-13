<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                /*
                |--------------------------------------------------------------------------
                | معلومات المتجر
                |--------------------------------------------------------------------------
                */
                Section::make('معلومات المتجر')
                    ->description('المعلومات الأساسية الخاصة بالمتجر')
                    ->icon('heroicon-o-building-storefront')
                    ->schema([

                        TextInput::make('store_name')
                            ->label('اسم المتجر')
                            ->placeholder('سوبر ماركت الباشا')
                            ->required()
                            ->maxLength(255),

                        FileUpload::make('logo')
                            ->label('شعار المتجر')
                            ->image()
                            ->imageEditor()
                            ->directory('settings')
                            ->disk('public')
                            ->visibility('public')
                            ->imagePreviewHeight('120')
                            ->maxSize(2048)
                            ->columnSpanFull(),

                    ])
                    ->columns(2),

                /*
                |--------------------------------------------------------------------------
                | معلومات التواصل
                |--------------------------------------------------------------------------
                */
                Section::make('معلومات التواصل')
                    ->description('أرقام التواصل التي سيستخدمها العملاء')
                    ->icon('heroicon-o-phone')
                    ->schema([

                        TextInput::make('whatsapp_number')
                            ->label('رقم واتساب')
                            ->placeholder('09xxxxxxxx')
                            ->tel()
                            ->required(),

                        TextInput::make('phone')
                            ->label('رقم الهاتف')
                            ->placeholder('09xxxxxxxx')
                            ->tel(),

                        Textarea::make('address')
                            ->label('عنوان المتجر')
                            ->placeholder('أدخل عنوان المتجر')
                            ->rows(3)
                            ->columnSpanFull(),

                    ])
                    ->columns(2),

                /*
                |--------------------------------------------------------------------------
                | التوصيل
                |--------------------------------------------------------------------------
                */
                Section::make('إعدادات التوصيل')
                    ->description('تحديد رسوم التوصيل وقيمة الطلب التي يصبح عندها التوصيل مجانيًا')
                    ->icon('heroicon-o-truck')
                    ->schema([

                        TextInput::make('delivery_fee')
                            ->label('رسوم التوصيل')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->suffix('ل.س'),

                        TextInput::make('free_delivery_threshold')
                            ->label('التوصيل مجاني فوق')
                            ->placeholder('مثال: 100000')
                            ->numeric()
                            ->suffix('ل.س')
                            ->helperText(
                                'اترك هذا الحقل فارغًا إذا كنت لا تريد تفعيل التوصيل المجاني.'
                            ),

                    ])
                    ->columns(2),

            ]);
    }
}
