<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544042897IncomeCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('income_categories')) {
            Schema::create('income_categories', function (Blueprint $table) {
                $table->increments('id');
                $table->date('entry_date')->nullable();
                $table->date('due_date')->nullable();
                $table->string('prepared_by')->nullable();
                $table->string('invoice_number')->nullable();
                $table->string('sales_order_number')->nullable();
                $table->enum('status', array('Draft', 'Sent', 'Payment due', 'Partially paid', 'Paid', 'Up to date'))->nullable();
                $table->decimal('subtotal', 15, 2)->nullable();
                $table->double('percent_discount', 15, 2)->nullable();
                $table->decimal('discount_amount', 15, 2)->nullable();
                $table->decimal('discounted_subtotal', 15, 2)->nullable();
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
        Schema::dropIfExists('income_categories');
    }
}
