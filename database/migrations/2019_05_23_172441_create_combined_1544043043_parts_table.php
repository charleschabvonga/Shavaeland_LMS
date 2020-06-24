<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043043PartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('parts')) {
            Schema::create('parts', function (Blueprint $table) {
                $table->increments('id');
                $table->string('part')->nullable();
                $table->double('qty', 15, 2)->nullable();
                $table->enum('status', array('Available', 'Unavailable', 'Required'))->nullable();
                
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
        Schema::dropIfExists('parts');
    }
}
