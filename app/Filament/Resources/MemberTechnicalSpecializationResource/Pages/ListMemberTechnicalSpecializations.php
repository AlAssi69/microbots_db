<?php

namespace App\Filament\Resources\MemberTechnicalSpecializationResource\Pages;

use App\Filament\Resources\MemberTechnicalSpecializationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMemberTechnicalSpecializations extends ListRecords
{
    protected static string $resource = MemberTechnicalSpecializationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
