<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad2ade88bRelationshipsToPayslipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payslips', function(Blueprint $table) {
            if (!Schema::hasColumn('payslips', 'employee_id')) {
                $table->integer('employee_id')->unsigned()->nullable();
                $table->foreign('employee_id', '237081_5c5c31ef243fa')->references('id')->on('employees')->onDelete('cascade');
                }
                if (!Schema::hasColumn('payslips', 'batch_number_id')) {
                $table->integer('batch_number_id')->unsigned()->nullable();
                $table->foreign('batch_number_id', '237081_5c5b2ba36f83b')->references('id')->on('salaries_request_totals')->onDelete('cascade');
                }
                if (!Schema::hasColumn('payslips', 'account_number_id')) {
                $table->integer('account_number_id')->unsigned()->nullable();
                $table->foreign('account_number_id', '237081_5c5be2e9eaf43')->references('id')->on('payee_accounts')->onDelete('cascade');
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
        Schema::table('payslips', function(Blueprint $table) {
            if(Schema::hasColumn('payslips', 'employee_id')) {
                $table->dropForeign('237081_5c5c31ef243fa');
                $table->dropIndex('237081_5c5c31ef243fa');
                $table->dropColumn('employee_id');
            }
            if(Schema::hasColumn('payslips', 'batch_number_id')) {
                $table->dropForeign('237081_5c5b2ba36f83b');
                $table->dropIndex('237081_5c5b2ba36f83b');
                $table->dropColumn('batch_number_id');
            }
            if(Schema::hasColumn('payslips', 'account_number_id')) {
                $table->dropForeign('237081_5c5be2e9eaf43');
                $table->dropIndex('237081_5c5be2e9eaf43');
                $table->dropColumn('account_number_id');
            }
            
        });
    }
}
