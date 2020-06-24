<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad5a7006bRelationshipsToBankPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank_payments', function(Blueprint $table) {
            if (!Schema::hasColumn('bank_payments', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '237088_5c083a62e1743')->references('id')->on('time_projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('bank_payments', 'account_number_id')) {
                $table->integer('account_number_id')->unsigned()->nullable();
                $table->foreign('account_number_id', '237088_5c083a63008ed')->references('id')->on('client_accounts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('bank_payments', 'vendor_id')) {
                $table->integer('vendor_id')->unsigned()->nullable();
                $table->foreign('vendor_id', '237088_5c1ded2833dd3')->references('id')->on('vendors')->onDelete('cascade');
                }
                if (!Schema::hasColumn('bank_payments', 'vendor_account_number_id')) {
                $table->integer('vendor_account_number_id')->unsigned()->nullable();
                $table->foreign('vendor_account_number_id', '237088_5c1ded284661f')->references('id')->on('vendor_accounts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('bank_payments', 'debit_note_number_id')) {
                $table->integer('debit_note_number_id')->unsigned()->nullable();
                $table->foreign('debit_note_number_id', '237088_5c927ec19aa12')->references('id')->on('debit_notes')->onDelete('cascade');
                }
                if (!Schema::hasColumn('bank_payments', 'currency_id')) {
                $table->integer('currency_id')->unsigned()->nullable();
                $table->foreign('currency_id', '237088_5cdef0cbecae9')->references('id')->on('currencies')->onDelete('cascade');
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
        Schema::table('bank_payments', function(Blueprint $table) {
            if(Schema::hasColumn('bank_payments', 'client_id')) {
                $table->dropForeign('237088_5c083a62e1743');
                $table->dropIndex('237088_5c083a62e1743');
                $table->dropColumn('client_id');
            }
            if(Schema::hasColumn('bank_payments', 'account_number_id')) {
                $table->dropForeign('237088_5c083a63008ed');
                $table->dropIndex('237088_5c083a63008ed');
                $table->dropColumn('account_number_id');
            }
            if(Schema::hasColumn('bank_payments', 'vendor_id')) {
                $table->dropForeign('237088_5c1ded2833dd3');
                $table->dropIndex('237088_5c1ded2833dd3');
                $table->dropColumn('vendor_id');
            }
            if(Schema::hasColumn('bank_payments', 'vendor_account_number_id')) {
                $table->dropForeign('237088_5c1ded284661f');
                $table->dropIndex('237088_5c1ded284661f');
                $table->dropColumn('vendor_account_number_id');
            }
            if(Schema::hasColumn('bank_payments', 'debit_note_number_id')) {
                $table->dropForeign('237088_5c927ec19aa12');
                $table->dropIndex('237088_5c927ec19aa12');
                $table->dropColumn('debit_note_number_id');
            }
            if(Schema::hasColumn('bank_payments', 'currency_id')) {
                $table->dropForeign('237088_5cdef0cbecae9');
                $table->dropIndex('237088_5cdef0cbecae9');
                $table->dropColumn('currency_id');
            }
            
        });
    }
}
