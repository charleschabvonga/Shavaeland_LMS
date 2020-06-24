<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad4221367RelationshipsToReceivingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receivings', function(Blueprint $table) {
            if (!Schema::hasColumn('receivings', 'project_number_id')) {
                $table->integer('project_number_id')->unsigned()->nullable();
                $table->foreign('project_number_id', '237096_5c083a3f90f0b')->references('id')->on('time_entries')->onDelete('cascade');
                }
                if (!Schema::hasColumn('receivings', 'warehouse_id')) {
                $table->integer('warehouse_id')->unsigned()->nullable();
                $table->foreign('warehouse_id', '237096_5c083a3fa69a0')->references('id')->on('warehouses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('receivings', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '237096_5c083a3fd6cca')->references('id')->on('time_projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('receivings', 'contact_person_id')) {
                $table->integer('contact_person_id')->unsigned()->nullable();
                $table->foreign('contact_person_id', '237096_5c083a400bd33')->references('id')->on('client_contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('receivings', 'received_by_id')) {
                $table->integer('received_by_id')->unsigned()->nullable();
                $table->foreign('received_by_id', '237096_5c083a402ecdf')->references('id')->on('employees')->onDelete('cascade');
                }
                if (!Schema::hasColumn('receivings', 'project_manager_id')) {
                $table->integer('project_manager_id')->unsigned()->nullable();
                $table->foreign('project_manager_id', '237096_5c083a4056c9f')->references('id')->on('employees')->onDelete('cascade');
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
        Schema::table('receivings', function(Blueprint $table) {
            if(Schema::hasColumn('receivings', 'project_number_id')) {
                $table->dropForeign('237096_5c083a3f90f0b');
                $table->dropIndex('237096_5c083a3f90f0b');
                $table->dropColumn('project_number_id');
            }
            if(Schema::hasColumn('receivings', 'warehouse_id')) {
                $table->dropForeign('237096_5c083a3fa69a0');
                $table->dropIndex('237096_5c083a3fa69a0');
                $table->dropColumn('warehouse_id');
            }
            if(Schema::hasColumn('receivings', 'client_id')) {
                $table->dropForeign('237096_5c083a3fd6cca');
                $table->dropIndex('237096_5c083a3fd6cca');
                $table->dropColumn('client_id');
            }
            if(Schema::hasColumn('receivings', 'contact_person_id')) {
                $table->dropForeign('237096_5c083a400bd33');
                $table->dropIndex('237096_5c083a400bd33');
                $table->dropColumn('contact_person_id');
            }
            if(Schema::hasColumn('receivings', 'received_by_id')) {
                $table->dropForeign('237096_5c083a402ecdf');
                $table->dropIndex('237096_5c083a402ecdf');
                $table->dropColumn('received_by_id');
            }
            if(Schema::hasColumn('receivings', 'project_manager_id')) {
                $table->dropForeign('237096_5c083a4056c9f');
                $table->dropIndex('237096_5c083a4056c9f');
                $table->dropColumn('project_manager_id');
            }
            
        });
    }
}
