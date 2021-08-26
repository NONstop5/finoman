<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
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
    public function definition(): array
    {
        return [
            'user_id' => User::query()->orderByRaw('RAND()')->first()->id,
            'transaction_type_id' => $this->faker->numberBetween(1, 3),
            'wallet_from_id' => Wallet::query()->orderByRaw('RAND()')->first()->id,
            'wallet_to_id' => Wallet::query()->orderByRaw('RAND()')->first()->id,
            'category_id' => Category::query()->orderByRaw('RAND()')->first()->id,
            'amount' => $this->faker->randomFloat(2, 0, 8),
            'transacted_at' => $this->faker->dateTime(),
        ];
    }
}
