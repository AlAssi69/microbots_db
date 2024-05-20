<?php

namespace App\Traits\Filament;

use Illuminate\Database\Eloquent\Model;

trait RelationManagerHasBadge
{
    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        return $ownerRecord->{static::$relationship}()->count();
    }
}
