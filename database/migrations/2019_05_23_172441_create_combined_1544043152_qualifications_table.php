<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043152QualificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('qualifications')) {
            Schema::create('qualifications', function (Blueprint $table) {
                $table->increments('id');
                $table->string('institution')->nullable();
                $table->string('description')->nullable();
                $table->date('date_obtained')->nullable();
                $table->date('expiry_date')->nullable();
                
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
        Schema::dropIfExists('qualifications');
    }
}
