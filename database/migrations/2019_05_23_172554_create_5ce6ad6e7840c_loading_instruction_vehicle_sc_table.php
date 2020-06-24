<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ce6ad6e7840cLoadingInstructionVehicleScTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('loading_instruction_vehicle_sc')) {
            Schema::create('loading_instruction_vehicle_sc', function (Blueprint $table) {
                $table->integer('loading_instruction_id')->unsigned()->nullable();
                $table->foreign('loading_instruction_id', 'fk_p_237085_237074_vehicl_5ce6ad6e785b6')->references('id')->on('loading_instructions')->onDelete('cascade');
                $table->integer('vehicle_sc_id')->unsigned()->nullable();
                $table->foreign('vehicle_sc_id', 'fk_p_237074_237085_loadin_5ce6ad6e786a8')->references('id')->on('vehicle_scs')->onDelete('cascade');
                
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
        Schema::dropIfExists('loading_instruction_vehicle_sc');
    }
}
