<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad2d76df3RelationshipsToViolationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('violations', function(Blueprint $table) {
            if (!Schema::hasColumn('violations', 'employee_name_id')) {
                $table->integer('employee_name_id')->unsigned()->nullable();
                $table->foreign('employee_name_id', '237077_5c0839f083323')->references('id')->on('employees')->onDelete('cascade');
                }
                if (!Schema::hasColumn('violations', 'vehicle_description_id')) {
                $table->integer('vehicle_description_id')->unsigned()->nullable();
                $table->foreign('vehicle_description_id', '237077_5c4aea3b4ce5b')->references('id')->on('vehicles')->onDelete('cascade');
                }
                if (!Schema::hasColumn('violations', 'trailer_id')) {
                $table->integer('trailer_id')->unsigned()->nullable();
                $table->foreign('trailer_id', '237077_5c9391bb088c8')->references('id')->on('trailers')->onDelete('cascade');
                }
                if (!Schema::hasColumn('violations', 'road_freight_number_id')) {
                $table->integer('road_freight_number_id')->unsigned()->nullable();
                $table->foreign('road_freight_number_id', '237077_5c4a197ed8345')->references('id')->on('road_freights')->onDelete('cascade');
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
        Schema::table('violations', function(Blueprint $table) {
            if(Schema::hasColumn('violations', 'employee_name_id')) {
                $table->dropForeign('237077_5c0839f083323');
                $table->dropIndex('237077_5c0839f083323');
                $table->dropColumn('employee_name_id');
            }
            if(Schema::hasColumn('violations', 'vehicle_description_id')) {
                $table->dropForeign('237077_5c4aea3b4ce5b');
                $table->dropIndex('237077_5c4aea3b4ce5b');
                $table->dropColumn('vehicle_description_id');
            }
            if(Schema::hasColumn('violations', 'trailer_id')) {
                $table->dropForeign('237077_5c9391bb088c8');
                $table->dropIndex('237077_5c9391bb088c8');
                $table->dropColumn('trailer_id');
            }
            if(Schema::hasColumn('violations', 'road_freight_number_id')) {
                $table->dropForeign('237077_5c4a197ed8345');
                $table->dropIndex('237077_5c4a197ed8345');
                $table->dropColumn('road_freight_number_id');
            }
            
        });
    }
}
