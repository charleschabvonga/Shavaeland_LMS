<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043070ReceivingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('receivings')) {
            Schema::create('receivings', function (Blueprint $table) {
                $table->increments('id');
                $table->date('date')->nullable();
                $table->string('receipt_number')->nullable();
                $table->string('prepared_by')->nullable();
                $table->double('rate', 15, 2)->nullable();
                $table->double('days', 15, 2)->nullable();
                $table->double('total_area_coverd', 15, 2)->nullable();
                $table->double('total_amount', 15, 2)->nullable();
                
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
        Schema::dropIfExists('receivings');
    }
}
