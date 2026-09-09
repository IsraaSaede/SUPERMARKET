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
                    'data' => $records->pluck('sales_total')->map(fn ($v) => (float) $v)->toArray(),
                    'borderColor' => '#22c55e',
                    'backgroundColor' => 'rgba(34,197,94,0.2)',
                    'pointBackgroundColor' => '#22c55e',
                    'pointBorderColor' => '#22c55e',
                    'pointRadius' => 4,
                    'borderWidth' => 3,
                    'fill' => false,
                    'tension' => 0.35,
                ],
                [
                    'label' => 'المشتريات',
                    'data' => $records->pluck('purchases_total')->map(fn ($v) => (float) $v)->toArray(),
                    'borderColor' => '#ef4444',
                    'backgroundColor' => 'rgba(239,68,68,0.2)',
                    'pointBackgroundColor' => '#ef4444',
                    'pointBorderColor' => '#ef4444',
                    'pointRadius' => 4,
                    'borderWidth' => 3,
                    'fill' => false,
                    'tension' => 0.35,
                ],
            ],

            'labels' => $records
                ->map(fn ($record) => $record->date->format('d/m'))
                ->toArray(),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
            'elements' => [
                'line' => [
                    'borderWidth' => 3,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
