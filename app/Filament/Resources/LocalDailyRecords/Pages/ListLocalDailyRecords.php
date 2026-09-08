<?php

namespace App\Filament\Resources\LocalDailyRecords\Pages;

use App\Filament\Resources\LocalDailyRecords\LocalDailyRecordResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLocalDailyRecords extends ListRecords
{
    protected static string $resource = LocalDailyRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('إضافة بيانات يوم'),
        ];
    }
}
