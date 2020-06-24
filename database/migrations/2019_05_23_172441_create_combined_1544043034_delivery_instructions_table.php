<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043034DeliveryInstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('delivery_instructions')) {
            Schema::create('delivery_instructions', function (Blueprint $table) {
                $table->increments('id');
                $table->enum('freight_contract_type', array('Shavaeland', 'Subcontractor'))->nullable();
                $table->string('delivery_instruction_number')->nullable();
                $table->string('order_number')->nullable();
                $table->string('delivery_company_name')->nullable();
                $table->string('delivery_address_address')->nullable();
                $table->double('delivery_address_latitude')->nullable();
                $table->double('delivery_address_longitude')->nullable();
                $table->datetime('delivery_date_time')->nullable();
                $table->string('prepared_by')->nullable();
                $table->enum('status', array('Draft', 'Loaded', 'Delivered'))->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
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
        Schema::dropIfExists('delivery_instructions');
    }
}
