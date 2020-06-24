<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544042895ExpenseCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('expense_categories')) {
            Schema::create('expense_categories', function (Blueprint $table) {
                $table->increments('id');
                $table->date('entry_date')->nullable();
                $table->date('due_date')->nullable();
                $table->string('prepared_by')->nullable();
                $table->string('credit_note_number')->nullable();
                $table->string('vendor_purchase_order_number')->nullable();
                $table->string('upload_document')->nullable();
                $table->enum('status', array('Draft', 'Sent', 'Payment due', 'Partially paid', 'Paid', 'Up to date'))->nullable();
                $table->text('terms_and_conditions')->nullable();
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
        Schema::dropIfExists('expense_categories');
    }
}
