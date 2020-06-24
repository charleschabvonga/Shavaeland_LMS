<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad3978579RelationshipsToLoadingInstructionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loading_instructions', function(Blueprint $table) {
            if (!Schema::hasColumn('loading_instructions', 'road_freight_number_id')) {
                $table->integer('road_freight_number_id')->unsigned()->nullable();
                $table->foreign('road_freight_number_id', '237085_5c083a179e35f')->references('id')->on('road_freights')->onDelete('cascade');
                }
                if (!Schema::hasColumn('loading_instructions', 'driver_id')) {
                $table->integer('driver_id')->unsigned()->nullable();
                $table->foreign('driver_id', '237085_5c083a17aef03')->references('id')->on('employees')->onDelete('cascade');
                }
                if (!Schema::hasColumn('loading_instructions', 'vehicle_id')) {
                $table->integer('vehicle_id')->unsigned()->nullable();
                $table->foreign('vehicle_id', '237085_5c91413a3f54f')->references('id')->on('vehicles')->onDelete('cascade');
                }
                if (!Schema::hasColumn('loading_instructions', 'vendor_id')) {
                $table->integer('vendor_id')->unsigned()->nullable();
                $table->foreign('vendor_id', '237085_5c9385ed0d089')->references('id')->on('vendors')->onDelete('cascade');
                }
                if (!Schema::hasColumn('loading_instructions', 'vendor_driver_id')) {
                $table->integer('vendor_driver_id')->unsigned()->nullable();
                $table->foreign('vendor_driver_id', '237085_5c336c6ce86a1')->references('id')->on('drivers')->onDelete('cascade');
                }
                if (!Schema::hasColumn('loading_instructions', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '237085_5c083a17c3971')->references('id')->on('time_projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('loading_instructions', 'contact_person_id')) {
                $table->integer('contact_person_id')->unsigned()->nullable();
                $table->foreign('contact_person_id', '237085_5c083a17d6847')->references('id')->on('client_contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('loading_instructions', 'project_manager_id')) {
                $table->integer('project_manager_id')->unsigned()->nullable();
                $table->foreign('project_manager_id', '237085_5c083a17eb5c5')->references('id')->on('employees')->onDelete('cascade');
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
        Schema::table('loading_instructions', function(Blueprint $table) {
            if(Schema::hasColumn('loading_instructions', 'road_freight_number_id')) {
                $table->dropForeign('237085_5c083a179e35f');
                $table->dropIndex('237085_5c083a179e35f');
                $table->dropColumn('road_freight_number_id');
            }
            if(Schema::hasColumn('loading_instructions', 'driver_id')) {
                $table->dropForeign('237085_5c083a17aef03');
                $table->dropIndex('237085_5c083a17aef03');
                $table->dropColumn('driver_id');
            }
            if(Schema::hasColumn('loading_instructions', 'vehicle_id')) {
                $table->dropForeign('237085_5c91413a3f54f');
                $table->dropIndex('237085_5c91413a3f54f');
                $table->dropColumn('vehicle_id');
            }
            if(Schema::hasColumn('loading_instructions', 'vendor_id')) {
                $table->dropForeign('237085_5c9385ed0d089');
                $table->dropIndex('237085_5c9385ed0d089');
                $table->dropColumn('vendor_id');
            }
            if(Schema::hasColumn('loading_instructions', 'vendor_driver_id')) {
                $table->dropForeign('237085_5c336c6ce86a1');
                $table->dropIndex('237085_5c336c6ce86a1');
                $table->dropColumn('vendor_driver_id');
            }
            if(Schema::hasColumn('loading_instructions', 'client_id')) {
                $table->dropForeign('237085_5c083a17c3971');
                $table->dropIndex('237085_5c083a17c3971');
                $table->dropColumn('client_id');
            }
            if(Schema::hasColumn('loading_instructions', 'contact_person_id')) {
                $table->dropForeign('237085_5c083a17d6847');
                $table->dropIndex('237085_5c083a17d6847');
                $table->dropColumn('contact_person_id');
            }
            if(Schema::hasColumn('loading_instructions', 'project_manager_id')) {
                $table->dropForeign('237085_5c083a17eb5c5');
                $table->dropIndex('237085_5c083a17eb5c5');
                $table->dropColumn('project_manager_id');
            }
            
        });
    }
}
