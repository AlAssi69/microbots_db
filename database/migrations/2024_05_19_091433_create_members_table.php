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

        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('hash_id');
            $table->date('join_date');
            $table->string('first_name');
            $table->string('father_name');
            $table->string('last_name');
            $table->string('sex');
            $table->string('email')->unique();
            $table->string('date_of_birth');
            $table->foreignId('university_id')->constrained();
            $table->foreignId('major_id')->constrained();
            $table->string('uni_year');
            $table->string('phone_number');
            $table->string('emergency_name')->nullable();
            $table->string('emergency_kinship')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->foreignId('governorate_id')->constrained();
            $table->string('region_name')->nullable();
            $table->string('street_name')->nullable();
            $table->foreignId('category_id')->constrained("member_categories");
            $table->foreignId('level_id')->constrained();
            $table->foreignId('technical_specialization_id')->constrained('member_technical_specializations');
            $table->foreignId('department_id')->constrained();
            $table->boolean('frozen');
            $table->boolean('work_from_home');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
