<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544042891TimeEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('time_entries')) {
            Schema::create('time_entries', function (Blueprint $table) {
                $table->increments('id');
                $table->string('operation_number')->nullable();
                $table->date('entry_date')->nullable();
                $table->datetime('start_time')->nullable();
                $table->datetime('end_time')->nullable();
                $table->enum('status', array('Pending', 'Open', 'In Progress', 'Closed'))->nullable();
                
                $table->timestamps();
                
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
        Schema::dropIfExists('time_entries');
    }
}
