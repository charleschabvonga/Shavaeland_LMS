<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad3395165RelationshipsToDriverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drivers', function(Blueprint $table) {
            if (!Schema::hasColumn('drivers', 'vendor_id')) {
                $table->integer('vendor_id')->unsigned()->nullable();
                $table->foreign('vendor_id', '237073_5c083a0d9f767')->references('id')->on('vendors')->onDelete('cascade');
                }
                if (!Schema::hasColumn('drivers', 'subcontractor_number_id')) {
                $table->integer('subcontractor_number_id')->unsigned()->nullable();
                $table->foreign('subcontractor_number_id', '237073_5c0f89d9bae94')->references('id')->on('road_freight_sub_contractors')->onDelete('cascade');
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
        Schema::table('drivers', function(Blueprint $table) {
            if(Schema::hasColumn('drivers', 'vendor_id')) {
                $table->dropForeign('237073_5c083a0d9f767');
                $table->dropIndex('237073_5c083a0d9f767');
                $table->dropColumn('vendor_id');
            }
            if(Schema::hasColumn('drivers', 'subcontractor_number_id')) {
                $table->dropForeign('237073_5c0f89d9bae94');
                $table->dropIndex('237073_5c0f89d9bae94');
                $table->dropColumn('subcontractor_number_id');
            }
            
        });
    }
}
