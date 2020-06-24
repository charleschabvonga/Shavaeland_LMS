<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043155IdentificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('identifications')) {
            Schema::create('identifications', function (Blueprint $table) {
                $table->increments('id');
                $table->string('id_type')->nullable();
                $table->string('id_number')->nullable();
                $table->date('date_of_birth')->nullable();
                $table->date('date_obtained')->nullable();
                $table->string('expiry_date')->nullable();
                
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
        Schema::dropIfExists('identifications');
    }
}
