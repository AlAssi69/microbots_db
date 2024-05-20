<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Warehouse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'count',
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
     * The borrow_members that belong to the Warehouse
     */
    public function borrow_members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'member_warehouse_borrow', 'warehouse_id', 'member_id')
            ->withPivot(['project_id', 'date', 'reason', 'count']);
    }

    /**
     * The borrow_projects that belong to the Warehouse
     */
    public function borrow_projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'member_project_borrow', 'warehouse_id', 'project_id')
            ->withPivot(['member_id', 'date', 'reason', 'count']);
    }

    /**
     * The return_members that belong to the Warehouse
     */
    public function return_members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'member_warehouse_return', 'warehouse_id', 'member_id')
            ->withPivot(['date', 'count']);
    }

    /**
     * The return_projects that belong to the Warehouse
     */
    public function return_projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'member_project_return', 'warehouse_id', 'project_id')
            ->withPivot(['date', 'reason', 'count']);
    }
}
