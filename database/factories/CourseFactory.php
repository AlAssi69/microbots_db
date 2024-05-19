<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Course;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'hash_id' => $this->faker->word(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'start_date' => $this->faker->date(),
            'sessions' => $this->faker->numberBetween(-10000, 10000),
            'hours' => $this->faker->numberBetween(-10000, 10000),
            'certificate' => $this->faker->boolean(),
        ];
    }
}
