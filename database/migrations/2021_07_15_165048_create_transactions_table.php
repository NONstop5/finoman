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
                ->unsignedBigInteger('account_from_id')
                ->comment('Связь с accounts');
            $table
                ->foreign('account_from_id')
                ->references('id')
                ->on('accounts');

            $table
                ->unsignedBigInteger('account_to_id')
                ->comment('Связь с accounts');
            $table
                ->foreign('account_to_id')
                ->references('id')
                ->on('accounts');

            $table
                ->decimal('amount')
                ->comment('Сумма транзакции');

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
