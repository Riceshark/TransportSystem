<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('budgets')) {
            Schema::create('budgets', function (Blueprint $table) {
                $table->increments('id');

                $table->string('name');
                $table->double('value', 4, 2)->nullable();
                $table->text('description')->nullable();
                $table->dateTime('date');

                $table->timestamps();

            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('budgets');
    }
}
