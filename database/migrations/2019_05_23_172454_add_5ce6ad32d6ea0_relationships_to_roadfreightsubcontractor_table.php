<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad32d6ea0RelationshipsToRoadFreightSubContractorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('road_freight_sub_contractors', function(Blueprint $table) {
            if (!Schema::hasColumn('road_freight_sub_contractors', 'vendor_id')) {
                $table->integer('vendor_id')->unsigned()->nullable();
                $table->foreign('vendor_id', '237075_5c083a071b764')->references('id')->on('vendors')->onDelete('cascade');
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
        Schema::table('road_freight_sub_contractors', function(Blueprint $table) {
            if(Schema::hasColumn('road_freight_sub_contractors', 'vendor_id')) {
                $table->dropForeign('237075_5c083a071b764');
                $table->dropIndex('237075_5c083a071b764');
                $table->dropColumn('vendor_id');
            }
            
        });
    }
}
