<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrucksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('trucks')) {
            Schema::create('trucks', function (Blueprint $table) {
                $table->increments('id');
                $table->string('state')->nullable();
                $table->string('car_model')->nullable();
                $table->string('driver_name')->nullable();
                $table->double('latitude')->nullable();
                $table->double('longitude')->nullable();


                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
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
        Schema::dropIfExists('trucks');
    }
}
