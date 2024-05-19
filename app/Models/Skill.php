<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    /**
     * The members that belong to the Skill
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'member_skill', 'skill_id', 'member_id');
    }

    /**
     * The projects that belong to the Skill
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'member_skill', 'skill_id', 'project_id');
    }
}
