<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad3f951bcRelationshipsToClientJobCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_job_cards', function(Blueprint $table) {
            if (!Schema::hasColumn('client_job_cards', 'job_request_number_id')) {
                $table->integer('job_request_number_id')->unsigned()->nullable();
                $table->foreign('job_request_number_id', '289883_5cadc3afd67ed')->references('id')->on('job_requests')->onDelete('cascade');
                }
                if (!Schema::hasColumn('client_job_cards', 'project_number_id')) {
                $table->integer('project_number_id')->unsigned()->nullable();
                $table->foreign('project_number_id', '289883_5cadc3b011ea0')->references('id')->on('time_entries')->onDelete('cascade');
                }
                if (!Schema::hasColumn('client_job_cards', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '289883_5cadc3b043091')->references('id')->on('time_projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('client_job_cards', 'contact_person_id')) {
                $table->integer('contact_person_id')->unsigned()->nullable();
                $table->foreign('contact_person_id', '289883_5cadc3b072ba7')->references('id')->on('client_contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('client_job_cards', 'repair_center_id')) {
                $table->integer('repair_center_id')->unsigned()->nullable();
                $table->foreign('repair_center_id', '289883_5cadc3b0a2adc')->references('id')->on('workshops')->onDelete('cascade');
                }
                if (!Schema::hasColumn('client_job_cards', 'client_vehicle_reg_no_id')) {
                $table->integer('client_vehicle_reg_no_id')->unsigned()->nullable();
                $table->foreign('client_vehicle_reg_no_id', '289883_5cadc3b0d0966')->references('id')->on('job_requests')->onDelete('cascade');
                }
                if (!Schema::hasColumn('client_job_cards', 'currency_id')) {
                $table->integer('currency_id')->unsigned()->nullable();
                $table->foreign('currency_id', '289883_5cd6a7555c562')->references('id')->on('currencies')->onDelete('cascade');
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
        Schema::table('client_job_cards', function(Blueprint $table) {
            if(Schema::hasColumn('client_job_cards', 'job_request_number_id')) {
                $table->dropForeign('289883_5cadc3afd67ed');
                $table->dropIndex('289883_5cadc3afd67ed');
                $table->dropColumn('job_request_number_id');
            }
            if(Schema::hasColumn('client_job_cards', 'project_number_id')) {
                $table->dropForeign('289883_5cadc3b011ea0');
                $table->dropIndex('289883_5cadc3b011ea0');
                $table->dropColumn('project_number_id');
            }
            if(Schema::hasColumn('client_job_cards', 'client_id')) {
                $table->dropForeign('289883_5cadc3b043091');
                $table->dropIndex('289883_5cadc3b043091');
                $table->dropColumn('client_id');
            }
            if(Schema::hasColumn('client_job_cards', 'contact_person_id')) {
                $table->dropForeign('289883_5cadc3b072ba7');
                $table->dropIndex('289883_5cadc3b072ba7');
                $table->dropColumn('contact_person_id');
            }
            if(Schema::hasColumn('client_job_cards', 'repair_center_id')) {
                $table->dropForeign('289883_5cadc3b0a2adc');
                $table->dropIndex('289883_5cadc3b0a2adc');
                $table->dropColumn('repair_center_id');
            }
            if(Schema::hasColumn('client_job_cards', 'client_vehicle_reg_no_id')) {
                $table->dropForeign('289883_5cadc3b0d0966');
                $table->dropIndex('289883_5cadc3b0d0966');
                $table->dropColumn('client_vehicle_reg_no_id');
            }
            if(Schema::hasColumn('client_job_cards', 'currency_id')) {
                $table->dropForeign('289883_5cd6a7555c562');
                $table->dropIndex('289883_5cd6a7555c562');
                $table->dropColumn('currency_id');
            }
            
        });
    }
}
