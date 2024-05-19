<?php

namespace App\Filament\Resources\MemberTechnicalSpecializationResource\Pages;

use App\Filament\Resources\MemberTechnicalSpecializationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMemberTechnicalSpecialization extends EditRecord
{
    protected static string $resource = MemberTechnicalSpecializationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
