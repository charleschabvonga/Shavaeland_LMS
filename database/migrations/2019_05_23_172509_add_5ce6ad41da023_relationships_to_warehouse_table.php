<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad41da023RelationshipsToWarehouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('warehouses', function(Blueprint $table) {
            if (!Schema::hasColumn('warehouses', 'vendor_id')) {
                $table->integer('vendor_id')->unsigned()->nullable();
                $table->foreign('vendor_id', '237097_5c083a3c125cb')->references('id')->on('vendors')->onDelete('cascade');
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
        Schema::table('warehouses', function(Blueprint $table) {
            if(Schema::hasColumn('warehouses', 'vendor_id')) {
                $table->dropForeign('237097_5c083a3c125cb');
                $table->dropIndex('237097_5c083a3c125cb');
                $table->dropColumn('vendor_id');
            }
            
        });
    }
}
