<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad55a9db4RelationshipsToDebitNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('debit_notes', function(Blueprint $table) {
            if (!Schema::hasColumn('debit_notes', 'credit_note_payment_number_id')) {
                $table->integer('credit_note_payment_number_id')->unsigned()->nullable();
                $table->foreign('credit_note_payment_number_id', '237047_5c083a6f27b45')->references('id')->on('expenses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('debit_notes', 'transaction_number_id')) {
                $table->integer('transaction_number_id')->unsigned()->nullable();
                $table->foreign('transaction_number_id', '237047_5c083a6eae0fc')->references('id')->on('time_entries')->onDelete('cascade');
                }
                if (!Schema::hasColumn('debit_notes', 'credit_note_number_id')) {
                $table->integer('credit_note_number_id')->unsigned()->nullable();
                $table->foreign('credit_note_number_id', '237047_5c083a6ed7430')->references('id')->on('expense_categories')->onDelete('cascade');
                }
                if (!Schema::hasColumn('debit_notes', 'withdrawal_transaction_number_id')) {
                $table->integer('withdrawal_transaction_number_id')->unsigned()->nullable();
                $table->foreign('withdrawal_transaction_number_id', '237047_5c083a6f08ff9')->references('id')->on('vendor_bank_payments')->onDelete('cascade');
                }
                if (!Schema::hasColumn('debit_notes', 'vendor_id')) {
                $table->integer('vendor_id')->unsigned()->nullable();
                $table->foreign('vendor_id', '237047_5c083a6e43747')->references('id')->on('vendors')->onDelete('cascade');
                }
                if (!Schema::hasColumn('debit_notes', 'contact_person_id')) {
                $table->integer('contact_person_id')->unsigned()->nullable();
                $table->foreign('contact_person_id', '237047_5c083a6e6910b')->references('id')->on('vendor_contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('debit_notes', 'account_manager_id')) {
                $table->integer('account_manager_id')->unsigned()->nullable();
                $table->foreign('account_manager_id', '237047_5c083a6e8db71')->references('id')->on('employees')->onDelete('cascade');
                }
                if (!Schema::hasColumn('debit_notes', 'currency_id')) {
                $table->integer('currency_id')->unsigned()->nullable();
                $table->foreign('currency_id', '237047_5cdeee85394f9')->references('id')->on('currencies')->onDelete('cascade');
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
        Schema::table('debit_notes', function(Blueprint $table) {
            if(Schema::hasColumn('debit_notes', 'credit_note_payment_number_id')) {
                $table->dropForeign('237047_5c083a6f27b45');
                $table->dropIndex('237047_5c083a6f27b45');
                $table->dropColumn('credit_note_payment_number_id');
            }
            if(Schema::hasColumn('debit_notes', 'transaction_number_id')) {
                $table->dropForeign('237047_5c083a6eae0fc');
                $table->dropIndex('237047_5c083a6eae0fc');
                $table->dropColumn('transaction_number_id');
            }
            if(Schema::hasColumn('debit_notes', 'credit_note_number_id')) {
                $table->dropForeign('237047_5c083a6ed7430');
                $table->dropIndex('237047_5c083a6ed7430');
                $table->dropColumn('credit_note_number_id');
            }
            if(Schema::hasColumn('debit_notes', 'withdrawal_transaction_number_id')) {
                $table->dropForeign('237047_5c083a6f08ff9');
                $table->dropIndex('237047_5c083a6f08ff9');
                $table->dropColumn('withdrawal_transaction_number_id');
            }
            if(Schema::hasColumn('debit_notes', 'vendor_id')) {
                $table->dropForeign('237047_5c083a6e43747');
                $table->dropIndex('237047_5c083a6e43747');
                $table->dropColumn('vendor_id');
            }
            if(Schema::hasColumn('debit_notes', 'contact_person_id')) {
                $table->dropForeign('237047_5c083a6e6910b');
                $table->dropIndex('237047_5c083a6e6910b');
                $table->dropColumn('contact_person_id');
            }
            if(Schema::hasColumn('debit_notes', 'account_manager_id')) {
                $table->dropForeign('237047_5c083a6e8db71');
                $table->dropIndex('237047_5c083a6e8db71');
                $table->dropColumn('account_manager_id');
            }
            if(Schema::hasColumn('debit_notes', 'currency_id')) {
                $table->dropForeign('237047_5cdeee85394f9');
                $table->dropIndex('237047_5cdeee85394f9');
                $table->dropColumn('currency_id');
            }
            
        });
    }
}
