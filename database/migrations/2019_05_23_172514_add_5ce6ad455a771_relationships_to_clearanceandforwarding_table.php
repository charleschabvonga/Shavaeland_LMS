<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad455a771RelationshipsToClearanceAndForwardingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clearance_and_forwardings', function(Blueprint $table) {
            if (!Schema::hasColumn('clearance_and_forwardings', 'project_number_id')) {
                $table->integer('project_number_id')->unsigned()->nullable();
                $table->foreign('project_number_id', '237093_5c083a47d74a4')->references('id')->on('time_entries')->onDelete('cascade');
                }
                if (!Schema::hasColumn('clearance_and_forwardings', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '237093_5c083a47e7d06')->references('id')->on('time_projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('clearance_and_forwardings', 'contact_person_id')) {
                $table->integer('contact_person_id')->unsigned()->nullable();
                $table->foreign('contact_person_id', '237093_5c083a4804e7b')->references('id')->on('client_contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('clearance_and_forwardings', 'agent_id')) {
                $table->integer('agent_id')->unsigned()->nullable();
                $table->foreign('agent_id', '237093_5c083a4818175')->references('id')->on('vendors')->onDelete('cascade');
                }
                if (!Schema::hasColumn('clearance_and_forwardings', 'agent_contact_id')) {
                $table->integer('agent_contact_id')->unsigned()->nullable();
                $table->foreign('agent_contact_id', '237093_5c083a482c5e8')->references('id')->on('vendor_contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('clearance_and_forwardings', 'project_manager_id')) {
                $table->integer('project_manager_id')->unsigned()->nullable();
                $table->foreign('project_manager_id', '237093_5c083a483e1de')->references('id')->on('employees')->onDelete('cascade');
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
        Schema::table('clearance_and_forwardings', function(Blueprint $table) {
            if(Schema::hasColumn('clearance_and_forwardings', 'project_number_id')) {
                $table->dropForeign('237093_5c083a47d74a4');
                $table->dropIndex('237093_5c083a47d74a4');
                $table->dropColumn('project_number_id');
            }
            if(Schema::hasColumn('clearance_and_forwardings', 'client_id')) {
                $table->dropForeign('237093_5c083a47e7d06');
                $table->dropIndex('237093_5c083a47e7d06');
                $table->dropColumn('client_id');
            }
            if(Schema::hasColumn('clearance_and_forwardings', 'contact_person_id')) {
                $table->dropForeign('237093_5c083a4804e7b');
                $table->dropIndex('237093_5c083a4804e7b');
                $table->dropColumn('contact_person_id');
            }
            if(Schema::hasColumn('clearance_and_forwardings', 'agent_id')) {
                $table->dropForeign('237093_5c083a4818175');
                $table->dropIndex('237093_5c083a4818175');
                $table->dropColumn('agent_id');
            }
            if(Schema::hasColumn('clearance_and_forwardings', 'agent_contact_id')) {
                $table->dropForeign('237093_5c083a482c5e8');
                $table->dropIndex('237093_5c083a482c5e8');
                $table->dropColumn('agent_contact_id');
            }
            if(Schema::hasColumn('clearance_and_forwardings', 'project_manager_id')) {
                $table->dropForeign('237093_5c083a483e1de');
                $table->dropIndex('237093_5c083a483e1de');
                $table->dropColumn('project_manager_id');
            }
            
        });
    }
}
