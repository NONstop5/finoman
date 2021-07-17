<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            DB::table('transactions')->insert([
                'account_from_id' => rand(1,10),
                'account_to_id' => rand(1,10),
                'amount' => rand(1, 10000),
                'created_at' => now(),
                'updated_at' => now()
            ]);

    }
}
