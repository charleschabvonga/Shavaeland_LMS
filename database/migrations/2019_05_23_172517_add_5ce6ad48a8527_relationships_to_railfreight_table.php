<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad48a8527RelationshipsToRailFreightTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rail_freights', function(Blueprint $table) {
            if (!Schema::hasColumn('rail_freights', 'project_number_id')) {
                $table->integer('project_number_id')->unsigned()->nullable();
                $table->foreign('project_number_id', '237092_5c083a52d6c8f')->references('id')->on('time_entries')->onDelete('cascade');
                }
                if (!Schema::hasColumn('rail_freights', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '237092_5c083a52e7ae9')->references('id')->on('time_projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('rail_freights', 'contact_person_id')) {
                $table->integer('contact_person_id')->unsigned()->nullable();
                $table->foreign('contact_person_id', '237092_5c083a530527d')->references('id')->on('client_contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('rail_freights', 'railline_or_agent_contact_id')) {
                $table->integer('railline_or_agent_contact_id')->unsigned()->nullable();
                $table->foreign('railline_or_agent_contact_id', '237092_5c083a531a2cd')->references('id')->on('vendor_contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('rail_freights', 'project_manager_id')) {
                $table->integer('project_manager_id')->unsigned()->nullable();
                $table->foreign('project_manager_id', '237092_5c0974c243244')->references('id')->on('employees')->onDelete('cascade');
                }
                if (!Schema::hasColumn('rail_freights', 'route_id')) {
                $table->integer('route_id')->unsigned()->nullable();
                $table->foreign('route_id', '237092_5c083a532c402')->references('id')->on('routes')->onDelete('cascade');
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
        Schema::table('rail_freights', function(Blueprint $table) {
            if(Schema::hasColumn('rail_freights', 'project_number_id')) {
                $table->dropForeign('237092_5c083a52d6c8f');
                $table->dropIndex('237092_5c083a52d6c8f');
                $table->dropColumn('project_number_id');
            }
            if(Schema::hasColumn('rail_freights', 'client_id')) {
                $table->dropForeign('237092_5c083a52e7ae9');
                $table->dropIndex('237092_5c083a52e7ae9');
                $table->dropColumn('client_id');
            }
            if(Schema::hasColumn('rail_freights', 'contact_person_id')) {
                $table->dropForeign('237092_5c083a530527d');
                $table->dropIndex('237092_5c083a530527d');
                $table->dropColumn('contact_person_id');
            }
            if(Schema::hasColumn('rail_freights', 'railline_or_agent_contact_id')) {
                $table->dropForeign('237092_5c083a531a2cd');
                $table->dropIndex('237092_5c083a531a2cd');
                $table->dropColumn('railline_or_agent_contact_id');
            }
            if(Schema::hasColumn('rail_freights', 'project_manager_id')) {
                $table->dropForeign('237092_5c0974c243244');
                $table->dropIndex('237092_5c0974c243244');
                $table->dropColumn('project_manager_id');
            }
            if(Schema::hasColumn('rail_freights', 'route_id')) {
                $table->dropForeign('237092_5c083a532c402');
                $table->dropIndex('237092_5c083a532c402');
                $table->dropColumn('route_id');
            }
            
        });
    }
}
