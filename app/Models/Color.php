<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Color extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'description', 'supervisor_id'];

    /**
     * Get the supervisor that owns the Color
     */
    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'supervisor_id');
    }

    /**
     * Get all of the projects for the Color
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'color_id');
    }
}
