<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Member extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'hash_id',
        'join_date',
        'first_name',
        'father_name',
        'last_name',
        'sex',
        'email',
        'date_of_birth',
        'university_id',
        'major_id',
        'uni_year',
        'phone_number',
        'emergency_name',
        'emergency_kinship',
        'emergency_phone',
        'governorate_id',
        'region_name',
        'street_name',
        'category_id',
        'level_id',
        'technical_specialization_id',
        'department_id',
        'frozen',
        'work_from_home',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'join_date' => 'date',
        'university_id' => 'integer',
        'major_id' => 'integer',
        'governorate_id' => 'integer',
        'category_id' => 'integer',
        'level_id' => 'integer',
        'technical_specialization_id' => 'integer',
        'department_id' => 'integer',
        'frozen' => 'boolean',
        'work_from_home' => 'boolean',
    ];

    public function bankTransactions(): HasMany
    {
        return $this->hasMany(BankTransaction::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function color(): HasOne
    {
        return $this->hasOne(Color::class, "supervisor_id");
    }

    public function department_head(): HasOne
    {
        return $this->hasOne(Department::class, "head_id");
    }

    public function university(): BelongsTo
    {
        return $this->belongsTo(University::class);
    }

    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }

    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Governorate::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(\App\Models\MemberCategory::class);
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function technicalSpecialization(): BelongsTo
    {
        return $this->belongsTo(MemberTechnicalSpecialization::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * The badges that belong to the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function badges(): BelongsToMany
    {
        return $this->belongsToMany(Badge::class, 'badge_member', 'member_id', 'badge_id')
            ->withPivot(["date", "reason"]);
    }

    /**
     * The courses that belong to the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function course_coach(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'coach_course', 'coach_id', 'course_id')
            ->withPivot(["hours"]);
    }

    /**
     * The course_student that belong to the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function course_student(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_student', 'student_id', 'course_id');
    }

    /**
     * The projects that belong to the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function works_on_projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'member_project', 'member_id', 'project_id')
            ->withPivot(["participation_date"]);
    }

    /**
     * The skills that belong to the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'member_skill', 'member_id', 'skill_id');
    }

    /**
     * The tournaments that belong to the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tournaments(): BelongsToMany
    {
        return $this->belongsToMany(Tournament::class, 'member_tournament');
    }

    /**
     * The borrow_warehouses that belong to the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function borrow_warehouses(): BelongsToMany
    {
        return $this->belongsToMany(Warehouse::class, 'member_warehouse_borrow')
            ->withPivot(["date", "reason", "count"]);
    }

    /**
     * The borrow_projects that belong to the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function borrow_projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'member_warehouse_borrow', 'member_id', 'project_id')
            ->withPivot(["date", "reason", "count"]);
    }

    /**
     * The return_warehouses that belong to the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function return_warehouses(): BelongsToMany
    {
        return $this->belongsToMany(Warehouse::class, 'member_warehouse_return')
            ->withPivot(["date", "count"]);
    }

    /**
     * The return_projects that belong to the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function return_projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'member_warehouse_return', 'member_id', 'project_id')
            ->withPivot(["date", "count"]);
    }
}
