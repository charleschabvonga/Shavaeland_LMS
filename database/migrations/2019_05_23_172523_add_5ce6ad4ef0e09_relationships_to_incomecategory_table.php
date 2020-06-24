<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad4ef0e09RelationshipsToIncomeCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('income_categories', function(Blueprint $table) {
            if (!Schema::hasColumn('income_categories', 'project_type_id')) {
                $table->integer('project_type_id')->unsigned()->nullable();
                $table->foreign('project_type_id', '237032_5c0a0f6b82352')->references('id')->on('time_work_types')->onDelete('cascade');
                }
                if (!Schema::hasColumn('income_categories', 'project_number_id')) {
                $table->integer('project_number_id')->unsigned()->nullable();
                $table->foreign('project_number_id', '237032_5c0a0f6b9b952')->references('id')->on('time_entries')->onDelete('cascade');
                }
                if (!Schema::hasColumn('income_categories', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '237032_5c0a0f6b2e54d')->references('id')->on('time_projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('income_categories', 'contact_person_id')) {
                $table->integer('contact_person_id')->unsigned()->nullable();
                $table->foreign('contact_person_id', '237032_5c0a0f6b48bf8')->references('id')->on('client_contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('income_categories', 'account_manager_id')) {
                $table->integer('account_manager_id')->unsigned()->nullable();
                $table->foreign('account_manager_id', '237032_5c0a0f6b67ae2')->references('id')->on('employees')->onDelete('cascade');
                }
                if (!Schema::hasColumn('income_categories', 'quotation_number_id')) {
                $table->integer('quotation_number_id')->unsigned()->nullable();
                $table->foreign('quotation_number_id', '237032_5c0a0f6bb173e')->references('id')->on('quotations')->onDelete('cascade');
                }
                if (!Schema::hasColumn('income_categories', 'currency_id')) {
                $table->integer('currency_id')->unsigned()->nullable();
                $table->foreign('currency_id', '237032_5cdee6f793efc')->references('id')->on('currencies')->onDelete('cascade');
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
        Schema::table('income_categories', function(Blueprint $table) {
            if(Schema::hasColumn('income_categories', 'project_type_id')) {
                $table->dropForeign('237032_5c0a0f6b82352');
                $table->dropIndex('237032_5c0a0f6b82352');
                $table->dropColumn('project_type_id');
            }
            if(Schema::hasColumn('income_categories', 'project_number_id')) {
                $table->dropForeign('237032_5c0a0f6b9b952');
                $table->dropIndex('237032_5c0a0f6b9b952');
                $table->dropColumn('project_number_id');
            }
            if(Schema::hasColumn('income_categories', 'client_id')) {
                $table->dropForeign('237032_5c0a0f6b2e54d');
                $table->dropIndex('237032_5c0a0f6b2e54d');
                $table->dropColumn('client_id');
            }
            if(Schema::hasColumn('income_categories', 'contact_person_id')) {
                $table->dropForeign('237032_5c0a0f6b48bf8');
                $table->dropIndex('237032_5c0a0f6b48bf8');
                $table->dropColumn('contact_person_id');
            }
            if(Schema::hasColumn('income_categories', 'account_manager_id')) {
                $table->dropForeign('237032_5c0a0f6b67ae2');
                $table->dropIndex('237032_5c0a0f6b67ae2');
                $table->dropColumn('account_manager_id');
            }
            if(Schema::hasColumn('income_categories', 'quotation_number_id')) {
                $table->dropForeign('237032_5c0a0f6bb173e');
                $table->dropIndex('237032_5c0a0f6bb173e');
                $table->dropColumn('quotation_number_id');
            }
            if(Schema::hasColumn('income_categories', 'currency_id')) {
                $table->dropForeign('237032_5cdee6f793efc');
                $table->dropIndex('237032_5cdee6f793efc');
                $table->dropColumn('currency_id');
            }
            
        });
    }
}
