<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad4c07cb4RelationshipsToWorkshopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('workshops', function(Blueprint $table) {
            if (!Schema::hasColumn('workshops', 'vendor_id')) {
                $table->integer('vendor_id')->unsigned()->nullable();
                $table->foreign('vendor_id', '237086_5c083a21c711b')->references('id')->on('vendors')->onDelete('cascade');
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
        Schema::table('workshops', function(Blueprint $table) {
            if(Schema::hasColumn('workshops', 'vendor_id')) {
                $table->dropForeign('237086_5c083a21c711b');
                $table->dropIndex('237086_5c083a21c711b');
                $table->dropColumn('vendor_id');
            }
            
        });
    }
}
