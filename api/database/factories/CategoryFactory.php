<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()->orderByRaw('RAND()')->first()->id,
            'category_type_id' => $this->faker->numberBetween(1, 2),
            'name' => $this->faker->randomElement(
                [
                    'Продукты',
                    'Транспорт',
                    'Кафе',
                    'Здоровье',
                ]
            ),
            'budget' => 10000,
            'icon' => $this->faker->randomElement(
                [
                    'home',
                    'pets',
                    'fitness_center',
                    'restaurant',
                ]
            ),
        ];
    }
}
