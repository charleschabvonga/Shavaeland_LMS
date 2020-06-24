<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544042968PayslipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('payslips')) {
            Schema::create('payslips', function (Blueprint $table) {
                $table->increments('id');
                $table->date('date')->nullable();
                $table->date('starting_date')->nullable();
                $table->date('ending_date')->nullable();
                $table->string('payslip_number')->nullable();
                $table->enum('status', array('Draft', 'Payment due', 'Partially paid', 'Paid'))->nullable();
                $table->decimal('overtime_and_bonus_total', 15, 2)->nullable();
                $table->decimal('deductions_total', 15, 2)->nullable();
                $table->decimal('gross', 15, 2)->nullable();
                $table->double('income_tax', 15, 2)->nullable();
                $table->decimal('income_tax_amount', 15, 2)->nullable();
                $table->decimal('net_income', 15, 2)->nullable();
                $table->decimal('paid_to_date', 15, 2)->nullable();
                $table->decimal('balance', 15, 2)->nullable();
                $table->string('prepared_by')->nullable();
                
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
        Schema::dropIfExists('payslips');
    }
}
