<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad2f3476eRelationshipsToLightVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('light_vehicles', function(Blueprint $table) {
            if (!Schema::hasColumn('light_vehicles', 'size_id')) {
                $table->integer('size_id')->unsigned()->nullable();
                $table->foreign('size_id', '289808_5cadac710e313')->references('id')->on('machinery_sizes')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('light_vehicles', function(Blueprint $table) {
            if(Schema::hasColumn('light_vehicles', 'size_id')) {
                $table->dropForeign('289808_5cadac710e313');
                $table->dropIndex('289808_5cadac710e313');
                $table->dropColumn('size_id');
            }
            
        });
    }
}
