<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'wallets',
            function (Blueprint $table) {
                $table->id();

                $table
                    ->unsignedBigInteger('user_id')
                    ->comment('Связь с пользователями');
                $table
                    ->foreign('user_id')
                    ->references('id')
                    ->on('users');

                $table
                    ->unsignedBigInteger('currency_id')
                    ->comment('Связь с валютами');
                $table
                    ->foreign('currency_id')
                    ->references('id')
                    ->on('currencies');

                $table
                    ->unsignedBigInteger('wallet_type_id')
                    ->comment('Связь с типами кошельков');
                $table
                    ->foreign('wallet_type_id')
                    ->references('id')
                    ->on('wallet_types');

                $table
                    ->string('name')
                    ->comment('Название кошелька');

                $table
                    ->string('balance')
                    ->comment('Начальный баланс кошелька');

                $table
                    ->string('balance_date')
                    ->comment('Дата начального баланса кошелька');

                $table
                    ->string('icon')
                    ->comment('Иконка кошелька');

                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
    }
}
