<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ce6ad6e6bf2eTimeEntryTimeWorkTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('time_entry_time_work_type')) {
            Schema::create('time_entry_time_work_type', function (Blueprint $table) {
                $table->integer('time_entry_id')->unsigned()->nullable();
                $table->foreign('time_entry_id', 'fk_p_237028_237026_timewo_5ce6ad6e6c071')->references('id')->on('time_entries')->onDelete('cascade');
                $table->integer('time_work_type_id')->unsigned()->nullable();
                $table->foreign('time_work_type_id', 'fk_p_237026_237028_timeen_5ce6ad6e6c121')->references('id')->on('time_work_types')->onDelete('cascade');
                
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
        Schema::dropIfExists('time_entry_time_work_type');
    }
}
