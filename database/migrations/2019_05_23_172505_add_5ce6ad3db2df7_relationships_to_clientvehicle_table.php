<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad3db2df7RelationshipsToClientVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_vehicles', function(Blueprint $table) {
            if (!Schema::hasColumn('client_vehicles', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '237099_5c083a329c607')->references('id')->on('time_projects')->onDelete('cascade');
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
        Schema::table('client_vehicles', function(Blueprint $table) {
            if(Schema::hasColumn('client_vehicles', 'client_id')) {
                $table->dropForeign('237099_5c083a329c607');
                $table->dropIndex('237099_5c083a329c607');
                $table->dropColumn('client_id');
            }
            
        });
    }
}
