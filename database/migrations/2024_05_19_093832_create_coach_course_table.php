<?php

use App\Models\Course;
use App\Models\Member;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coach_course', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Course::class, "course_id")->constrained();
            $table->foreignIdFor(Member::class, "coach_id")->constrained();
            $table->integer("hours");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coach_course');
    }
};
