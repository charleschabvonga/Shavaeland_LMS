<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544042980VendorBankPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('vendor_bank_payments')) {
            Schema::create('vendor_bank_payments', function (Blueprint $table) {
                $table->increments('id');
                $table->date('entry_date')->nullable();
                $table->enum('withdrawer', array('Vendor', 'Client advance pymt refund', 'Client sale refund', 'Department'))->nullable();
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
        Schema::dropIfExists('vendor_bank_payments');
    }
}
