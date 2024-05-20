<?php

namespace App\Filament\Widgets;

use App\Models\Course;
use App\Models\Member;
use App\Models\Project;
use Filament\Widgets\ChartWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class GlobalNumbersWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getType(): string
    {
        return 'bar';
    }

    protected static ?string $heading = 'Members - Projects - Courses';

    protected function getData(): array
    {
        $members = Trend::model(Member::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        $projects = Trend::model(Project::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        $courses = Trend::model(Course::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Members Count',
                    'data' => $members->map(fn (TrendValue $value) => $value->aggregate),
                ],
                [
                    'label' => 'Projects Count',
                    'data' => $projects->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#36A2EB',
                ],
                [
                    'label' => 'Courses Count',
                    'data' => $courses->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#9BD0F5',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $members->map(fn (TrendValue $value) => $value->date),
        ];
    }
}
