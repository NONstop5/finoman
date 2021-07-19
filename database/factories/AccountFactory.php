<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Type;
use App\Models\User;
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
            'user_id' => User::query()->orderByRaw('RAND()')->first()->id,
            'type_id' => Type::query()->orderByRaw('RAND()')->first()->id,
            'name' => $this->faker->name(),
        ];
    }
}
