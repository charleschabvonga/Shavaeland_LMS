<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad4e390caRelationshipsToClientAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_accounts', function(Blueprint $table) {
            if (!Schema::hasColumn('client_accounts', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '237089_5c083a5f70166')->references('id')->on('time_projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('client_accounts', 'contact_person_id')) {
                $table->integer('contact_person_id')->unsigned()->nullable();
                $table->foreign('contact_person_id', '237089_5c083a5f85662')->references('id')->on('client_contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('client_accounts', 'account_manager_id')) {
                $table->integer('account_manager_id')->unsigned()->nullable();
                $table->foreign('account_manager_id', '237089_5c083a5f98b87')->references('id')->on('employees')->onDelete('cascade');
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
        Schema::table('client_accounts', function(Blueprint $table) {
            if(Schema::hasColumn('client_accounts', 'client_id')) {
                $table->dropForeign('237089_5c083a5f70166');
                $table->dropIndex('237089_5c083a5f70166');
                $table->dropColumn('client_id');
            }
            if(Schema::hasColumn('client_accounts', 'contact_person_id')) {
                $table->dropForeign('237089_5c083a5f85662');
                $table->dropIndex('237089_5c083a5f85662');
                $table->dropColumn('contact_person_id');
            }
            if(Schema::hasColumn('client_accounts', 'account_manager_id')) {
                $table->dropForeign('237089_5c083a5f98b87');
                $table->dropIndex('237089_5c083a5f98b87');
                $table->dropColumn('account_manager_id');
            }
            
        });
    }
}
