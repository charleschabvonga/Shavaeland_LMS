<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad36e1f47RelationshipsToMachineryCostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('machinery_costs', function(Blueprint $table) {
            if (!Schema::hasColumn('machinery_costs', 'road_freight_number_id')) {
                $table->integer('road_freight_number_id')->unsigned()->nullable();
                $table->foreign('road_freight_number_id', '238402_5c0cd2aa3da89')->references('id')->on('road_freights')->onDelete('cascade');
                }
                if (!Schema::hasColumn('machinery_costs', 'route_id')) {
                $table->integer('route_id')->unsigned()->nullable();
                $table->foreign('route_id', '238402_5c0cd2aa68145')->references('id')->on('routes')->onDelete('cascade');
                }
                if (!Schema::hasColumn('machinery_costs', 'truck_attachment_status_id')) {
                $table->integer('truck_attachment_status_id')->unsigned()->nullable();
                $table->foreign('truck_attachment_status_id', '238402_5c0cd2aabc007')->references('id')->on('truck_attachment_statuses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('machinery_costs', 'machinery_attachment_type_id')) {
                $table->integer('machinery_attachment_type_id')->unsigned()->nullable();
                $table->foreign('machinery_attachment_type_id', '238402_5c0cd2ab04156')->references('id')->on('machinery_types')->onDelete('cascade');
                }
                if (!Schema::hasColumn('machinery_costs', 'size_id')) {
                $table->integer('size_id')->unsigned()->nullable();
                $table->foreign('size_id', '238402_5c0cd2ab2a1cc')->references('id')->on('machinery_sizes')->onDelete('cascade');
                }
                if (!Schema::hasColumn('machinery_costs', 'vehicle_description_id')) {
                $table->integer('vehicle_description_id')->unsigned()->nullable();
                $table->foreign('vehicle_description_id', '238402_5c9212b7d65b2')->references('id')->on('vehicles')->onDelete('cascade');
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
        Schema::table('machinery_costs', function(Blueprint $table) {
            if(Schema::hasColumn('machinery_costs', 'road_freight_number_id')) {
                $table->dropForeign('238402_5c0cd2aa3da89');
                $table->dropIndex('238402_5c0cd2aa3da89');
                $table->dropColumn('road_freight_number_id');
            }
            if(Schema::hasColumn('machinery_costs', 'route_id')) {
                $table->dropForeign('238402_5c0cd2aa68145');
                $table->dropIndex('238402_5c0cd2aa68145');
                $table->dropColumn('route_id');
            }
            if(Schema::hasColumn('machinery_costs', 'truck_attachment_status_id')) {
                $table->dropForeign('238402_5c0cd2aabc007');
                $table->dropIndex('238402_5c0cd2aabc007');
                $table->dropColumn('truck_attachment_status_id');
            }
            if(Schema::hasColumn('machinery_costs', 'machinery_attachment_type_id')) {
                $table->dropForeign('238402_5c0cd2ab04156');
                $table->dropIndex('238402_5c0cd2ab04156');
                $table->dropColumn('machinery_attachment_type_id');
            }
            if(Schema::hasColumn('machinery_costs', 'size_id')) {
                $table->dropForeign('238402_5c0cd2ab2a1cc');
                $table->dropIndex('238402_5c0cd2ab2a1cc');
                $table->dropColumn('size_id');
            }
            if(Schema::hasColumn('machinery_costs', 'vehicle_description_id')) {
                $table->dropForeign('238402_5c9212b7d65b2');
                $table->dropIndex('238402_5c9212b7d65b2');
                $table->dropColumn('vehicle_description_id');
            }
            
        });
    }
}
