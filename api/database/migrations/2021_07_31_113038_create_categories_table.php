<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'categories',
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
                    ->unsignedBigInteger('category_type_id')
                    ->comment('Связь с типами категорий');
                $table
                    ->foreign('category_type_id')
                    ->references('id')
                    ->on('category_types');

                $table
                    ->string('name')
                    ->comment('Название категории');

                $table
                    ->float('budget')
                    ->comment('Бюджет категории');

                $table
                    ->string('icon')
                    ->comment('Иконка категории');

                $table->softDeletes();
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
        Schema::dropIfExists('categories');
    }
}
