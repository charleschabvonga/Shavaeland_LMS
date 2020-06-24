<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad2e97adeRelationshipsToVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicles', function(Blueprint $table) {
            if (!Schema::hasColumn('vehicles', 'size_id')) {
                $table->integer('size_id')->unsigned()->nullable();
                $table->foreign('size_id', '237071_5c91fd20af7ef')->references('id')->on('machinery_sizes')->onDelete('cascade');
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
        Schema::table('vehicles', function(Blueprint $table) {
            if(Schema::hasColumn('vehicles', 'size_id')) {
                $table->dropForeign('237071_5c91fd20af7ef');
                $table->dropIndex('237071_5c91fd20af7ef');
                $table->dropColumn('size_id');
            }
            
        });
    }
}
