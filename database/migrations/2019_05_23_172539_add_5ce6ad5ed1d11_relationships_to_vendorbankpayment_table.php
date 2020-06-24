<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad5ed1d11RelationshipsToVendorBankPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_bank_payments', function(Blueprint $table) {
            if (!Schema::hasColumn('vendor_bank_payments', 'vendor_id')) {
                $table->integer('vendor_id')->unsigned()->nullable();
                $table->foreign('vendor_id', '237048_5c0839e5f1bf6')->references('id')->on('vendors')->onDelete('cascade');
                }
                if (!Schema::hasColumn('vendor_bank_payments', 'account_number_id')) {
                $table->integer('account_number_id')->unsigned()->nullable();
                $table->foreign('account_number_id', '237048_5c0839e60efd4')->references('id')->on('vendor_accounts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('vendor_bank_payments', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '237048_5c1def1de3fef')->references('id')->on('time_projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('vendor_bank_payments', 'client_account_number_id')) {
                $table->integer('client_account_number_id')->unsigned()->nullable();
                $table->foreign('client_account_number_id', '237048_5c1def1e092df')->references('id')->on('client_accounts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('vendor_bank_payments', 'credit_note_number_id')) {
                $table->integer('credit_note_number_id')->unsigned()->nullable();
                $table->foreign('credit_note_number_id', '237048_5c92856de359b')->references('id')->on('credit_notes')->onDelete('cascade');
                }
                if (!Schema::hasColumn('vendor_bank_payments', 'currency_id')) {
                $table->integer('currency_id')->unsigned()->nullable();
                $table->foreign('currency_id', '237048_5cdef8ad982d4')->references('id')->on('currencies')->onDelete('cascade');
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
        Schema::table('vendor_bank_payments', function(Blueprint $table) {
            if(Schema::hasColumn('vendor_bank_payments', 'vendor_id')) {
                $table->dropForeign('237048_5c0839e5f1bf6');
                $table->dropIndex('237048_5c0839e5f1bf6');
                $table->dropColumn('vendor_id');
            }
            if(Schema::hasColumn('vendor_bank_payments', 'account_number_id')) {
                $table->dropForeign('237048_5c0839e60efd4');
                $table->dropIndex('237048_5c0839e60efd4');
                $table->dropColumn('account_number_id');
            }
            if(Schema::hasColumn('vendor_bank_payments', 'client_id')) {
                $table->dropForeign('237048_5c1def1de3fef');
                $table->dropIndex('237048_5c1def1de3fef');
                $table->dropColumn('client_id');
            }
            if(Schema::hasColumn('vendor_bank_payments', 'client_account_number_id')) {
                $table->dropForeign('237048_5c1def1e092df');
                $table->dropIndex('237048_5c1def1e092df');
                $table->dropColumn('client_account_number_id');
            }
            if(Schema::hasColumn('vendor_bank_payments', 'credit_note_number_id')) {
                $table->dropForeign('237048_5c92856de359b');
                $table->dropIndex('237048_5c92856de359b');
                $table->dropColumn('credit_note_number_id');
            }
            if(Schema::hasColumn('vendor_bank_payments', 'currency_id')) {
                $table->dropForeign('237048_5cdef8ad982d4');
                $table->dropIndex('237048_5cdef8ad982d4');
                $table->dropColumn('currency_id');
            }
            
        });
    }
}
