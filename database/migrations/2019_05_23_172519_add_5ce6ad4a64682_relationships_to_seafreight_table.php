<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad4a64682RelationshipsToSeaFreightTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sea_freights', function(Blueprint $table) {
            if (!Schema::hasColumn('sea_freights', 'project_number_id')) {
                $table->integer('project_number_id')->unsigned()->nullable();
                $table->foreign('project_number_id', '237091_5c083a57e0f40')->references('id')->on('time_entries')->onDelete('cascade');
                }
                if (!Schema::hasColumn('sea_freights', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '237091_5c083a57f2786')->references('id')->on('time_projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('sea_freights', 'contact_person_id')) {
                $table->integer('contact_person_id')->unsigned()->nullable();
                $table->foreign('contact_person_id', '237091_5c0973f0da29d')->references('id')->on('client_contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('sea_freights', 'shipper_or_agent_contact_id')) {
                $table->integer('shipper_or_agent_contact_id')->unsigned()->nullable();
                $table->foreign('shipper_or_agent_contact_id', '237091_5c083a580fd82')->references('id')->on('vendor_contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('sea_freights', 'project_manager_id')) {
                $table->integer('project_manager_id')->unsigned()->nullable();
                $table->foreign('project_manager_id', '237091_5c083a5825c91')->references('id')->on('employees')->onDelete('cascade');
                }
                if (!Schema::hasColumn('sea_freights', 'route_id')) {
                $table->integer('route_id')->unsigned()->nullable();
                $table->foreign('route_id', '237091_5c083a5835cc8')->references('id')->on('routes')->onDelete('cascade');
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
        Schema::table('sea_freights', function(Blueprint $table) {
            if(Schema::hasColumn('sea_freights', 'project_number_id')) {
                $table->dropForeign('237091_5c083a57e0f40');
                $table->dropIndex('237091_5c083a57e0f40');
                $table->dropColumn('project_number_id');
            }
            if(Schema::hasColumn('sea_freights', 'client_id')) {
                $table->dropForeign('237091_5c083a57f2786');
                $table->dropIndex('237091_5c083a57f2786');
                $table->dropColumn('client_id');
            }
            if(Schema::hasColumn('sea_freights', 'contact_person_id')) {
                $table->dropForeign('237091_5c0973f0da29d');
                $table->dropIndex('237091_5c0973f0da29d');
                $table->dropColumn('contact_person_id');
            }
            if(Schema::hasColumn('sea_freights', 'shipper_or_agent_contact_id')) {
                $table->dropForeign('237091_5c083a580fd82');
                $table->dropIndex('237091_5c083a580fd82');
                $table->dropColumn('shipper_or_agent_contact_id');
            }
            if(Schema::hasColumn('sea_freights', 'project_manager_id')) {
                $table->dropForeign('237091_5c083a5825c91');
                $table->dropIndex('237091_5c083a5825c91');
                $table->dropColumn('project_manager_id');
            }
            if(Schema::hasColumn('sea_freights', 'route_id')) {
                $table->dropForeign('237091_5c083a5835cc8');
                $table->dropIndex('237091_5c083a5835cc8');
                $table->dropColumn('route_id');
            }
            
        });
    }
}
