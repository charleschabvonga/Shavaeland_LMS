<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad346796bRelationshipsToRoadFreightTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('road_freights', function(Blueprint $table) {
            if (!Schema::hasColumn('road_freights', 'project_number_id')) {
                $table->integer('project_number_id')->unsigned()->nullable();
                $table->foreign('project_number_id', '237076_5c083a033935a')->references('id')->on('time_entries')->onDelete('cascade');
                }
                if (!Schema::hasColumn('road_freights', 'route_id')) {
                $table->integer('route_id')->unsigned()->nullable();
                $table->foreign('route_id', '237076_5c083a037d10e')->references('id')->on('routes')->onDelete('cascade');
                }
                if (!Schema::hasColumn('road_freights', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '237076_5c083a0349dcd')->references('id')->on('time_projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('road_freights', 'contact_person_id')) {
                $table->integer('contact_person_id')->unsigned()->nullable();
                $table->foreign('contact_person_id', '237076_5c083a035a7c7')->references('id')->on('client_contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('road_freights', 'project_manager_id')) {
                $table->integer('project_manager_id')->unsigned()->nullable();
                $table->foreign('project_manager_id', '237076_5c083a036cf65')->references('id')->on('employees')->onDelete('cascade');
                }
                if (!Schema::hasColumn('road_freights', 'driver_id')) {
                $table->integer('driver_id')->unsigned()->nullable();
                $table->foreign('driver_id', '237076_5c92197c3e181')->references('id')->on('employees')->onDelete('cascade');
                }
                if (!Schema::hasColumn('road_freights', 'vehicle_id')) {
                $table->integer('vehicle_id')->unsigned()->nullable();
                $table->foreign('vehicle_id', '237076_5c913f1abce88')->references('id')->on('vehicles')->onDelete('cascade');
                }
                if (!Schema::hasColumn('road_freights', 'subcontractor_number_id')) {
                $table->integer('subcontractor_number_id')->unsigned()->nullable();
                $table->foreign('subcontractor_number_id', '237076_5c0f8d44ce5f9')->references('id')->on('road_freight_sub_contractors')->onDelete('cascade');
                }
                if (!Schema::hasColumn('road_freights', 'vendor_id')) {
                $table->integer('vendor_id')->unsigned()->nullable();
                $table->foreign('vendor_id', '237076_5c08647401f21')->references('id')->on('vendors')->onDelete('cascade');
                }
                if (!Schema::hasColumn('road_freights', 'vendor_contact_person_id')) {
                $table->integer('vendor_contact_person_id')->unsigned()->nullable();
                $table->foreign('vendor_contact_person_id', '237076_5c0864741f023')->references('id')->on('vendor_contacts')->onDelete('cascade');
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
        Schema::table('road_freights', function(Blueprint $table) {
            if(Schema::hasColumn('road_freights', 'project_number_id')) {
                $table->dropForeign('237076_5c083a033935a');
                $table->dropIndex('237076_5c083a033935a');
                $table->dropColumn('project_number_id');
            }
            if(Schema::hasColumn('road_freights', 'route_id')) {
                $table->dropForeign('237076_5c083a037d10e');
                $table->dropIndex('237076_5c083a037d10e');
                $table->dropColumn('route_id');
            }
            if(Schema::hasColumn('road_freights', 'client_id')) {
                $table->dropForeign('237076_5c083a0349dcd');
                $table->dropIndex('237076_5c083a0349dcd');
                $table->dropColumn('client_id');
            }
            if(Schema::hasColumn('road_freights', 'contact_person_id')) {
                $table->dropForeign('237076_5c083a035a7c7');
                $table->dropIndex('237076_5c083a035a7c7');
                $table->dropColumn('contact_person_id');
            }
            if(Schema::hasColumn('road_freights', 'project_manager_id')) {
                $table->dropForeign('237076_5c083a036cf65');
                $table->dropIndex('237076_5c083a036cf65');
                $table->dropColumn('project_manager_id');
            }
            if(Schema::hasColumn('road_freights', 'driver_id')) {
                $table->dropForeign('237076_5c92197c3e181');
                $table->dropIndex('237076_5c92197c3e181');
                $table->dropColumn('driver_id');
            }
            if(Schema::hasColumn('road_freights', 'vehicle_id')) {
                $table->dropForeign('237076_5c913f1abce88');
                $table->dropIndex('237076_5c913f1abce88');
                $table->dropColumn('vehicle_id');
            }
            if(Schema::hasColumn('road_freights', 'subcontractor_number_id')) {
                $table->dropForeign('237076_5c0f8d44ce5f9');
                $table->dropIndex('237076_5c0f8d44ce5f9');
                $table->dropColumn('subcontractor_number_id');
            }
            if(Schema::hasColumn('road_freights', 'vendor_id')) {
                $table->dropForeign('237076_5c08647401f21');
                $table->dropIndex('237076_5c08647401f21');
                $table->dropColumn('vendor_id');
            }
            if(Schema::hasColumn('road_freights', 'vendor_contact_person_id')) {
                $table->dropForeign('237076_5c0864741f023');
                $table->dropIndex('237076_5c0864741f023');
                $table->dropColumn('vendor_contact_person_id');
            }
            
        });
    }
}
