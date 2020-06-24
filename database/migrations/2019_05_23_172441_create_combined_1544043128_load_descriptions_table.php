<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043128LoadDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('load_descriptions')) {
            Schema::create('load_descriptions', function (Blueprint $table) {
                $table->increments('id');
                $table->string('description')->nullable();
                $table->double('qty', 15, 2)->nullable();
                $table->double('weight_volume', 15, 2)->nullable();
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
        Schema::dropIfExists('load_descriptions');
    }
}
