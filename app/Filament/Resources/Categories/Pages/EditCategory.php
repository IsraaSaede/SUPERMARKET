<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected static ?string $title = 'تعديل التصنيف';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('create')
                ->label('إضافة تصنيف')
                ->icon('heroicon-o-plus')
                ->url(
                    CategoryResource::getUrl('create')
                ),

            DeleteAction::make()
                ->label('حذف التصنيف')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation(),
        ];
    }
}
