<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad6a3f8bbRelationshipsToNonMachineCostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('non_machine_costs', function(Blueprint $table) {
            if (!Schema::hasColumn('non_machine_costs', 'road_freight_number_id')) {
                $table->integer('road_freight_number_id')->unsigned()->nullable();
                $table->foreign('road_freight_number_id', '237056_5c08542c54e07')->references('id')->on('road_freights')->onDelete('cascade');
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
        Schema::table('non_machine_costs', function(Blueprint $table) {
            if(Schema::hasColumn('non_machine_costs', 'road_freight_number_id')) {
                $table->dropForeign('237056_5c08542c54e07');
                $table->dropIndex('237056_5c08542c54e07');
                $table->dropColumn('road_freight_number_id');
            }
            
        });
    }
}
