<?php

namespace App\Filament\Resources\LocalDailyRecords\Pages;

use App\Filament\Resources\LocalDailyRecords\LocalDailyRecordResource;
use App\Models\LocalDailyRecord;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;

class CreateLocalDailyRecord extends CreateRecord
{
    protected static string $resource = LocalDailyRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('backToList')
                ->label('الرجوع للقائمة')
                ->icon('heroicon-o-arrow-right')
                ->color('gray')
                ->url(static::$resource::getUrl('index')),
        ];
    }

    protected function beforeCreate(): void
    {
        $date = Carbon::parse($this->data['date'])->toDateString();

        $exists = LocalDailyRecord::whereDate('date', $date)->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'data.date' => 'يوجد سجل لهذا اليوم بالفعل. يمكنك تعديل السجل الموجود بدلًا من إنشاء سجل جديد.',
            ]);
        }
    }

    // إظهار زر "حفظ وإنشاء يوم آخر" لتسهيل الإدخال المتتابع للأيام
    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()
            ->label('حفظ وإضافة يوم آخر')
            ->color('gray');
    }

    // التوجيه التلقائي للقائمة بعد الحفظ
    protected function getRedirectUrl(): string
    {
        return static::$resource::getUrl('index');
    }
}
