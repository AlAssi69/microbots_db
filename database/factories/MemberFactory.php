<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Department;
use App\Models\Governorate;
use App\Models\Level;
use App\Models\Major;
use App\Models\Member;
use App\Models\MemberCategory;
use App\Models\MemberTechnicalSpecialization;
use App\Models\University;

class MemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'hash_id' => $this->faker->word(),
            'join_date' => $this->faker->date(),
            'first_name' => $this->faker->firstName(),
            'father_name' => $this->faker->word(),
            'last_name' => $this->faker->lastName(),
            'sex' => $this->faker->word(),
            'email' => $this->faker->safeEmail(),
            'date_of_birth' => $this->faker->word(),
            'university_id' => University::factory(),
            'major_id' => Major::factory(),
            'uni_year' => $this->faker->word(),
            'phone_number' => $this->faker->phoneNumber(),
            'emergency_name' => $this->faker->word(),
            'emergency_kinship' => $this->faker->word(),
            'emergency_phone' => $this->faker->word(),
            'governorate_id' => Governorate::factory(),
            'region_name' => $this->faker->word(),
            'street_name' => $this->faker->word(),
            'category_id' => MemberCategory::factory(),
            'level_id' => Level::factory(),
            'technical_specialization_id' => MemberTechnicalSpecialization::factory(),
            'department_id' => Department::factory(),
            'frozen' => $this->faker->boolean(),
            'work_from_home' => $this->faker->boolean(),
        ];
    }
}
