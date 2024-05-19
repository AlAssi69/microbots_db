<?php

namespace Database\Factories;

use App\Models\Color;
use App\Models\Level;
use App\Models\Member;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

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
            'color_id' => Color::factory(),
            'supervisior_id' => Member::factory(),
            'level_id' => Level::factory(),
            'budget' => $this->faker->numberBetween(-10000, 10000),
            'deadline' => $this->faker->dateTime(),
        ];
    }
}
