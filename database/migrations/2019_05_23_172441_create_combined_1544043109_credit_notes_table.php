<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043109CreditNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('credit_notes')) {
            Schema::create('credit_notes', function (Blueprint $table) {
                $table->increments('id');
                $table->date('date')->nullable();
                $table->enum('refund_type', array('Advance pymt refund', 'Sales refund cashback', 'Sales refund account credit'))->nullable();
                $table->string('prepared_by')->nullable();
                $table->string('credit_note_number')->nullable();
                $table->enum('status', array('Draft', 'Sent', 'Payment due', 'Partially paid', 'Paid', 'Account credited', 'Rejected'))->nullable();
                $table->text('terms_and_conditions')->nullable();
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
        Schema::dropIfExists('credit_notes');
    }
}
