<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(2)->create();
        Wallet::factory(5)->create(['user_id' => 1]);
        Category::factory(5)->create(['user_id' => 1]);
        Transaction::factory(20)->create(['user_id' => 1]);
    }
}
