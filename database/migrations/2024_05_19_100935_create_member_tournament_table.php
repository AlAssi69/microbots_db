<?php

use App\Models\Member;
use App\Models\Tournament;
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
        Schema::create('member_tournament', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Member::class, 'member_id')->constrained();
            $table->foreignIdFor(Tournament::class, 'tournament_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_tournament');
    }
};
