<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ce6ad6e72eecRoadFreightVehicleScTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('road_freight_vehicle_sc')) {
            Schema::create('road_freight_vehicle_sc', function (Blueprint $table) {
                $table->integer('road_freight_id')->unsigned()->nullable();
                $table->foreign('road_freight_id', 'fk_p_237076_237074_vehicl_5ce6ad6e7306e')->references('id')->on('road_freights')->onDelete('cascade');
                $table->integer('vehicle_sc_id')->unsigned()->nullable();
                $table->foreign('vehicle_sc_id', 'fk_p_237074_237076_roadfr_5ce6ad6e73143')->references('id')->on('vehicle_scs')->onDelete('cascade');
                
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
        Schema::dropIfExists('road_freight_vehicle_sc');
    }
}
