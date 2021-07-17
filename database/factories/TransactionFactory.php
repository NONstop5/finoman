<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 6),
            'account_from_id' => $this->faker->numberBetween(1,20),
            'account_to_id' => $this->faker->numberBetween(1, 20),
            'amount' => $this->faker->numberBetween(1,10000),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
