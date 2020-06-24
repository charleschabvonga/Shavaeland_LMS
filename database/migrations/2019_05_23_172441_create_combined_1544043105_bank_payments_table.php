<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043105BankPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('bank_payments')) {
            Schema::create('bank_payments', function (Blueprint $table) {
                $table->increments('id');
                $table->date('entry_date')->nullable();
                $table->enum('depositor', array('Client', 'Vendor advance pymt refund', 'Vendor purchase refund'))->nullable();
                $table->enum('payment_mode', array('Bank Transfer', 'Cash', 'Cheque'))->nullable();
                $table->string('prepared_by')->nullable();
                $table->string('payment_number')->nullable();
                $table->decimal('amount', 15, 2)->nullable();
                $table->decimal('balance', 15, 2)->nullable();
                $table->string('upload_document')->nullable();
                
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
        Schema::dropIfExists('bank_payments');
    }
}
