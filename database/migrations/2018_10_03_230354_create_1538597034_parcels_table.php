<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1538597034ParcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('parcels')) {
            Schema::create('parcels', function (Blueprint $table) {
                $table->increments('id');
                $table->string('state')->nullable();
                $table->double('height', 4, 2)->nullable();
                $table->double('width', 4, 2)->nullable();
                $table->double('length', 4, 2)->nullable();
                $table->double('weight', 4, 2)->nullable();
                $table->string('delivery_type')->nullable();
                $table->double('cost', 4, 2)->nullable();
                $table->string('location_address')->nullable();
                $table->double('location_latitude')->nullable();
                $table->double('location_longitude')->nullable();
                $table->string('origin_address')->nullable();
                $table->double('origin_latitude')->nullable();
                $table->double('origin_longitude')->nullable();
                $table->string('destination_address')->nullable();
                $table->double('destination_latitude')->nullable();
                $table->double('destination_longitude')->nullable();
                $table->tinyInteger('insurance')->nullable()->default('0');
                $table->integer('priority')->nullable();
                $table->datetime('delivery_time')->nullable();
                
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
        Schema::dropIfExists('parcels');
    }
}
