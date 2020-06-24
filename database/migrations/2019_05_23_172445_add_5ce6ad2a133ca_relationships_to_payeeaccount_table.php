<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad2a133caRelationshipsToPayeeAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payee_accounts', function(Blueprint $table) {
            if (!Schema::hasColumn('payee_accounts', 'employee_id')) {
                $table->integer('employee_id')->unsigned()->nullable();
                $table->foreign('employee_id', '237082_5c0839d65a4ab')->references('id')->on('employees')->onDelete('cascade');
                }
                if (!Schema::hasColumn('payee_accounts', 'department_id')) {
                $table->integer('department_id')->unsigned()->nullable();
                $table->foreign('department_id', '237082_5c5be4662f7d7')->references('id')->on('departments')->onDelete('cascade');
                }
                if (!Schema::hasColumn('payee_accounts', 'position_id')) {
                $table->integer('position_id')->unsigned()->nullable();
                $table->foreign('position_id', '237082_5c5be46643174')->references('id')->on('employees')->onDelete('cascade');
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
        Schema::table('payee_accounts', function(Blueprint $table) {
            if(Schema::hasColumn('payee_accounts', 'employee_id')) {
                $table->dropForeign('237082_5c0839d65a4ab');
                $table->dropIndex('237082_5c0839d65a4ab');
                $table->dropColumn('employee_id');
            }
            if(Schema::hasColumn('payee_accounts', 'department_id')) {
                $table->dropForeign('237082_5c5be4662f7d7');
                $table->dropIndex('237082_5c5be4662f7d7');
                $table->dropColumn('department_id');
            }
            if(Schema::hasColumn('payee_accounts', 'position_id')) {
                $table->dropForeign('237082_5c5be46643174');
                $table->dropIndex('237082_5c5be46643174');
                $table->dropColumn('position_id');
            }
            
        });
    }
}
