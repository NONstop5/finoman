<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table
                ->bigInteger('user_id')
                ->unsigned()
                ->index()
                ->comment('Связь с пользователями');
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users');

            $table
                ->unsignedBigInteger('transaction_type_id')
                ->comment('Связь с типами транзакций');
            $table
                ->foreign('transaction_type_id')
                ->references('id')
                ->on('transaction_types');

            $table
                ->unsignedBigInteger('wallet_from_id')
                ->comment('Связь с кошельками');
            $table
                ->foreign('wallet_from_id')
                ->references('id')
                ->on('wallets');

            $table
                ->unsignedBigInteger('wallet_to_id')
                ->comment('Связь с кошельками');
            $table
                ->foreign('wallet_to_id')
                ->references('id')
                ->on('wallets');

            $table
                ->unsignedBigInteger('category_id')
                ->comment('Связь с категориями');
            $table
                ->foreign('category_id')
                ->references('id')
                ->on('accounts');

            $table
                ->decimal('amount')
                ->comment('Сумма транзакции');

            $table
                ->dateTime('transacted_at')
                ->comment('Дата и время транзакции');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
