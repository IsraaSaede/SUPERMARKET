<?php

namespace App\Filament\Widgets;

use App\Models\LocalDailyRecord;
use Filament\Widgets\ChartWidget;

class LocalSalesPurchasesChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected static ?string $heading = 'المبيعات والمشتريات المحلية';

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
                    'borderColor' => '#10b981', // Emerald Green
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                ],
                [
                    'label' => 'المشتريات',
                    'data' => $records
                        ->map(fn ($record) => (float) $record->purchases_total)
                        ->values()
                        ->toArray(),
                    'borderColor' => '#ef4444', // Red
                    'backgroundColor' => 'rgba(239, 68, 68, 0.1)',
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
