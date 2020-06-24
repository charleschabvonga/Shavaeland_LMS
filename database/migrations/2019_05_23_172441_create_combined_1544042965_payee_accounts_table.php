<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544042965PayeeAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('payee_accounts')) {
            Schema::create('payee_accounts', function (Blueprint $table) {
                $table->increments('id');
                $table->string('bank')->nullable();
                $table->string('account_number')->nullable();
                $table->string('branch_code')->nullable();
                $table->string('branch')->nullable();
                $table->enum('status', array('Not active', 'Payment due', 'Up to date', 'Paid off', 'Debited', 'Closed'))->nullable();
                $table->enum('pymt_measurement_type', array('Monthy', 'BiWeekly', 'Weekly', 'Daily', 'Hrs', 'kms'))->nullable();
                $table->decimal('wage_rate', 15, 2)->nullable();
                $table->decimal('pension_rate', 15, 2)->nullable();
                $table->decimal('overtime_rate', 15, 2)->nullable();
                $table->decimal('public_holiday_rate', 15, 2)->nullable();
                $table->decimal('medical_aid', 15, 2)->nullable();
                $table->double('sales_rate', 15, 2)->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payee_accounts');
    }
}
