<?php

namespace App\Filament\Resources\MemberResource\Widgets;

use App\Models\Member;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class MemberGeneralInfoCards extends BaseWidget
{
    protected function getStats(): array
    {
        $data = Trend::model(Member::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        $memberWithMostBadges = Member::query()
            ->withCount('badges')->orderBy('badges_count', 'desc')->first();

        return [
            Stat::make('Number of members', Member::count())
                ->chart($data->map(fn (TrendValue $value) => $value->aggregate)->toArray()),
            Stat::make('Member with most badges', $memberWithMostBadges->full_name)
                ->description("number of badges is {$memberWithMostBadges->badges_count}")
                ->descriptionColor('success'),
        ];
    }
}
