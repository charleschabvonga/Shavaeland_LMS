<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544042971VendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('vendors')) {
            Schema::create('vendors', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->enum('vendor_type', array('', 'Supplier', 'Department'))->nullable();
                $table->string('street_address')->nullable();
                $table->string('city')->nullable();
                $table->string('province')->nullable();
                $table->string('postal_code')->nullable();
                $table->string('country')->nullable();
                $table->string('vat')->nullable();
                $table->string('website')->nullable();
                $table->string('email')->nullable();
                $table->string('phone_number_1')->nullable();
                $table->string('phone_number_2')->nullable();
                $table->string('fax_number')->nullable();
                $table->string('tax_clearance_number')->nullable();
                $table->string('tax_clearance')->nullable();
                $table->date('tax_clearance_expiration_date')->nullable();
                $table->string('company_registration_number')->nullable();
                $table->string('company_registration')->nullable();
                $table->string('company_proof_of_residents')->nullable();
                $table->string('directors_name')->nullable();
                $table->string('director_id_number')->nullable();
                $table->string('directors_proof_of_residence')->nullable();
                
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
        Schema::dropIfExists('vendors');
    }
}
