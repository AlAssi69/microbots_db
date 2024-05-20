<?php

namespace App\Filament\Resources\MemberResource\Pages;

use App\Filament\Resources\MemberResource;
use App\Filament\Resources\MemberResource\Widgets\MemberGeneralInfoCards;
use App\Models\Member;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListMembers extends ListRecords
{
    protected static string $resource = MemberResource::class;

    public function getTabs(): array
    {
        $frozen = Member::query()
            ->where('frozen', true);
        $workFromHome = Member::query()
            ->where('work_from_home', true);
        return [
            'all' => Tab::make('All')->badge(Member::count()),
            'frozen' => Tab::make('Frozen')
                ->badge($frozen->count())
                ->query(fn () => $frozen),
            'work_from_home' => Tab::make('Work From Home')
                ->badge($workFromHome->count())
                ->query(fn () => $workFromHome),
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            MemberGeneralInfoCards::class,
        ];
    }
}
