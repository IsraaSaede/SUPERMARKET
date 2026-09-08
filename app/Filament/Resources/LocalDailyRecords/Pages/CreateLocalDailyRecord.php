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

    protected function getCreateAnotherFormAction(): Action
    {
        return parent::getCreateAnotherFormAction()
            ->hidden();
    }
}
