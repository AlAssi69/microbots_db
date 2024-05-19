<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tournament extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'date',
        'url',
        'country',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date' => 'date',
    ];

    /**
     * The member that belong to the Tournament
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function member(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'member_tournament', 'tournament_id', 'member_id');
    }
}
