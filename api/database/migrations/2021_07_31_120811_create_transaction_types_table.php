<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'transaction_types',
            function (Blueprint $table) {
                $table->id();

                $table
                    ->string('name')
                    ->comment('Название типа транзакции');

                $table->timestamps();
            }
        );

        DB::table('transaction_types')->insert(
            [
                'name' => 'Доход',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        DB::table('transaction_types')->insert(
            [
                'name' => 'Расход',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        DB::table('transaction_types')->insert(
            [
                'name' => 'Перевод',
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
        Schema::dropIfExists('transaction_types');
    }
}
