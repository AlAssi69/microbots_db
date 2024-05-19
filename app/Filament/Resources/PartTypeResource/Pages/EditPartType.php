<?php

namespace App\Filament\Resources\PartTypeResource\Pages;

use App\Filament\Resources\PartTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPartType extends EditRecord
{
    protected static string $resource = PartTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
