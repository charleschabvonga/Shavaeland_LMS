<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043098QuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('quotations')) {
            Schema::create('quotations', function (Blueprint $table) {
                $table->increments('id');
                $table->string('quotation_number')->nullable();
                $table->date('date')->nullable();
                $table->date('due_date')->nullable();
                $table->enum('status', array('Draft', 'Sent', 'Confirmed', 'Unconfirmed', 'Invoiced', 'Expired'))->nullable();
                $table->decimal('subtotal', 15, 2)->nullable();
                $table->double('vat', 15, 2)->nullable();
                $table->decimal('vat_amount', 15, 2)->nullable();
                $table->decimal('total_amount', 15, 2)->nullable();
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
        Schema::dropIfExists('quotations');
    }
}
