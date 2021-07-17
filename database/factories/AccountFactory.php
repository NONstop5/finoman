<?php

namespace Database\Factories;

use App\Models\Account;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Account::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 6),
            'types_id' => $this->faker->numberBetween(1,2),
            'name' => $this->faker->name(),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
