<?php

namespace App\Filament\Resources\PartTypeResource\Pages;

use App\Filament\Resources\PartTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPartTypes extends ListRecords
{
    protected static string $resource = PartTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
