<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ce6ad6e89d4cSeaFreightVendorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('sea_freight_vendor')) {
            Schema::create('sea_freight_vendor', function (Blueprint $table) {
                $table->integer('sea_freight_id')->unsigned()->nullable();
                $table->foreign('sea_freight_id', 'fk_p_237091_237069_vendor_5ce6ad6e89ec0')->references('id')->on('sea_freights')->onDelete('cascade');
                $table->integer('vendor_id')->unsigned()->nullable();
                $table->foreign('vendor_id', 'fk_p_237069_237091_seafre_5ce6ad6e89f9c')->references('id')->on('vendors')->onDelete('cascade');
                
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
        Schema::dropIfExists('sea_freight_vendor');
    }
}
