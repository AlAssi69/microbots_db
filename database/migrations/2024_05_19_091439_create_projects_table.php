<?php

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
        Schema::disableForeignKeyConstraints();

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('hash_id');
            $table->string('name');
            $table->string('description');
            $table->date('start_date');
            $table->foreignId('color_id')->constrained();
            $table->foreignId('supervisior_id')->constrained('members');
            $table->foreignId('level_id')->constrained();
            $table->integer('budget')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
