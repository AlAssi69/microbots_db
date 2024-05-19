<?php

use App\Models\Part;
use App\Models\Project;
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
        Schema::create('part_project', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Part::class, "part_id")->constrained();
            $table->foreignIdFor(Project::class, "project_id")->constrained();
            $table->integer("count");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('part_project');
    }
};
