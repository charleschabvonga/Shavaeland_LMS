<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544042984PayeePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('payee_payments')) {
            Schema::create('payee_payments', function (Blueprint $table) {
                $table->increments('id');
                $table->date('entry_date')->nullable();
                $table->string('payee_payment_number')->nullable();
                $table->enum('payment_mode', array('Bank Transfer', 'Cash', 'Cheque'))->nullable();
                $table->decimal('amount', 15, 2)->nullable();
                $table->string('prepared_by')->nullable();
                
                $table->timestamps();
                
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
        Schema::dropIfExists('payee_payments');
    }
}
