<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1554713228BeneficiaryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('beneficiary_details')) {
            Schema::create('beneficiary_details', function (Blueprint $table) {
                $table->increments('id');
                $table->string('beneficiary_name')->nullable();
                $table->string('id_number')->nullable();
                $table->string('address')->nullable();
                $table->string('phone1')->nullable();
                $table->string('phone')->nullable();
                $table->string('allocation_percentage')->nullable();
                
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
        Schema::dropIfExists('beneficiary_details');
    }
}
