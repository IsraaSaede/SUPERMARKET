<?php

namespace App\Filament\Widgets;

use App\Models\LocalDailyRecord;
use Filament\Widgets\ChartWidget;

class LocalSalesPurchasesChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected ?string $heading = 'المبيعات والمشتريات المحلية';

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $records = LocalDailyRecord::query()
            ->whereBetween('date', [
                now()->subDays(29)->toDateString(),
                now()->toDateString(),
            ])
            ->orderBy('date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'المبيعات',
                    'data' => $records
                        ->map(fn ($record) => (float) $record->sales_total)
                        ->values()
                        ->toArray(),
                ],
                [
                    'label' => 'المشتريات',
                    'data' => $records
                        ->map(fn ($record) => (float) $record->purchases_total)
                        ->values()
                        ->toArray(),
                ],
            ],

            'labels' => $records
                ->map(fn ($record) => $record->date->format('d/m'))
                ->values()
                ->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
