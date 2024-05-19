<?php

namespace App\Traits\Models;

use App\Models\Course;
use App\Models\Member;
use App\Models\Project;

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

        if (! $isSaving) {
            $id = Project::latest()->value('id') + 1;
        }

        $model->hash_id = $model->name.$model->color->name.$model->level->name.$id;
    }

    private static function generateHashIdForCourse(Course $model, bool $isSaving = false)
    {
        $id = $model->id;

        if (! $isSaving) {
            $id = Course::latest()->value('id') + 1;
        }

        $model->hash_id = $model->name.$model->start_date.
            Course::where('name', $model->name)->count() + 1 .
            $id;
    }

    private static function generateHashIdForMember(Member $model, bool $isSaving = false)
    {
        $id = $model->id;

        if (! $isSaving) {
            $id = Member::latest()->value('id') + 1;
        }

        $model->hash_id = $model->join_date.$model->university->name.
            $model->major->name.$model->uni_year.$model->category->name.
            $model->level->name.$model->department->name.
            ($model->work_from_home ? '1' : '0').
            $id;
    }
}
