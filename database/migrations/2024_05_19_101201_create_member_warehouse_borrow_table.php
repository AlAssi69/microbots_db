<?php

use App\Models\Member;
use App\Models\Project;
use App\Models\Warehouse;
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
        Schema::create('member_warehouse_borrow', function (Blueprint $table) {
            $table->id();

            // TODO: Make sure about the non-binary relationship
            $table->foreignIdFor(Member::class, 'member_id')->constrained();
            $table->foreignIdFor(Warehouse::class, 'warehouse_id')->constrained();
            $table->foreignIdFor(Project::class, 'project_id')->constrained();
            $table->date('date');
            $table->text('reason');
            $table->integer('count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_warehouse_borrow');
    }
};
