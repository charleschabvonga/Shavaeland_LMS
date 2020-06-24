<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043020DriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('drivers')) {
            Schema::create('drivers', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->date('date_of_birth')->nullable();
                $table->string('drivers_license_number')->nullable();
                $table->string('drivers_license')->nullable();
                $table->date('drivers_license_expiry_date')->nullable();
                $table->string('int_drivers_license_no')->nullable();
                $table->string('int_drivers_license')->nullable();
                $table->date('int_drivers_license_expiry_date')->nullable();
                $table->string('drivers_passport_number')->nullable();
                $table->string('drivers_passport')->nullable();
                $table->date('passport_expiry_date')->nullable();
                $table->string('sa_phone_number')->nullable();
                $table->string('int_phone_number')->nullable();
                $table->date('police_clearance_expiry_date')->nullable();
                $table->string('police_clearance')->nullable();
                $table->string('retest_number')->nullable();
                $table->string('retest')->nullable();
                $table->date('retest_expiry_date')->nullable();
                $table->enum('status', array('Up to date', 'License expired', 'Int license expired', 'Passport expired', 'Retest expired', 'Police clearance expired'))->nullable();
                
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
        Schema::dropIfExists('drivers');
    }
}
