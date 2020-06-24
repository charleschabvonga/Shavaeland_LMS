<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043137DeductionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('deduction_items')) {
            Schema::create('deduction_items', function (Blueprint $table) {
                $table->increments('id');
                $table->string('item_description')->nullable();
                $table->decimal('unit_price', 15, 2)->nullable();
                $table->double('qty', 15, 2)->nullable();
                $table->decimal('total', 15, 2)->nullable();
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
        Schema::dropIfExists('deduction_items');
    }
}
