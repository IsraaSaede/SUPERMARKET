<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;

class OrderSalesChart extends ChartWidget
{
    protected ?string $heading = 'المبيعات آخر 7 أيام';

    protected function getData(): array
    {
        $days = collect(range(6, 0))->map(fn ($i) => now()->subDays($i)->format('Y-m-d'));

        $totals = $days->map(function ($day) {
            return Order::whereDate('created_at', $day)->sum('total');
        });

        return [
            'datasets' => [
                [
                    'label' => 'المبيعات',
                    'data' => $totals,
                    'borderColor' => '#22c55e',
                    'backgroundColor' => 'rgba(34,197,94,0.15)',
                    'fill' => true,
                ],
            ],
            'labels' => $days->map(fn ($d) => \Carbon\Carbon::parse($d)->format('m-d'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
