<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad3e0fc33RelationshipsToJobRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_requests', function(Blueprint $table) {
            if (!Schema::hasColumn('job_requests', 'project_number_id')) {
                $table->integer('project_number_id')->unsigned()->nullable();
                $table->foreign('project_number_id', '289009_5cab8fbeb1043')->references('id')->on('time_entries')->onDelete('cascade');
                }
                if (!Schema::hasColumn('job_requests', 'workshop_manager_id')) {
                $table->integer('workshop_manager_id')->unsigned()->nullable();
                $table->foreign('workshop_manager_id', '289009_5cab8fbed9700')->references('id')->on('employees')->onDelete('cascade');
                }
                if (!Schema::hasColumn('job_requests', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '289009_5cab8fbf0afd6')->references('id')->on('time_projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('job_requests', 'contact_person_id')) {
                $table->integer('contact_person_id')->unsigned()->nullable();
                $table->foreign('contact_person_id', '289009_5cab8fbf44bd7')->references('id')->on('client_contacts')->onDelete('cascade');
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
        Schema::table('job_requests', function(Blueprint $table) {
            if(Schema::hasColumn('job_requests', 'project_number_id')) {
                $table->dropForeign('289009_5cab8fbeb1043');
                $table->dropIndex('289009_5cab8fbeb1043');
                $table->dropColumn('project_number_id');
            }
            if(Schema::hasColumn('job_requests', 'workshop_manager_id')) {
                $table->dropForeign('289009_5cab8fbed9700');
                $table->dropIndex('289009_5cab8fbed9700');
                $table->dropColumn('workshop_manager_id');
            }
            if(Schema::hasColumn('job_requests', 'client_id')) {
                $table->dropForeign('289009_5cab8fbf0afd6');
                $table->dropIndex('289009_5cab8fbf0afd6');
                $table->dropColumn('client_id');
            }
            if(Schema::hasColumn('job_requests', 'contact_person_id')) {
                $table->dropForeign('289009_5cab8fbf44bd7');
                $table->dropIndex('289009_5cab8fbf44bd7');
                $table->dropColumn('contact_person_id');
            }
            
        });
    }
}
