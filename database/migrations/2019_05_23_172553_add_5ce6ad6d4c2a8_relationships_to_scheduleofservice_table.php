<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad6d4c2a8RelationshipsToScheduleOfServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedule_of_services', function(Blueprint $table) {
            if (!Schema::hasColumn('schedule_of_services', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '305252_5cded4d151b8f')->references('id')->on('time_projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('schedule_of_services', 'job_card_number_id')) {
                $table->integer('job_card_number_id')->unsigned()->nullable();
                $table->foreign('job_card_number_id', '305252_5cded4d181983')->references('id')->on('inhouse_job_cards')->onDelete('cascade');
                }
                if (!Schema::hasColumn('schedule_of_services', 'vehicle_id')) {
                $table->integer('vehicle_id')->unsigned()->nullable();
                $table->foreign('vehicle_id', '305252_5cded4d1b65eb')->references('id')->on('vehicles')->onDelete('cascade');
                }
                if (!Schema::hasColumn('schedule_of_services', 'client_vehicle_id')) {
                $table->integer('client_vehicle_id')->unsigned()->nullable();
                $table->foreign('client_vehicle_id', '305252_5cded4d20195e')->references('id')->on('client_vehicles')->onDelete('cascade');
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
        Schema::table('schedule_of_services', function(Blueprint $table) {
            if(Schema::hasColumn('schedule_of_services', 'client_id')) {
                $table->dropForeign('305252_5cded4d151b8f');
                $table->dropIndex('305252_5cded4d151b8f');
                $table->dropColumn('client_id');
            }
            if(Schema::hasColumn('schedule_of_services', 'job_card_number_id')) {
                $table->dropForeign('305252_5cded4d181983');
                $table->dropIndex('305252_5cded4d181983');
                $table->dropColumn('job_card_number_id');
            }
            if(Schema::hasColumn('schedule_of_services', 'vehicle_id')) {
                $table->dropForeign('305252_5cded4d1b65eb');
                $table->dropIndex('305252_5cded4d1b65eb');
                $table->dropColumn('vehicle_id');
            }
            if(Schema::hasColumn('schedule_of_services', 'client_vehicle_id')) {
                $table->dropForeign('305252_5cded4d20195e');
                $table->dropIndex('305252_5cded4d20195e');
                $table->dropColumn('client_vehicle_id');
            }
            
        });
    }
}
