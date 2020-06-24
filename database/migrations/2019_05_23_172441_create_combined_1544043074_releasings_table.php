<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043074ReleasingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('releasings')) {
            Schema::create('releasings', function (Blueprint $table) {
                $table->increments('id');
                $table->datetime('date')->nullable();
                $table->string('release_number')->nullable();
                $table->string('prepared_by')->nullable();
                $table->double('area_coverd', 15, 2)->nullable();
                
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
        Schema::dropIfExists('releasings');
    }
}
