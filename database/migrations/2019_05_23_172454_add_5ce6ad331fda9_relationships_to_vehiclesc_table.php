<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad331fda9RelationshipsToVehicleScTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicle_scs', function(Blueprint $table) {
            if (!Schema::hasColumn('vehicle_scs', 'vendor_id')) {
                $table->integer('vendor_id')->unsigned()->nullable();
                $table->foreign('vendor_id', '237074_5c083a0a70d18')->references('id')->on('vendors')->onDelete('cascade');
                }
                if (!Schema::hasColumn('vehicle_scs', 'subcontractor_number_id')) {
                $table->integer('subcontractor_number_id')->unsigned()->nullable();
                $table->foreign('subcontractor_number_id', '237074_5c0f888de2bc4')->references('id')->on('road_freight_sub_contractors')->onDelete('cascade');
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
        Schema::table('vehicle_scs', function(Blueprint $table) {
            if(Schema::hasColumn('vehicle_scs', 'vendor_id')) {
                $table->dropForeign('237074_5c083a0a70d18');
                $table->dropIndex('237074_5c083a0a70d18');
                $table->dropColumn('vendor_id');
            }
            if(Schema::hasColumn('vehicle_scs', 'subcontractor_number_id')) {
                $table->dropForeign('237074_5c0f888de2bc4');
                $table->dropIndex('237074_5c0f888de2bc4');
                $table->dropColumn('subcontractor_number_id');
            }
            
        });
    }
}
