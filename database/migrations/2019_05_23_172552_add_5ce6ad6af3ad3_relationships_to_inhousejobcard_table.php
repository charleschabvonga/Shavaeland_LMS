<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad6af3ad3RelationshipsToInhouseJobCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inhouse_job_cards', function(Blueprint $table) {
            if (!Schema::hasColumn('inhouse_job_cards', 'project_number_id')) {
                $table->integer('project_number_id')->unsigned()->nullable();
                $table->foreign('project_number_id', '305096_5cde75d9eabfd')->references('id')->on('time_entries')->onDelete('cascade');
                }
                if (!Schema::hasColumn('inhouse_job_cards', 'repair_center_id')) {
                $table->integer('repair_center_id')->unsigned()->nullable();
                $table->foreign('repair_center_id', '305096_5cde75da22da6')->references('id')->on('workshops')->onDelete('cascade');
                }
                if (!Schema::hasColumn('inhouse_job_cards', 'vehicle_id')) {
                $table->integer('vehicle_id')->unsigned()->nullable();
                $table->foreign('vehicle_id', '305096_5cde75da4fa16')->references('id')->on('vehicles')->onDelete('cascade');
                }
                if (!Schema::hasColumn('inhouse_job_cards', 'trailer_id')) {
                $table->integer('trailer_id')->unsigned()->nullable();
                $table->foreign('trailer_id', '305096_5cde75da7d3ae')->references('id')->on('trailers')->onDelete('cascade');
                }
                if (!Schema::hasColumn('inhouse_job_cards', 'light_vehicles_id')) {
                $table->integer('light_vehicles_id')->unsigned()->nullable();
                $table->foreign('light_vehicles_id', '305096_5cde75daaeb75')->references('id')->on('light_vehicles')->onDelete('cascade');
                }
                if (!Schema::hasColumn('inhouse_job_cards', 'client_vehicle_reg_no_id')) {
                $table->integer('client_vehicle_reg_no_id')->unsigned()->nullable();
                $table->foreign('client_vehicle_reg_no_id', '305096_5cde75dadc5a2')->references('id')->on('vehicle_scs')->onDelete('cascade');
                }
                if (!Schema::hasColumn('inhouse_job_cards', 'road_freight_number_id')) {
                $table->integer('road_freight_number_id')->unsigned()->nullable();
                $table->foreign('road_freight_number_id', '305096_5cde75db16852')->references('id')->on('road_freights')->onDelete('cascade');
                }
                if (!Schema::hasColumn('inhouse_job_cards', 'workshop_manager_id')) {
                $table->integer('workshop_manager_id')->unsigned()->nullable();
                $table->foreign('workshop_manager_id', '305096_5ce573edc5bb9')->references('id')->on('employees')->onDelete('cascade');
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
        Schema::table('inhouse_job_cards', function(Blueprint $table) {
            if(Schema::hasColumn('inhouse_job_cards', 'project_number_id')) {
                $table->dropForeign('305096_5cde75d9eabfd');
                $table->dropIndex('305096_5cde75d9eabfd');
                $table->dropColumn('project_number_id');
            }
            if(Schema::hasColumn('inhouse_job_cards', 'repair_center_id')) {
                $table->dropForeign('305096_5cde75da22da6');
                $table->dropIndex('305096_5cde75da22da6');
                $table->dropColumn('repair_center_id');
            }
            if(Schema::hasColumn('inhouse_job_cards', 'vehicle_id')) {
                $table->dropForeign('305096_5cde75da4fa16');
                $table->dropIndex('305096_5cde75da4fa16');
                $table->dropColumn('vehicle_id');
            }
            if(Schema::hasColumn('inhouse_job_cards', 'trailer_id')) {
                $table->dropForeign('305096_5cde75da7d3ae');
                $table->dropIndex('305096_5cde75da7d3ae');
                $table->dropColumn('trailer_id');
            }
            if(Schema::hasColumn('inhouse_job_cards', 'light_vehicles_id')) {
                $table->dropForeign('305096_5cde75daaeb75');
                $table->dropIndex('305096_5cde75daaeb75');
                $table->dropColumn('light_vehicles_id');
            }
            if(Schema::hasColumn('inhouse_job_cards', 'client_vehicle_reg_no_id')) {
                $table->dropForeign('305096_5cde75dadc5a2');
                $table->dropIndex('305096_5cde75dadc5a2');
                $table->dropColumn('client_vehicle_reg_no_id');
            }
            if(Schema::hasColumn('inhouse_job_cards', 'road_freight_number_id')) {
                $table->dropForeign('305096_5cde75db16852');
                $table->dropIndex('305096_5cde75db16852');
                $table->dropColumn('road_freight_number_id');
            }
            if(Schema::hasColumn('inhouse_job_cards', 'workshop_manager_id')) {
                $table->dropForeign('305096_5ce573edc5bb9');
                $table->dropIndex('305096_5ce573edc5bb9');
                $table->dropColumn('workshop_manager_id');
            }
            
        });
    }
}
