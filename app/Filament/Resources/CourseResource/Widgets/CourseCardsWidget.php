<?php

namespace App\Filament\Resources\CourseResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CourseCardsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Number of students', 'sdad'),
        ];
    }
}
