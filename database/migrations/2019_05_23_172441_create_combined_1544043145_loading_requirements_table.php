<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043145LoadingRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('loading_requirements')) {
            Schema::create('loading_requirements', function (Blueprint $table) {
                $table->increments('id');
                $table->string('item_description')->nullable();
                $table->double('qty', 15, 2)->nullable();
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
        Schema::dropIfExists('loading_requirements');
    }
}
