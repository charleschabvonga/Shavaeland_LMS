<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad50e2926RelationshipsToCreditNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('credit_notes', function(Blueprint $table) {
            if (!Schema::hasColumn('credit_notes', 'invoice_payment_number_id')) {
                $table->integer('invoice_payment_number_id')->unsigned()->nullable();
                $table->foreign('invoice_payment_number_id', '237070_5c083a68ac366')->references('id')->on('incomes')->onDelete('cascade');
                }
                if (!Schema::hasColumn('credit_notes', 'project_number_id')) {
                $table->integer('project_number_id')->unsigned()->nullable();
                $table->foreign('project_number_id', '237070_5c083a6844210')->references('id')->on('time_entries')->onDelete('cascade');
                }
                if (!Schema::hasColumn('credit_notes', 'invoice_number_id')) {
                $table->integer('invoice_number_id')->unsigned()->nullable();
                $table->foreign('invoice_number_id', '237070_5c083a6868fe1')->references('id')->on('income_categories')->onDelete('cascade');
                }
                if (!Schema::hasColumn('credit_notes', 'bank_reference_id')) {
                $table->integer('bank_reference_id')->unsigned()->nullable();
                $table->foreign('bank_reference_id', '237070_5c083a688b910')->references('id')->on('bank_payments')->onDelete('cascade');
                }
                if (!Schema::hasColumn('credit_notes', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '237070_5c083a67cfebc')->references('id')->on('time_projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('credit_notes', 'contact_person_id')) {
                $table->integer('contact_person_id')->unsigned()->nullable();
                $table->foreign('contact_person_id', '237070_5c083a67ef008')->references('id')->on('client_contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('credit_notes', 'account_manager_id')) {
                $table->integer('account_manager_id')->unsigned()->nullable();
                $table->foreign('account_manager_id', '237070_5c083a681bdc9')->references('id')->on('employees')->onDelete('cascade');
                }
                if (!Schema::hasColumn('credit_notes', 'currency_id')) {
                $table->integer('currency_id')->unsigned()->nullable();
                $table->foreign('currency_id', '237070_5cdeea3a99c67')->references('id')->on('currencies')->onDelete('cascade');
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
        Schema::table('credit_notes', function(Blueprint $table) {
            if(Schema::hasColumn('credit_notes', 'invoice_payment_number_id')) {
                $table->dropForeign('237070_5c083a68ac366');
                $table->dropIndex('237070_5c083a68ac366');
                $table->dropColumn('invoice_payment_number_id');
            }
            if(Schema::hasColumn('credit_notes', 'project_number_id')) {
                $table->dropForeign('237070_5c083a6844210');
                $table->dropIndex('237070_5c083a6844210');
                $table->dropColumn('project_number_id');
            }
            if(Schema::hasColumn('credit_notes', 'invoice_number_id')) {
                $table->dropForeign('237070_5c083a6868fe1');
                $table->dropIndex('237070_5c083a6868fe1');
                $table->dropColumn('invoice_number_id');
            }
            if(Schema::hasColumn('credit_notes', 'bank_reference_id')) {
                $table->dropForeign('237070_5c083a688b910');
                $table->dropIndex('237070_5c083a688b910');
                $table->dropColumn('bank_reference_id');
            }
            if(Schema::hasColumn('credit_notes', 'client_id')) {
                $table->dropForeign('237070_5c083a67cfebc');
                $table->dropIndex('237070_5c083a67cfebc');
                $table->dropColumn('client_id');
            }
            if(Schema::hasColumn('credit_notes', 'contact_person_id')) {
                $table->dropForeign('237070_5c083a67ef008');
                $table->dropIndex('237070_5c083a67ef008');
                $table->dropColumn('contact_person_id');
            }
            if(Schema::hasColumn('credit_notes', 'account_manager_id')) {
                $table->dropForeign('237070_5c083a681bdc9');
                $table->dropIndex('237070_5c083a681bdc9');
                $table->dropColumn('account_manager_id');
            }
            if(Schema::hasColumn('credit_notes', 'currency_id')) {
                $table->dropForeign('237070_5cdeea3a99c67');
                $table->dropIndex('237070_5cdeea3a99c67');
                $table->dropColumn('currency_id');
            }
            
        });
    }
}
