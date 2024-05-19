<?php

namespace Database\Factories;

use App\Models\MemberTechnicalSpecialization;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberTechnicalSpecializationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MemberTechnicalSpecialization::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
