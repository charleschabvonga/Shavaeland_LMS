<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad3bab10bRelationshipsToDeliveryInstructionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_instructions', function(Blueprint $table) {
            if (!Schema::hasColumn('delivery_instructions', 'road_freight_number_id')) {
                $table->integer('road_freight_number_id')->unsigned()->nullable();
                $table->foreign('road_freight_number_id', '237078_5c083a1d5c398')->references('id')->on('road_freights')->onDelete('cascade');
                }
                if (!Schema::hasColumn('delivery_instructions', 'driver_id')) {
                $table->integer('driver_id')->unsigned()->nullable();
                $table->foreign('driver_id', '237078_5c083a1d6ca69')->references('id')->on('employees')->onDelete('cascade');
                }
                if (!Schema::hasColumn('delivery_instructions', 'vehicle_id')) {
                $table->integer('vehicle_id')->unsigned()->nullable();
                $table->foreign('vehicle_id', '237078_5c9142e478576')->references('id')->on('vehicles')->onDelete('cascade');
                }
                if (!Schema::hasColumn('delivery_instructions', 'vendor_id')) {
                $table->integer('vendor_id')->unsigned()->nullable();
                $table->foreign('vendor_id', '237078_5c9388a1aa79d')->references('id')->on('vendors')->onDelete('cascade');
                }
                if (!Schema::hasColumn('delivery_instructions', 'vendor_driver_id')) {
                $table->integer('vendor_driver_id')->unsigned()->nullable();
                $table->foreign('vendor_driver_id', '237078_5c336fca910db')->references('id')->on('drivers')->onDelete('cascade');
                }
                if (!Schema::hasColumn('delivery_instructions', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '237078_5c083a1d80467')->references('id')->on('time_projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('delivery_instructions', 'contact_person_id')) {
                $table->integer('contact_person_id')->unsigned()->nullable();
                $table->foreign('contact_person_id', '237078_5c083a1d9072e')->references('id')->on('client_contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('delivery_instructions', 'project_manager_id')) {
                $table->integer('project_manager_id')->unsigned()->nullable();
                $table->foreign('project_manager_id', '237078_5c083a1daa741')->references('id')->on('employees')->onDelete('cascade');
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
        Schema::table('delivery_instructions', function(Blueprint $table) {
            if(Schema::hasColumn('delivery_instructions', 'road_freight_number_id')) {
                $table->dropForeign('237078_5c083a1d5c398');
                $table->dropIndex('237078_5c083a1d5c398');
                $table->dropColumn('road_freight_number_id');
            }
            if(Schema::hasColumn('delivery_instructions', 'driver_id')) {
                $table->dropForeign('237078_5c083a1d6ca69');
                $table->dropIndex('237078_5c083a1d6ca69');
                $table->dropColumn('driver_id');
            }
            if(Schema::hasColumn('delivery_instructions', 'vehicle_id')) {
                $table->dropForeign('237078_5c9142e478576');
                $table->dropIndex('237078_5c9142e478576');
                $table->dropColumn('vehicle_id');
            }
            if(Schema::hasColumn('delivery_instructions', 'vendor_id')) {
                $table->dropForeign('237078_5c9388a1aa79d');
                $table->dropIndex('237078_5c9388a1aa79d');
                $table->dropColumn('vendor_id');
            }
            if(Schema::hasColumn('delivery_instructions', 'vendor_driver_id')) {
                $table->dropForeign('237078_5c336fca910db');
                $table->dropIndex('237078_5c336fca910db');
                $table->dropColumn('vendor_driver_id');
            }
            if(Schema::hasColumn('delivery_instructions', 'client_id')) {
                $table->dropForeign('237078_5c083a1d80467');
                $table->dropIndex('237078_5c083a1d80467');
                $table->dropColumn('client_id');
            }
            if(Schema::hasColumn('delivery_instructions', 'contact_person_id')) {
                $table->dropForeign('237078_5c083a1d9072e');
                $table->dropIndex('237078_5c083a1d9072e');
                $table->dropColumn('contact_person_id');
            }
            if(Schema::hasColumn('delivery_instructions', 'project_manager_id')) {
                $table->dropForeign('237078_5c083a1daa741');
                $table->dropIndex('237078_5c083a1daa741');
                $table->dropColumn('project_manager_id');
            }
            
        });
    }
}
