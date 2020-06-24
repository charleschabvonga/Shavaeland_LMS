<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1554891688ClientJobCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('client_job_cards')) {
            Schema::create('client_job_cards', function (Blueprint $table) {
                $table->increments('id');
                $table->date('date')->nullable();
                $table->string('job_card_number')->nullable();
                $table->string('prepared_by')->nullable();
                $table->enum('status', array('Job Ongoing', 'Job Complete'))->nullable();
                $table->enum('job_type', array('Scheduled', 'Breakdown'))->nullable();
                $table->text('remarks')->nullable();
                $table->text('instructions')->nullable();
                $table->decimal('subtotal', 15, 2)->nullable();
                
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
        Schema::dropIfExists('client_job_cards');
    }
}
