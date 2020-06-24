<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad531396aRelationshipsToVendorAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_accounts', function(Blueprint $table) {
            if (!Schema::hasColumn('vendor_accounts', 'vendor_id')) {
                $table->integer('vendor_id')->unsigned()->nullable();
                $table->foreign('vendor_id', '237049_5c0839e245c4e')->references('id')->on('vendors')->onDelete('cascade');
                }
                if (!Schema::hasColumn('vendor_accounts', 'contact_person_id')) {
                $table->integer('contact_person_id')->unsigned()->nullable();
                $table->foreign('contact_person_id', '237049_5c0839e2565ed')->references('id')->on('vendor_contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('vendor_accounts', 'account_manager_id')) {
                $table->integer('account_manager_id')->unsigned()->nullable();
                $table->foreign('account_manager_id', '237049_5c0839e26aaf5')->references('id')->on('employees')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_accounts', function(Blueprint $table) {
            if(Schema::hasColumn('vendor_accounts', 'vendor_id')) {
                $table->dropForeign('237049_5c0839e245c4e');
                $table->dropIndex('237049_5c0839e245c4e');
                $table->dropColumn('vendor_id');
            }
            if(Schema::hasColumn('vendor_accounts', 'contact_person_id')) {
                $table->dropForeign('237049_5c0839e2565ed');
                $table->dropIndex('237049_5c0839e2565ed');
                $table->dropColumn('contact_person_id');
            }
            if(Schema::hasColumn('vendor_accounts', 'account_manager_id')) {
                $table->dropForeign('237049_5c0839e26aaf5');
                $table->dropIndex('237049_5c0839e26aaf5');
                $table->dropColumn('account_manager_id');
            }
            
        });
    }
}
