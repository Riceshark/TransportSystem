<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1538597433ParcelsHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('parcels_histories')) {
            Schema::create('parcels_histories', function (Blueprint $table) {
                $table->increments('id');
                $table->datetime('enter_time')->nullable();
                $table->datetime('leave_time')->nullable();
                $table->string('location_address')->nullable();
                $table->double('location_latitude')->nullable();
                $table->double('location_longitude')->nullable();
                
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
        Schema::dropIfExists('parcels_histories');
    }
}
