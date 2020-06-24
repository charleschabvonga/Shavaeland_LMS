<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ce6ad6e757c2LoadingInstructionTrailerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('loading_instruction_trailer')) {
            Schema::create('loading_instruction_trailer', function (Blueprint $table) {
                $table->integer('loading_instruction_id')->unsigned()->nullable();
                $table->foreign('loading_instruction_id', 'fk_p_237085_280017_traile_5ce6ad6e75968')->references('id')->on('loading_instructions')->onDelete('cascade');
                $table->integer('trailer_id')->unsigned()->nullable();
                $table->foreign('trailer_id', 'fk_p_280017_237085_loadin_5ce6ad6e75a51')->references('id')->on('trailers')->onDelete('cascade');
                
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
        Schema::dropIfExists('loading_instruction_trailer');
    }
}
