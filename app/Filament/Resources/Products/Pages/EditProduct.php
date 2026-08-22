<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected static ?string $title = 'تعديل المنتج';

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\CreateAction::make()
                ->label('إضافة منتج')
                ->icon('heroicon-o-plus')
                ->url(ProductResource::getUrl('create')),

            DeleteAction::make()
                ->label('حذف المنتج')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation(),
        ];
    }

    /**
     * إذا لم يتم رفع صورة جديدة، لا نغيّر الصورة القديمة.
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (empty($data['image'])) {
            unset($data['image']);
        }

        return $data;
    }
}
