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
                ->unsignedBigInteger('transaction_type_id')
                ->comment('Связь с типами транзакций');
            $table
                ->foreign('transaction_type_id')
                ->references('id')
                ->on('transaction_types');

            $table
                ->unsignedBigInteger('wallet1_id')
                ->comment('Связь с кошельками');
            $table
                ->foreign('wallet1_id')
                ->references('id')
                ->on('wallets');

            $table
                ->unsignedBigInteger('wallet2_id')
                ->comment('Связь с кошельками');
            $table
                ->foreign('wallet2_id')
                ->references('id')
                ->on('wallets');

            $table
                ->unsignedBigInteger('category_id')
                ->comment('Связь с категориями');
            $table
                ->foreign('account_to_id')
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
