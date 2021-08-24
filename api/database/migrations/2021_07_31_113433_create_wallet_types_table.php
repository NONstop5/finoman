<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'wallet_types',
            function (Blueprint $table) {
                $table->id();

                $table
                    ->string('name')
                    ->comment('Название типа кошелька');

                $table->timestamps();
            }
        );

        DB::table('wallet_types')->insert(
            [
                'name' => 'Дебетовый',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        DB::table('wallet_types')->insert(
            [
                'name' => 'Кредитовый',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_types');
    }
}
