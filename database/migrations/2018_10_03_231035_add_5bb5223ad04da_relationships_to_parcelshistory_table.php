<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5bb5223ad04daRelationshipsToParcelsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parcels_histories', function(Blueprint $table) {
            if (!Schema::hasColumn('parcels_histories', 'parcel_id')) {
                $table->integer('parcel_id')->unsigned()->nullable();
                $table->foreign('parcel_id', '215116_5bb5223a14640')->references('id')->on('parcels')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parcels_histories', function(Blueprint $table) {
            
        });
    }
}
