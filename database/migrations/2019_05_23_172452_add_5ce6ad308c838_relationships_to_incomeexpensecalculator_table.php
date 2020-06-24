<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad308c838RelationshipsToIncomeExpenseCalculatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('income_expense_calculators', function(Blueprint $table) {
            if (!Schema::hasColumn('income_expense_calculators', 'route_id')) {
                $table->integer('route_id')->unsigned()->nullable();
                $table->foreign('route_id', '238401_5c0ccaca2fc33')->references('id')->on('routes')->onDelete('cascade');
                }
                if (!Schema::hasColumn('income_expense_calculators', 'truck_attachment_status_id')) {
                $table->integer('truck_attachment_status_id')->unsigned()->nullable();
                $table->foreign('truck_attachment_status_id', '238401_5c0ccaca798b7')->references('id')->on('truck_attachment_statuses')->onDelete('cascade');
                }
                if (!Schema::hasColumn('income_expense_calculators', 'machinery_attachment_type_id')) {
                $table->integer('machinery_attachment_type_id')->unsigned()->nullable();
                $table->foreign('machinery_attachment_type_id', '238401_5c0ccaca9e673')->references('id')->on('machinery_types')->onDelete('cascade');
                }
                if (!Schema::hasColumn('income_expense_calculators', 'size_id')) {
                $table->integer('size_id')->unsigned()->nullable();
                $table->foreign('size_id', '238401_5c0ccacac10c6')->references('id')->on('machinery_sizes')->onDelete('cascade');
                }
                if (!Schema::hasColumn('income_expense_calculators', 'vehicles_id')) {
                $table->integer('vehicles_id')->unsigned()->nullable();
                $table->foreign('vehicles_id', '238401_5c0ccacae9748')->references('id')->on('vehicles')->onDelete('cascade');
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
        Schema::table('income_expense_calculators', function(Blueprint $table) {
            if(Schema::hasColumn('income_expense_calculators', 'route_id')) {
                $table->dropForeign('238401_5c0ccaca2fc33');
                $table->dropIndex('238401_5c0ccaca2fc33');
                $table->dropColumn('route_id');
            }
            if(Schema::hasColumn('income_expense_calculators', 'truck_attachment_status_id')) {
                $table->dropForeign('238401_5c0ccaca798b7');
                $table->dropIndex('238401_5c0ccaca798b7');
                $table->dropColumn('truck_attachment_status_id');
            }
            if(Schema::hasColumn('income_expense_calculators', 'machinery_attachment_type_id')) {
                $table->dropForeign('238401_5c0ccaca9e673');
                $table->dropIndex('238401_5c0ccaca9e673');
                $table->dropColumn('machinery_attachment_type_id');
            }
            if(Schema::hasColumn('income_expense_calculators', 'size_id')) {
                $table->dropForeign('238401_5c0ccacac10c6');
                $table->dropIndex('238401_5c0ccacac10c6');
                $table->dropColumn('size_id');
            }
            if(Schema::hasColumn('income_expense_calculators', 'vehicles_id')) {
                $table->dropForeign('238401_5c0ccacae9748');
                $table->dropIndex('238401_5c0ccacae9748');
                $table->dropColumn('vehicles_id');
            }
            
        });
    }
}
