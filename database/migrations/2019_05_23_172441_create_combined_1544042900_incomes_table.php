<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544042900IncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('incomes')) {
            Schema::create('incomes', function (Blueprint $table) {
                $table->increments('id');
                $table->date('entry_date')->nullable();
                $table->enum('payment_type', array('Invoice pymt', 'Invoice and credit note pymt', 'Refund account credit', 'Refund cashback', 'Other Payment'))->nullable();
                $table->string('prepared_by')->nullable();
                $table->string('payment_number')->nullable();
                $table->string('income_category')->nullable();
                $table->decimal('amount', 15, 2)->nullable();
                
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
        Schema::dropIfExists('incomes');
    }
}
