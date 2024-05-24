<?php

namespace App\Traits\Models;

use App\Models\Color;
use App\Models\Course;
use App\Models\Department;
use App\Models\Level;
use App\Models\Major;
use App\Models\Member;
use App\Models\MemberCategory;
use App\Models\Project;
use App\Models\University;

// TODO: Edit hashing
trait HasHashId
{
    public static function bootHasHashId()
    {
        static::creating(function ($model) {
            if ($model instanceof Project) {
                static::generateHashIdForProject($model);
            } elseif ($model instanceof Course) {
                static::generateHashIdForCourse($model);
            } elseif ($model instanceof Member) {
                static::generateHashIdForMember($model);
            }
        });

        static::saving(function ($model) {
            if ($model instanceof Project) {
                static::generateHashIdForProject($model, true);
            } elseif ($model instanceof Course) {
                static::generateHashIdForCourse($model, true);
            } elseif ($model instanceof Member) {
                static::generateHashIdForMember($model, true);
            }
        });
    }

    private static function generateHashIdForProject(Project $model, bool $isSaving = false)
    {
        $id = $model->id;

        $project_name = explode(" ", $model->name);
        $project_acronym = "";
        foreach ($project_name as $pn) {
            $project_acronym .= mb_substr($pn, 0, 1);
        }

        $color_id = Color::where('name', $model->color->name)->pluck('id')[0];
        $level_id = Level::where('name', $model->level->name)->pluck('id')[0];

        $model->hash_id = $color_id . $project_acronym . $level_id .
            (!$isSaving ? Project::latest()->value('id') + 1 : $id);;
    }

    private static function generateHashIdForCourse(Course $model, bool $isSaving = false)
    {
        $id = $model->id;

        $course_name = explode(" ", $model->name);
        $course_acronym = "";
        foreach ($course_name as $cn) {
            $course_acronym .= mb_substr($cn, 0, 1);
        }

        $date = explode(" ", $model->start_date)[0];
        list($year, $month, $day) = explode("-", $date);
        $year = $year - 2000;

        $course_count = Course::where('name', $model->name)->count() + 1;

        $model->hash_id = $year . $month . $day . $course_acronym .
            $course_count . (!$isSaving ? Course::latest()->value('id') + 1 : $id);
    }

    private static function generateHashIdForMember(Member $model, bool $isSaving = false)
    {
        $id = $model->id;

        $date = explode(" ", $model->join_date)[0];
        list($year, $month, $day) = explode("-", $date);
        $year = $year - 2000;

        $university_id = University::where('name', $model->university->name)->pluck('id')[0];

        $major_id = Major::where('name', $model->major->name)->pluck('id')[0];

        $category_id = MemberCategory::where('name', $model->category->name)->pluck('id')[0];

        $level_id = Level::where('name', $model->level->name)->pluck('id')[0];

        $department_id = Department::where('name', $model->department->name)->pluck('id')[0];

        $model->hash_id = $year . $month . $university_id . $major_id .
            $model->uni_year . $department_id . $category_id . $level_id .
            ($model->cnork_from_home ? '1' : '0') .
            (!$isSaving ? Member::latest()->value('id') + 1 : $id);
    }
}
