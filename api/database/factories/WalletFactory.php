<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

class WalletFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Wallet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::query()->orderByRaw('RAND()')->first()->id,
            'currency_id' => 1,
            'wallet_type_id' => $this->faker->numberBetween(1, 2),
            'name' => $this->faker->randomElement(
                [
                    'Наличка',
                    'Карта Сбер',
                    'Карта ВТБ',
                    'Qiwi',
                ]
            ),
            'balance' => $this->faker->randomFloat(2, 0, 8),
            'balance_date' => now(),
            'icon' => 'wallet',
        ];
    }
}
