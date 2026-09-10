<?php

namespace App\Filament\Resources\LocalDailyRecords\Pages;

use App\Filament\Resources\LocalDailyRecords\LocalDailyRecordResource;
use App\Models\LocalDailyRecord;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLocalDailyRecord extends EditRecord
{
    protected static string $resource = LocalDailyRecordResource::class;

    protected function getHeaderActions(): array
    {
        // السجل السابق (حسب التاريخ)
        $previousRecord = LocalDailyRecord::where('date', '<', $this->record->date)
            ->orderBy('date', 'desc')
            ->first();

        // السجل التالي (حسب التاريخ)
        $nextRecord = LocalDailyRecord::where('date', '>', $this->record->date)
            ->orderBy('date', 'asc')
            ->first();

        return [
            // زر العودة للقائمة
            Action::make('backToList')
                ->label('الرجوع للقائمة')
                ->icon('heroicon-m-arrow-right')
                ->color('gray')
                ->outlined()
                ->url(static::$resource::getUrl('index')),

            // التنقل: اليوم السابق
            Action::make('previous')
                ->label('السابق')
                ->icon('heroicon-m-chevron-right')
                ->color('gray')
                ->disabled(! $previousRecord)
                ->url($previousRecord ? static::$resource::getUrl('edit', ['record' => $previousRecord->id]) : null),

            // التنقل: اليوم التالي
            Action::make('next')
                ->label('التالي')
                ->icon('heroicon-m-chevron-left')
                ->color('gray')
                ->disabled(! $nextRecord)
                ->url($nextRecord ? static::$resource::getUrl('edit', ['record' => $nextRecord->id]) : null),

            // زر حذف
            DeleteAction::make()
                ->label('حذف')
                ->icon('heroicon-m-trash'),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            // حفظ التغييرات
            parent::getSaveFormAction()
                ->label('حفظ التغييرات'),

            // زر إضافة سجل جديد بجانب زر الحفظ بالأسفل
            Action::make('createNew')
                ->label('إضافة يوم جديد')
                ->icon('heroicon-m-plus')
                ->color('success')
                ->url(static::$resource::getUrl('create')),

            // زر إلغاء
            parent::getCancelFormAction()
                ->label('إلغاء'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return static::$resource::getUrl('index');
    }
}
