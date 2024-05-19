<?php

namespace App\Models;

use App\Traits\Models\HasHashId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;
    use HasHashId;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hash_id',
        'name',
        'description',
        'start_date',
        'color_id',
        'supervisior_id',
        'level_id',
        'budget',
        'deadline',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'start_date' => 'date',
        'color_id' => 'integer',
        'supervisior_id' => 'integer',
        'level_id' => 'integer',
        'deadline' => 'datetime',
    ];

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function supervisior(): BelongsTo
    {
        return $this->belongsTo(Member::class);
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    /**
     * The members that belong to the Project
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'member_project', 'project_id', 'member_id')
            ->withPivot(['participation_date']);
    }

    /**
     * The borrow_warehouses that belong to the Project
     */
    public function borrow_warehouses(): BelongsToMany
    {
        return $this->belongsToMany(Warehouse::class, 'member_warehouse_borrow', 'project_id', 'warehouse_id')
            ->withPivot(['date', 'reason', 'count']);
    }

    public function borrow_members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'member_warehouse_borrow', 'project_id', 'member_id')
            ->withPivot(['date', 'reason', 'count']);
    }

    /**
     * The return_warehouses that belong to the Project
     */
    public function return_warehouses(): BelongsToMany
    {
        return $this->belongsToMany(Warehouse::class, 'member_warehouse_return', 'project_id', 'warehouse_id')
            ->withPivot(['date', 'count']);
    }

    public function return_members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'member_warehouse_return', 'project_id', 'member_id')
            ->withPivot(['date', 'count']);
    }

    /**
     * The parts that belong to the Project
     */
    public function parts(): BelongsToMany
    {
        return $this->belongsToMany(Part::class, 'part_member', 'project_id', 'part_id')->withPivot(['count']);
    }

    /**
     * The skills that belong to the Project
     */
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'part_member', 'project_id', 'skill_id');
    }
}
