<?php

use App\Models\Badge;
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
        Schema::create('badge_member', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Badge::class, 'badge_id')
                ->constrained();
            $table->foreignIdFor(Member::class, 'member_id')
                ->constrained();
            $table->date('date');
            $table->text('reason');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('badge_member');
    }
};
