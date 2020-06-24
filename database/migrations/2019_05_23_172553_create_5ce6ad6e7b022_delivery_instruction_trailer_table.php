<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ce6ad6e7b022DeliveryInstructionTrailerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('delivery_instruction_trailer')) {
            Schema::create('delivery_instruction_trailer', function (Blueprint $table) {
                $table->integer('delivery_instruction_id')->unsigned()->nullable();
                $table->foreign('delivery_instruction_id', 'fk_p_237078_280017_traile_5ce6ad6e7b1c7')->references('id')->on('delivery_instructions')->onDelete('cascade');
                $table->integer('trailer_id')->unsigned()->nullable();
                $table->foreign('trailer_id', 'fk_p_280017_237078_delive_5ce6ad6e7b29a')->references('id')->on('trailers')->onDelete('cascade');
                
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
        Schema::dropIfExists('delivery_instruction_trailer');
    }
}
