<?php

use App\Models\Member;
use App\Models\Skill;
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
        Schema::create('member_skill', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Member::class, 'member_id')->constrained();
            $table->foreignIdFor(Skill::class, 'skill_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_skill');
    }
};
