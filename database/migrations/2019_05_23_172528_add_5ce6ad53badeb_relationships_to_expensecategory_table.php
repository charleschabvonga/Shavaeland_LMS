<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad53badebRelationshipsToExpenseCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expense_categories', function(Blueprint $table) {
            if (!Schema::hasColumn('expense_categories', 'transaction_type_id')) {
                $table->integer('transaction_type_id')->unsigned()->nullable();
                $table->foreign('transaction_type_id', '237031_5c0a241d7fdc9')->references('id')->on('time_work_types')->onDelete('cascade');
                }
                if (!Schema::hasColumn('expense_categories', 'transaction_number_id')) {
                $table->integer('transaction_number_id')->unsigned()->nullable();
                $table->foreign('transaction_number_id', '237031_5c0a241d98ee4')->references('id')->on('time_entries')->onDelete('cascade');
                }
                if (!Schema::hasColumn('expense_categories', 'vendor_id')) {
                $table->integer('vendor_id')->unsigned()->nullable();
                $table->foreign('vendor_id', '237031_5c0a241d436d1')->references('id')->on('vendors')->onDelete('cascade');
                }
                if (!Schema::hasColumn('expense_categories', 'contact_person_id')) {
                $table->integer('contact_person_id')->unsigned()->nullable();
                $table->foreign('contact_person_id', '237031_5c0a241d57df0')->references('id')->on('vendor_contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('expense_categories', 'account_manager_id')) {
                $table->integer('account_manager_id')->unsigned()->nullable();
                $table->foreign('account_manager_id', '237031_5c0a241d6c2f1')->references('id')->on('employees')->onDelete('cascade');
                }
                if (!Schema::hasColumn('expense_categories', 'purchase_order_number_id')) {
                $table->integer('purchase_order_number_id')->unsigned()->nullable();
                $table->foreign('purchase_order_number_id', '237031_5c9a55934224a')->references('id')->on('purchase_orders')->onDelete('cascade');
                }
                if (!Schema::hasColumn('expense_categories', 'currency_id')) {
                $table->integer('currency_id')->unsigned()->nullable();
                $table->foreign('currency_id', '237031_5cdeec5577e72')->references('id')->on('currencies')->onDelete('cascade');
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
        Schema::table('expense_categories', function(Blueprint $table) {
            if(Schema::hasColumn('expense_categories', 'transaction_type_id')) {
                $table->dropForeign('237031_5c0a241d7fdc9');
                $table->dropIndex('237031_5c0a241d7fdc9');
                $table->dropColumn('transaction_type_id');
            }
            if(Schema::hasColumn('expense_categories', 'transaction_number_id')) {
                $table->dropForeign('237031_5c0a241d98ee4');
                $table->dropIndex('237031_5c0a241d98ee4');
                $table->dropColumn('transaction_number_id');
            }
            if(Schema::hasColumn('expense_categories', 'vendor_id')) {
                $table->dropForeign('237031_5c0a241d436d1');
                $table->dropIndex('237031_5c0a241d436d1');
                $table->dropColumn('vendor_id');
            }
            if(Schema::hasColumn('expense_categories', 'contact_person_id')) {
                $table->dropForeign('237031_5c0a241d57df0');
                $table->dropIndex('237031_5c0a241d57df0');
                $table->dropColumn('contact_person_id');
            }
            if(Schema::hasColumn('expense_categories', 'account_manager_id')) {
                $table->dropForeign('237031_5c0a241d6c2f1');
                $table->dropIndex('237031_5c0a241d6c2f1');
                $table->dropColumn('account_manager_id');
            }
            if(Schema::hasColumn('expense_categories', 'purchase_order_number_id')) {
                $table->dropForeign('237031_5c9a55934224a');
                $table->dropIndex('237031_5c9a55934224a');
                $table->dropColumn('purchase_order_number_id');
            }
            if(Schema::hasColumn('expense_categories', 'currency_id')) {
                $table->dropForeign('237031_5cdeec5577e72');
                $table->dropIndex('237031_5cdeec5577e72');
                $table->dropColumn('currency_id');
            }
            
        });
    }
}
