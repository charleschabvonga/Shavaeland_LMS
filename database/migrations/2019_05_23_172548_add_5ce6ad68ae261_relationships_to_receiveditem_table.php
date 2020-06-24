<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad68ae261RelationshipsToReceivedItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('received_items', function(Blueprint $table) {
            if (!Schema::hasColumn('received_items', 'receipt_number_id')) {
                $table->integer('receipt_number_id')->unsigned()->nullable();
                $table->foreign('receipt_number_id', '237059_5c083a8e9bdcf')->references('id')->on('receivings')->onDelete('cascade');
                }
                if (!Schema::hasColumn('received_items', 'release_number_id')) {
                $table->integer('release_number_id')->unsigned()->nullable();
                $table->foreign('release_number_id', '237059_5c083a8ec0e01')->references('id')->on('releasings')->onDelete('cascade');
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
        Schema::table('received_items', function(Blueprint $table) {
            if(Schema::hasColumn('received_items', 'receipt_number_id')) {
                $table->dropForeign('237059_5c083a8e9bdcf');
                $table->dropIndex('237059_5c083a8e9bdcf');
                $table->dropColumn('receipt_number_id');
            }
            if(Schema::hasColumn('received_items', 'release_number_id')) {
                $table->dropForeign('237059_5c083a8ec0e01');
                $table->dropIndex('237059_5c083a8ec0e01');
                $table->dropColumn('release_number_id');
            }
            
        });
    }
}
