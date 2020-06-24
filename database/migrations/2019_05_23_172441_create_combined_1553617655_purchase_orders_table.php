<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1553617655PurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('purchase_orders')) {
            Schema::create('purchase_orders', function (Blueprint $table) {
                $table->increments('id');
                $table->string('purchase_order_number')->nullable();
                $table->date('date')->nullable();
                $table->date('request_date')->nullable();
                $table->date('procurement_date')->nullable();
                $table->decimal('subtotal', 15, 2)->nullable();
                $table->enum('status', array('Requested', 'Confirmed', 'Approved', 'Purchased'))->nullable();
                $table->double('vat', 15, 2)->nullable();
                $table->decimal('vat_amount', 15, 2)->nullable();
                $table->decimal('total_amount', 15, 2)->nullable();
                $table->string('prepared_by')->nullable();
                $table->string('quotation_number')->nullable();
                $table->string('requested_by')->nullable();
                $table->tinyInteger('hod')->nullable()->default('0');
                $table->tinyInteger('gm')->nullable()->default('0');
                $table->tinyInteger('accounts')->nullable()->default('0');
                
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
        Schema::dropIfExists('purchase_orders');
    }
}
