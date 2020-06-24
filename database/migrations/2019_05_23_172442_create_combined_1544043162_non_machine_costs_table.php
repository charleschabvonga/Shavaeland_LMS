<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043162NonMachineCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('non_machine_costs')) {
            Schema::create('non_machine_costs', function (Blueprint $table) {
                $table->increments('id');
                $table->string('item_description')->nullable();
                $table->double('qty', 15, 2)->nullable();
                $table->decimal('cost', 15, 2)->nullable();
                $table->string('unit')->nullable();
                $table->decimal('total', 15, 2)->nullable();
                
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
        Schema::dropIfExists('non_machine_costs');
    }
}
