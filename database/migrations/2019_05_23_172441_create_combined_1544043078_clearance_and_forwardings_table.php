<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043078ClearanceAndForwardingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('clearance_and_forwardings')) {
            Schema::create('clearance_and_forwardings', function (Blueprint $table) {
                $table->increments('id');
                $table->string('clearance_and_forwarding_number')->nullable();
                $table->string('border_post')->nullable();
                
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
        Schema::dropIfExists('clearance_and_forwardings');
    }
}
