<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043148ReceivedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('received_items')) {
            Schema::create('received_items', function (Blueprint $table) {
                $table->increments('id');
                $table->string('item')->nullable();
                $table->double('qty', 15, 2)->nullable();
                $table->double('area', 15, 2)->nullable();
                $table->string('unit')->nullable();
                
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
        Schema::dropIfExists('received_items');
    }
}
