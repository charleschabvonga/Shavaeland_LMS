<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ce6ad6e7db2bDeliveryInstructionVehicleScTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('delivery_instruction_vehicle_sc')) {
            Schema::create('delivery_instruction_vehicle_sc', function (Blueprint $table) {
                $table->integer('delivery_instruction_id')->unsigned()->nullable();
                $table->foreign('delivery_instruction_id', 'fk_p_237078_237074_vehicl_5ce6ad6e7dc73')->references('id')->on('delivery_instructions')->onDelete('cascade');
                $table->integer('vehicle_sc_id')->unsigned()->nullable();
                $table->foreign('vehicle_sc_id', 'fk_p_237074_237078_delive_5ce6ad6e7dd1c')->references('id')->on('vehicle_scs')->onDelete('cascade');
                
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
        Schema::dropIfExists('delivery_instruction_vehicle_sc');
    }
}
