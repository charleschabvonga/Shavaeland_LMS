<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544042904ExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('expenses')) {
            Schema::create('expenses', function (Blueprint $table) {
                $table->increments('id');
                $table->date('entry_date')->nullable();
                $table->enum('payment_type', array('Vendor tax invoice pymt', 'Purchase credit note and debit note pymt', 'Refund cashback', 'Refund account credit', 'Salaries', 'Other Payment'))->nullable();
                $table->string('prepared_by')->nullable();
                $table->string('payment_number')->nullable();
                $table->string('expense_category')->nullable();
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
        Schema::dropIfExists('expenses');
    }
}
