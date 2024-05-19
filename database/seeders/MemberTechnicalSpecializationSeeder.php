<?php

namespace Database\Seeders;

use App\Models\MemberTechnicalSpecialization;
use Illuminate\Database\Seeder;

class MemberTechnicalSpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MemberTechnicalSpecialization::factory()->count(5)->create();
    }
}
