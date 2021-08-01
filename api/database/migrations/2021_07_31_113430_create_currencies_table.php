<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'currencies',
            function (Blueprint $table) {
                $table->id();

                $table
                    ->string('name')
                    ->comment('Название валюты');

                $table
                    ->string('code')
                    ->comment('Код валюты');

                $table->timestamps();
            }
        );

        DB::table('currencies')->insert(
            [
                'name' => 'Рубль',
                'code' => '643',
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
        Schema::dropIfExists('currencies');
    }
}
