<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad6425cf5RelationshipsToMachinerySizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('machinery_sizes', function(Blueprint $table) {
            if (!Schema::hasColumn('machinery_sizes', 'attachment_id')) {
                $table->integer('attachment_id')->unsigned()->nullable();
                $table->foreign('attachment_id', '238400_5c0cbdf5d5778')->references('id')->on('truck_attachment_statuses')->onDelete('cascade');
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
        Schema::table('machinery_sizes', function(Blueprint $table) {
            if(Schema::hasColumn('machinery_sizes', 'attachment_id')) {
                $table->dropForeign('238400_5c0cbdf5d5778');
                $table->dropIndex('238400_5c0cbdf5d5778');
                $table->dropColumn('attachment_id');
            }
            
        });
    }
}
