<?php

namespace App\Models;

use App\Models\Pivot\MemberWarehouseBorrow;
use Illuminate\Database\Eloquent\Casts\Attribute;
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


    protected function remainingCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->count - $this->borrow_members()
                ->sum('count') + $this->return_members()
                ->sum('count'),
        );
    }

    /**
     * The borrow_members that belong to the Warehouse
     */
    public function borrow_members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'member_warehouse_borrow', 'warehouse_id', 'member_id')
            ->using(MemberWarehouseBorrow::class)
            ->withPivot(['project_id', 'date', 'reason', 'count']);
    }

    /**
     * The borrow_projects that belong to the Warehouse
     */
    public function borrow_projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'member_warehouse_borrow', 'warehouse_id', 'project_id')
            ->using(MemberWarehouseBorrow::class)
            ->withPivot(['member_id', 'date', 'reason', 'count']);
    }

    /**
     * The return_members that belong to the Warehouse
     */
    public function return_members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'member_warehouse_return', 'warehouse_id', 'member_id')
            ->using(MemberWarehouseBorrow::class)
            ->withPivot(['project_id', 'date', 'count']);
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
