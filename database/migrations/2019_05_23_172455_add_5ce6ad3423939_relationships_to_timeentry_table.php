<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad3423939RelationshipsToTimeEntryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('time_entries', function(Blueprint $table) {
            if (!Schema::hasColumn('time_entries', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '237028_5c09694d57e81')->references('id')->on('time_projects')->onDelete('cascade');
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
        Schema::table('time_entries', function(Blueprint $table) {
            if(Schema::hasColumn('time_entries', 'client_id')) {
                $table->dropForeign('237028_5c09694d57e81');
                $table->dropIndex('237028_5c09694d57e81');
                $table->dropColumn('client_id');
            }
            
        });
    }
}
