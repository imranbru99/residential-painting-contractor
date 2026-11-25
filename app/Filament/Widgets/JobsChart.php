<?php

namespace App\Filament\Widgets;

use App\Models\Job;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class JobsChart extends ChartWidget
{
    protected static ?string $heading = 'Jobs by Month';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $labels = [];
        $data = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $labels[] = $month->format('M Y');
            $data[] = Job::query()
                ->whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jobs created',
                    'data' => $data,
                    'backgroundColor' => '#1A7A66',
                    'borderColor' => '#0F3D32',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
