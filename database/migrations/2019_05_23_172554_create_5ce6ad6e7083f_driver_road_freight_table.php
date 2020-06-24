<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ce6ad6e7083fDriverRoadFreightTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('driver_road_freight')) {
            Schema::create('driver_road_freight', function (Blueprint $table) {
                $table->integer('driver_id')->unsigned()->nullable();
                $table->foreign('driver_id', 'fk_p_237073_237076_roadfr_5ce6ad6e7097f')->references('id')->on('drivers')->onDelete('cascade');
                $table->integer('road_freight_id')->unsigned()->nullable();
                $table->foreign('road_freight_id', 'fk_p_237076_237073_driver_5ce6ad6e70a52')->references('id')->on('road_freights')->onDelete('cascade');
                
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
        Schema::dropIfExists('driver_road_freight');
    }
}
