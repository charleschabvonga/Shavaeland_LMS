<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ce6ad6e86ee7RailFreightVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('rail_freight_vendor')) {
            Schema::create('rail_freight_vendor', function (Blueprint $table) {
                $table->integer('rail_freight_id')->unsigned()->nullable();
                $table->foreign('rail_freight_id', 'fk_p_237092_237069_vendor_5ce6ad6e87064')->references('id')->on('rail_freights')->onDelete('cascade');
                $table->integer('vendor_id')->unsigned()->nullable();
                $table->foreign('vendor_id', 'fk_p_237069_237092_railfr_5ce6ad6e87140')->references('id')->on('vendors')->onDelete('cascade');
                
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
        Schema::dropIfExists('rail_freight_vendor');
    }
}
