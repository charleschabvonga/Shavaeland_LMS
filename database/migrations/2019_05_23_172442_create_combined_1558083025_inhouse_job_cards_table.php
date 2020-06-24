<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1558083025InhouseJobCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('inhouse_job_cards')) {
            Schema::create('inhouse_job_cards', function (Blueprint $table) {
                $table->increments('id');
                $table->date('date')->nullable();
                $table->enum('vehicle_type', array('Horse', 'Truck', 'Trailer', 'Bukkie', 'Light', 'Twin Cab'))->nullable();
                $table->string('mileage')->nullable();
                $table->string('job_card_number')->nullable();
                $table->string('prepared_by')->nullable();
                $table->enum('client_type', array('Department', 'Vendor'))->nullable();
                $table->enum('job_card_type', array('Project', 'Transaction'))->nullable();
                $table->enum('job_type', array('Scheduled', 'Breakdown'))->nullable();
                $table->text('remarks')->nullable();
                $table->text('instructions')->nullable();
                $table->decimal('subtotal', 15, 2)->nullable();
                $table->enum('status', array('Job Complete', 'Job Ongoing'))->nullable();
                
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
        Schema::dropIfExists('inhouse_job_cards');
    }
}
