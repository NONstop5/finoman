<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'category_types',
            function (Blueprint $table) {
                $table->id();

                $table
                    ->string('name')
                    ->comment('Название типа категории');

                $table->timestamps();
            }
        );

        DB::table('category_types')->insert(
            [
                'name' => 'Доходная',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
        DB::table('category_types')->insert(
            [
                'name' => 'Расходная',
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
        Schema::dropIfExists('category_types');
    }
}