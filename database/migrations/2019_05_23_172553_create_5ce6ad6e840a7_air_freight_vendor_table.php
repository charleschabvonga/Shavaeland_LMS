<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ce6ad6e840a7AirFreightVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('air_freight_vendor')) {
            Schema::create('air_freight_vendor', function (Blueprint $table) {
                $table->integer('air_freight_id')->unsigned()->nullable();
                $table->foreign('air_freight_id', 'fk_p_237087_237069_vendor_5ce6ad6e84246')->references('id')->on('air_freights')->onDelete('cascade');
                $table->integer('vendor_id')->unsigned()->nullable();
                $table->foreign('vendor_id', 'fk_p_237069_237087_airfre_5ce6ad6e84322')->references('id')->on('vendors')->onDelete('cascade');
                
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
        Schema::dropIfExists('air_freight_vendor');
    }
}
