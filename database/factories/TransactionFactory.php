<?php

namespace Database\Factories;

use App\Models\Account;
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
            'account_from_id' => Account::query()->orderByRaw('RAND()')->first()->id,
            'account_to_id' => Account::query()->orderByRaw('RAND()')->first()->id,
            'amount' => $this->faker->randomFloat(2, 0, 8),
            'transacted_at' => $this->faker->dateTime(),
        ];
    }
}
