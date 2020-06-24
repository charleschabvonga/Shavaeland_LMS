<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad2bbe54fRelationshipsToPayeePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payee_payments', function(Blueprint $table) {
            if (!Schema::hasColumn('payee_payments', 'employee_id')) {
                $table->integer('employee_id')->unsigned()->nullable();
                $table->foreign('employee_id', '237080_5c0839e98fc5d')->references('id')->on('employees')->onDelete('cascade');
                }
                if (!Schema::hasColumn('payee_payments', 'payslip_number_id')) {
                $table->integer('payslip_number_id')->unsigned()->nullable();
                $table->foreign('payslip_number_id', '237080_5c0839e9b5287')->references('id')->on('payslips')->onDelete('cascade');
                }
                if (!Schema::hasColumn('payee_payments', 'batch_number_id')) {
                $table->integer('batch_number_id')->unsigned()->nullable();
                $table->foreign('batch_number_id', '237080_5c5b2dfab553a')->references('id')->on('salaries_request_totals')->onDelete('cascade');
                }
                if (!Schema::hasColumn('payee_payments', 'withdrawal_transaction_number_id')) {
                $table->integer('withdrawal_transaction_number_id')->unsigned()->nullable();
                $table->foreign('withdrawal_transaction_number_id', '237080_5c0bbac1181c7')->references('id')->on('vendor_bank_payments')->onDelete('cascade');
                }
                if (!Schema::hasColumn('payee_payments', 'payee_account_number_id')) {
                $table->integer('payee_account_number_id')->unsigned()->nullable();
                $table->foreign('payee_account_number_id', '237080_5c0bbac13a051')->references('id')->on('payee_accounts')->onDelete('cascade');
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
        Schema::table('payee_payments', function(Blueprint $table) {
            if(Schema::hasColumn('payee_payments', 'employee_id')) {
                $table->dropForeign('237080_5c0839e98fc5d');
                $table->dropIndex('237080_5c0839e98fc5d');
                $table->dropColumn('employee_id');
            }
            if(Schema::hasColumn('payee_payments', 'payslip_number_id')) {
                $table->dropForeign('237080_5c0839e9b5287');
                $table->dropIndex('237080_5c0839e9b5287');
                $table->dropColumn('payslip_number_id');
            }
            if(Schema::hasColumn('payee_payments', 'batch_number_id')) {
                $table->dropForeign('237080_5c5b2dfab553a');
                $table->dropIndex('237080_5c5b2dfab553a');
                $table->dropColumn('batch_number_id');
            }
            if(Schema::hasColumn('payee_payments', 'withdrawal_transaction_number_id')) {
                $table->dropForeign('237080_5c0bbac1181c7');
                $table->dropIndex('237080_5c0bbac1181c7');
                $table->dropColumn('withdrawal_transaction_number_id');
            }
            if(Schema::hasColumn('payee_payments', 'payee_account_number_id')) {
                $table->dropForeign('237080_5c0bbac13a051');
                $table->dropIndex('237080_5c0bbac13a051');
                $table->dropColumn('payee_account_number_id');
            }
            
        });
    }
}
