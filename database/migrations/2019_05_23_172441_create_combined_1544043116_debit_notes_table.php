<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043116DebitNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('debit_notes')) {
            Schema::create('debit_notes', function (Blueprint $table) {
                $table->increments('id');
                $table->date('date')->nullable();
                $table->enum('refund_type', array('Advance pymt refund', 'Purchase refund cashback', 'Purchase refund account credit'))->nullable();
                $table->string('prepared_by')->nullable();
                $table->string('debit_note_number')->nullable();
                $table->enum('status', array('Draft', 'Sent', 'Payment due', 'Partially paid', 'Paid', 'Account credited', 'Rejected'))->nullable();
                $table->decimal('subtotal', 15, 2)->nullable();
                $table->double('vat', 15, 2)->nullable();
                $table->decimal('vat_amount', 15, 2)->nullable();
                $table->decimal('total_amount', 15, 2)->nullable();
                $table->decimal('paid_to_date', 15, 2)->nullable();
                $table->decimal('balance', 15, 2)->nullable();
                
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
        Schema::dropIfExists('debit_notes');
    }
}
