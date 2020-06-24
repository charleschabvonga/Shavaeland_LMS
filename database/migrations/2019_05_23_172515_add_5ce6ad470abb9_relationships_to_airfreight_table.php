<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad470abb9RelationshipsToAirFreightTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('air_freights', function(Blueprint $table) {
            if (!Schema::hasColumn('air_freights', 'project_number_id')) {
                $table->integer('project_number_id')->unsigned()->nullable();
                $table->foreign('project_number_id', '237087_5c083a4d5ee0d')->references('id')->on('time_entries')->onDelete('cascade');
                }
                if (!Schema::hasColumn('air_freights', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '237087_5c083a4d71911')->references('id')->on('time_projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('air_freights', 'contact_person_id')) {
                $table->integer('contact_person_id')->unsigned()->nullable();
                $table->foreign('contact_person_id', '237087_5c083a4d81fe9')->references('id')->on('client_contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('air_freights', 'airline_or_agent_contact_id')) {
                $table->integer('airline_or_agent_contact_id')->unsigned()->nullable();
                $table->foreign('airline_or_agent_contact_id', '237087_5c083a4d95932')->references('id')->on('vendor_contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('air_freights', 'project_manager_id')) {
                $table->integer('project_manager_id')->unsigned()->nullable();
                $table->foreign('project_manager_id', '237087_5c083a4da87cc')->references('id')->on('employees')->onDelete('cascade');
                }
                if (!Schema::hasColumn('air_freights', 'route_id')) {
                $table->integer('route_id')->unsigned()->nullable();
                $table->foreign('route_id', '237087_5c083a4db97fc')->references('id')->on('routes')->onDelete('cascade');
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
        Schema::table('air_freights', function(Blueprint $table) {
            if(Schema::hasColumn('air_freights', 'project_number_id')) {
                $table->dropForeign('237087_5c083a4d5ee0d');
                $table->dropIndex('237087_5c083a4d5ee0d');
                $table->dropColumn('project_number_id');
            }
            if(Schema::hasColumn('air_freights', 'client_id')) {
                $table->dropForeign('237087_5c083a4d71911');
                $table->dropIndex('237087_5c083a4d71911');
                $table->dropColumn('client_id');
            }
            if(Schema::hasColumn('air_freights', 'contact_person_id')) {
                $table->dropForeign('237087_5c083a4d81fe9');
                $table->dropIndex('237087_5c083a4d81fe9');
                $table->dropColumn('contact_person_id');
            }
            if(Schema::hasColumn('air_freights', 'airline_or_agent_contact_id')) {
                $table->dropForeign('237087_5c083a4d95932');
                $table->dropIndex('237087_5c083a4d95932');
                $table->dropColumn('airline_or_agent_contact_id');
            }
            if(Schema::hasColumn('air_freights', 'project_manager_id')) {
                $table->dropForeign('237087_5c083a4da87cc');
                $table->dropIndex('237087_5c083a4da87cc');
                $table->dropColumn('project_manager_id');
            }
            if(Schema::hasColumn('air_freights', 'route_id')) {
                $table->dropForeign('237087_5c083a4db97fc');
                $table->dropIndex('237087_5c083a4db97fc');
                $table->dropColumn('route_id');
            }
            
        });
    }
}
