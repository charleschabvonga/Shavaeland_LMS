<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544042991ViolationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('violations')) {
            Schema::create('violations', function (Blueprint $table) {
                $table->increments('id');
                $table->string('citation_number')->nullable();
                $table->date('citation_date')->nullable();
                $table->string('description')->nullable();
                $table->string('location_issued_address')->nullable();
                $table->double('location_issued_latitude')->nullable();
                $table->double('location_issued_longitude')->nullable();
                $table->string('file')->nullable();
                $table->enum('status', array('Driver', 'Operations', 'Workshop'))->nullable();
                $table->decimal('amount', 15, 2)->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
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
        Schema::dropIfExists('violations');
    }
}
