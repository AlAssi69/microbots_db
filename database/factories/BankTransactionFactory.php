<?php

namespace Database\Factories;

use App\Models\BankTransaction;
use App\Models\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankTransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BankTransaction::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->numberBetween(-10000, 10000),
            'datetime' => $this->faker->dateTime(),
            'reason' => $this->faker->text(),
            'member_id' => Member::factory(),
        ];
    }
}
