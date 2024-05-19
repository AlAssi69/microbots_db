<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        return $this->hasOne(Color::class);
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
}
