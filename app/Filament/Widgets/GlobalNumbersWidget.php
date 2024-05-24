<?php

namespace App\Filament\Widgets;

use App\Models\Course;
use App\Models\Member;
use App\Models\Project;
use Filament\Widgets\ChartWidget as BaseWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class GlobalNumbersWidget extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

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
                    'backgroundColor' => '#FF5113',
                    'borderColor' => '#FF5113',
                ],
                [
                    'label' => 'Projects Count',
                    'data' => $projects->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#3399CC',
                    'borderColor' => '#3399CC',
                ],
                [
                    'label' => 'Courses Count',
                    'data' => $courses->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#003366',
                    'borderColor' => '#003366',
                ],
            ],
            'labels' => $members->map(fn (TrendValue $value) => $value->date),
        ];
    }
}
