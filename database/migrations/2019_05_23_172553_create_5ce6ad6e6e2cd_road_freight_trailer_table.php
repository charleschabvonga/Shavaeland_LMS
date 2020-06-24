<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ce6ad6e6e2cdRoadFreightTrailerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('road_freight_trailer')) {
            Schema::create('road_freight_trailer', function (Blueprint $table) {
                $table->integer('road_freight_id')->unsigned()->nullable();
                $table->foreign('road_freight_id', 'fk_p_237076_280017_traile_5ce6ad6e6e400')->references('id')->on('road_freights')->onDelete('cascade');
                $table->integer('trailer_id')->unsigned()->nullable();
                $table->foreign('trailer_id', 'fk_p_280017_237076_roadfr_5ce6ad6e6e4d7')->references('id')->on('trailers')->onDelete('cascade');
                
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
        Schema::dropIfExists('road_freight_trailer');
    }
}
