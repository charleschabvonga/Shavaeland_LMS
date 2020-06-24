<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043140JobCardItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('job_card_items')) {
            Schema::create('job_card_items', function (Blueprint $table) {
                $table->increments('id');
                $table->string('workshop')->nullable();
                $table->string('part')->nullable();
                $table->double('price', 15, 2)->nullable();
                $table->double('qty', 15, 2)->nullable();
                $table->string('unit')->nullable();
                $table->double('total', 15, 2)->nullable();
                
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
        Schema::dropIfExists('job_card_items');
    }
}
