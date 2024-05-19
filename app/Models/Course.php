<?php

namespace App\Models;

use App\Traits\Models\HasHashId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
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
        'sessions',
        'hours',
        'certificate',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'start_date' => 'date',
        'certificate' => 'boolean',
    ];

    /**
     * The coaches that belong to the Course
     */
    public function coaches(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'coach_course', 'course_id', 'coach_id')
            ->withPivot(['hours']);
    }

    /**
     * The students that belong to the Course
     */
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Member::class, 'course_student', 'course_id', 'student_id');
    }

    /**
     * The prerequisite that belong to the Course
     */
    public function prerequisite(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_prerequisite', 'course_id', 'prerequisite_id');
    }

    /**
     * The courses that belong to the prerequisite
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_prerequisite', 'prerequisite_id', 'course_id');
    }
}
