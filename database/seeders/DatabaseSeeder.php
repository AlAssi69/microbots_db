<?php

namespace Database\Seeders;

use App\Models\MemberTechnicalSpecialization;
use App\Models\User;
use Database\Factories\DepartmentFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Ashraf AlAssi',
            'email' => 'admin@admin.com',
        ]);

        $this->call([
            BadgeSeeder::class,
            ColorSeeder::class,
            PartSeeder::class,
            LevelSeeder::class,
            MajorSeeder::class,
            SkillSeeder::class,
            WarehouseSeeder::class,
            TournamentSeeder::class,
            UniversitySeeder::class,
            GovernorateSeeder::class,
            MemberCategorySeeder::class,
            MemberTechnicalSpecializationSeeder::class,
        ]);
    }
}
