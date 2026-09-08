<?php

namespace App\Filament\Resources\LocalDailyRecords\Pages;

use App\Filament\Resources\LocalDailyRecords\LocalDailyRecordResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLocalDailyRecord extends EditRecord
{
    protected static string $resource = LocalDailyRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
