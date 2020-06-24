<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad43c3f79RelationshipsToReleasingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('releasings', function(Blueprint $table) {
            if (!Schema::hasColumn('releasings', 'project_number_id')) {
                $table->integer('project_number_id')->unsigned()->nullable();
                $table->foreign('project_number_id', '237095_5c083a43e9c4a')->references('id')->on('time_entries')->onDelete('cascade');
                }
                if (!Schema::hasColumn('releasings', 'warehouse_id')) {
                $table->integer('warehouse_id')->unsigned()->nullable();
                $table->foreign('warehouse_id', '237095_5c083a440b626')->references('id')->on('warehouses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('releasings', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '237095_5c083a44217a1')->references('id')->on('time_projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('releasings', 'contact_person_id')) {
                $table->integer('contact_person_id')->unsigned()->nullable();
                $table->foreign('contact_person_id', '237095_5c083a4436f5f')->references('id')->on('client_contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('releasings', 'released_by_id')) {
                $table->integer('released_by_id')->unsigned()->nullable();
                $table->foreign('released_by_id', '237095_5c083a444b513')->references('id')->on('employees')->onDelete('cascade');
                }
                if (!Schema::hasColumn('releasings', 'project_manager_id')) {
                $table->integer('project_manager_id')->unsigned()->nullable();
                $table->foreign('project_manager_id', '237095_5c083a445d82b')->references('id')->on('employees')->onDelete('cascade');
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
        Schema::table('releasings', function(Blueprint $table) {
            if(Schema::hasColumn('releasings', 'project_number_id')) {
                $table->dropForeign('237095_5c083a43e9c4a');
                $table->dropIndex('237095_5c083a43e9c4a');
                $table->dropColumn('project_number_id');
            }
            if(Schema::hasColumn('releasings', 'warehouse_id')) {
                $table->dropForeign('237095_5c083a440b626');
                $table->dropIndex('237095_5c083a440b626');
                $table->dropColumn('warehouse_id');
            }
            if(Schema::hasColumn('releasings', 'client_id')) {
                $table->dropForeign('237095_5c083a44217a1');
                $table->dropIndex('237095_5c083a44217a1');
                $table->dropColumn('client_id');
            }
            if(Schema::hasColumn('releasings', 'contact_person_id')) {
                $table->dropForeign('237095_5c083a4436f5f');
                $table->dropIndex('237095_5c083a4436f5f');
                $table->dropColumn('contact_person_id');
            }
            if(Schema::hasColumn('releasings', 'released_by_id')) {
                $table->dropForeign('237095_5c083a444b513');
                $table->dropIndex('237095_5c083a444b513');
                $table->dropColumn('released_by_id');
            }
            if(Schema::hasColumn('releasings', 'project_manager_id')) {
                $table->dropForeign('237095_5c083a445d82b');
                $table->dropIndex('237095_5c083a445d82b');
                $table->dropColumn('project_manager_id');
            }
            
        });
    }
}
