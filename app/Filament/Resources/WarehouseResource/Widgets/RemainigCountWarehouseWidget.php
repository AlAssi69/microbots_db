<?php

namespace App\Filament\Resources\WarehouseResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;

class RemainigCountWarehouseWidget extends BaseWidget
{
    public ?Model $record = null;

    protected function getStats(): array
    {
        return [
            Stat::make('Remaining Count', $this->record->remaining_count),
        ];
    }
}
