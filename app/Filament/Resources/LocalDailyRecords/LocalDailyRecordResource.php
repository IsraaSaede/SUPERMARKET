<?php

namespace App\Filament\Resources\LocalDailyRecords;

use App\Filament\Resources\LocalDailyRecords\Pages\CreateLocalDailyRecord;
use App\Filament\Resources\LocalDailyRecords\Pages\EditLocalDailyRecord;
use App\Filament\Resources\LocalDailyRecords\Pages\ListLocalDailyRecords;
use App\Filament\Resources\LocalDailyRecords\Schemas\LocalDailyRecordForm;
use App\Filament\Resources\LocalDailyRecords\Tables\LocalDailyRecordsTable;
use App\Models\LocalDailyRecord;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LocalDailyRecordResource extends Resource
{
    protected static ?string $model = LocalDailyRecord::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedChartBar;

    protected static ?string $recordTitleAttribute = 'date';

    public static function getNavigationLabel(): string
    {
        return 'المبيعات والمشتريات المحلية';
    }

    public static function getModelLabel(): string
    {
        return 'سجل يومي';
    }

    public static function getPluralModelLabel(): string
    {
        return 'المبيعات والمشتريات المحلية';
    }

    /**
     * السماح بإنشاء سجل جديد فقط لمن لديه صلاحية Create.
     */
    public static function canCreate(): bool
    {
        return auth()->user()?->can('create', LocalDailyRecord::class) ?? false;
    }

    /**
     * السماح بتعديل السجل فقط لمن لديه صلاحية Update.
     */
    public static function canEdit($record): bool
    {
        return auth()->user()?->can('update', $record) ?? false;
    }

    /**
     * السماح بحذف السجل فقط لمن لديه صلاحية Delete.
     */
    public static function canDelete($record): bool
    {
        return auth()->user()?->can('delete', $record) ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return LocalDailyRecordForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LocalDailyRecordsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLocalDailyRecords::route('/'),
            'create' => CreateLocalDailyRecord::route('/create'),
            'edit' => EditLocalDailyRecord::route('/{record}/edit'),
        ];
    }
}
