<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043028LoadingInstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('loading_instructions')) {
            Schema::create('loading_instructions', function (Blueprint $table) {
                $table->increments('id');
                $table->enum('freight_contract_type', array('Shavaeland', 'Subcontractor'))->nullable();
                $table->string('loading_instruction_number')->nullable();
                $table->string('order_number')->nullable();
                $table->string('pick_up_company_name')->nullable();
                $table->string('pickup_address_address')->nullable();
                $table->double('pickup_address_latitude')->nullable();
                $table->double('pickup_address_longitude')->nullable();
                $table->datetime('pickup_date_time')->nullable();
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
        Schema::dropIfExists('loading_instructions');
    }
}
