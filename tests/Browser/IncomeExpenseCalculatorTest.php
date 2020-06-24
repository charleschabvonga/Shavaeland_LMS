<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class IncomeExpenseCalculatorTest extends DuskTestCase
{

    public function testCreateIncomeExpenseCalculator()
    {
        $admin = \App\User::find(1);
        $income_expense_calculator = factory('App\IncomeExpenseCalculator')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $income_expense_calculator) {
            $browser->loginAs($admin)
                ->visit(route('admin.income_expense_calculators.index'))
                ->clickLink('Add new')
                ->select("route_id", $income_expense_calculator->route_id)
                ->type("distance", $income_expense_calculator->distance)
                ->select("load_status", $income_expense_calculator->load_status)
                ->select("truck_attachment_status_id", $income_expense_calculator->truck_attachment_status_id)
                ->select("machinery_attachment_type_id", $income_expense_calculator->machinery_attachment_type_id)
                ->select("size_id", $income_expense_calculator->size_id)
                ->select("vehicles_id", $income_expense_calculator->vehicles_id)
                ->type("purchase_price", $income_expense_calculator->purchase_price)
                ->type("salvage_value", $income_expense_calculator->salvage_value)
                ->type("avg_investment", $income_expense_calculator->avg_investment)
                ->type("depreciation", $income_expense_calculator->depreciation)
                ->type("insurance", $income_expense_calculator->insurance)
                ->type("license", $income_expense_calculator->license)
                ->type("fuel_price", $income_expense_calculator->fuel_price)
                ->type("fuel_usage", $income_expense_calculator->fuel_usage)
                ->type("fuel", $income_expense_calculator->fuel)
                ->type("fuel_consumption", $income_expense_calculator->fuel_consumption)
                ->type("oil_price", $income_expense_calculator->oil_price)
                ->type("oil_usage", $income_expense_calculator->oil_usage)
                ->type("oil", $income_expense_calculator->oil)
                ->type("oil_consumption", $income_expense_calculator->oil_consumption)
                ->type("tyre_price", $income_expense_calculator->tyre_price)
                ->type("number_of_tyres", $income_expense_calculator->number_of_tyres)
                ->type("tyre", $income_expense_calculator->tyre)
                ->type("repair_maintenance", $income_expense_calculator->repair_maintenance)
                ->type("contigency_factor", $income_expense_calculator->contigency_factor)
                ->type("trip_income", $income_expense_calculator->trip_income)
                ->type("other_costs", $income_expense_calculator->other_costs)
                ->type("total_costs", $income_expense_calculator->total_costs)
                ->type("balance", $income_expense_calculator->balance)
                ->press('Save')
                ->assertRouteIs('admin.income_expense_calculators.index')
                ->assertSeeIn("tr:last-child td[field-key='route']", $income_expense_calculator->route->route)
                ->assertSeeIn("tr:last-child td[field-key='distance']", $income_expense_calculator->distance)
                ->assertSeeIn("tr:last-child td[field-key='load_status']", $income_expense_calculator->load_status)
                ->assertSeeIn("tr:last-child td[field-key='truck_attachment_status']", $income_expense_calculator->truck_attachment_status->attachment)
                ->assertSeeIn("tr:last-child td[field-key='machinery_attachment_type']", $income_expense_calculator->machinery_attachment_type->machinery_type)
                ->assertSeeIn("tr:last-child td[field-key='size']", $income_expense_calculator->size->size)
                ->assertSeeIn("tr:last-child td[field-key='vehicles']", $income_expense_calculator->vehicles->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='purchase_price']", $income_expense_calculator->purchase_price)
                ->assertSeeIn("tr:last-child td[field-key='salvage_value']", $income_expense_calculator->salvage_value)
                ->assertSeeIn("tr:last-child td[field-key='avg_investment']", $income_expense_calculator->avg_investment)
                ->assertSeeIn("tr:last-child td[field-key='depreciation']", $income_expense_calculator->depreciation)
                ->assertSeeIn("tr:last-child td[field-key='insurance']", $income_expense_calculator->insurance)
                ->assertSeeIn("tr:last-child td[field-key='license']", $income_expense_calculator->license)
                ->assertSeeIn("tr:last-child td[field-key='fuel_price']", $income_expense_calculator->fuel_price)
                ->assertSeeIn("tr:last-child td[field-key='fuel_usage']", $income_expense_calculator->fuel_usage)
                ->assertSeeIn("tr:last-child td[field-key='fuel']", $income_expense_calculator->fuel)
                ->assertSeeIn("tr:last-child td[field-key='fuel_consumption']", $income_expense_calculator->fuel_consumption)
                ->assertSeeIn("tr:last-child td[field-key='oil_price']", $income_expense_calculator->oil_price)
                ->assertSeeIn("tr:last-child td[field-key='oil_usage']", $income_expense_calculator->oil_usage)
                ->assertSeeIn("tr:last-child td[field-key='oil']", $income_expense_calculator->oil)
                ->assertSeeIn("tr:last-child td[field-key='oil_consumption']", $income_expense_calculator->oil_consumption)
                ->assertSeeIn("tr:last-child td[field-key='tyre_price']", $income_expense_calculator->tyre_price)
                ->assertSeeIn("tr:last-child td[field-key='number_of_tyres']", $income_expense_calculator->number_of_tyres)
                ->assertSeeIn("tr:last-child td[field-key='tyre']", $income_expense_calculator->tyre)
                ->assertSeeIn("tr:last-child td[field-key='repair_maintenance']", $income_expense_calculator->repair_maintenance)
                ->assertSeeIn("tr:last-child td[field-key='contigency_factor']", $income_expense_calculator->contigency_factor)
                ->assertSeeIn("tr:last-child td[field-key='trip_income']", $income_expense_calculator->trip_income)
                ->assertSeeIn("tr:last-child td[field-key='other_costs']", $income_expense_calculator->other_costs)
                ->assertSeeIn("tr:last-child td[field-key='total_costs']", $income_expense_calculator->total_costs)
                ->assertSeeIn("tr:last-child td[field-key='balance']", $income_expense_calculator->balance)
                ->logout();
        });
    }

    public function testEditIncomeExpenseCalculator()
    {
        $admin = \App\User::find(1);
        $income_expense_calculator = factory('App\IncomeExpenseCalculator')->create();
        $income_expense_calculator2 = factory('App\IncomeExpenseCalculator')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $income_expense_calculator, $income_expense_calculator2) {
            $browser->loginAs($admin)
                ->visit(route('admin.income_expense_calculators.index'))
                ->click('tr[data-entry-id="' . $income_expense_calculator->id . '"] .btn-info')
                ->select("route_id", $income_expense_calculator2->route_id)
                ->type("distance", $income_expense_calculator2->distance)
                ->select("load_status", $income_expense_calculator2->load_status)
                ->select("truck_attachment_status_id", $income_expense_calculator2->truck_attachment_status_id)
                ->select("machinery_attachment_type_id", $income_expense_calculator2->machinery_attachment_type_id)
                ->select("size_id", $income_expense_calculator2->size_id)
                ->select("vehicles_id", $income_expense_calculator2->vehicles_id)
                ->type("purchase_price", $income_expense_calculator2->purchase_price)
                ->type("salvage_value", $income_expense_calculator2->salvage_value)
                ->type("avg_investment", $income_expense_calculator2->avg_investment)
                ->type("depreciation", $income_expense_calculator2->depreciation)
                ->type("insurance", $income_expense_calculator2->insurance)
                ->type("license", $income_expense_calculator2->license)
                ->type("fuel_price", $income_expense_calculator2->fuel_price)
                ->type("fuel_usage", $income_expense_calculator2->fuel_usage)
                ->type("fuel", $income_expense_calculator2->fuel)
                ->type("fuel_consumption", $income_expense_calculator2->fuel_consumption)
                ->type("oil_price", $income_expense_calculator2->oil_price)
                ->type("oil_usage", $income_expense_calculator2->oil_usage)
                ->type("oil", $income_expense_calculator2->oil)
                ->type("oil_consumption", $income_expense_calculator2->oil_consumption)
                ->type("tyre_price", $income_expense_calculator2->tyre_price)
                ->type("number_of_tyres", $income_expense_calculator2->number_of_tyres)
                ->type("tyre", $income_expense_calculator2->tyre)
                ->type("repair_maintenance", $income_expense_calculator2->repair_maintenance)
                ->type("contigency_factor", $income_expense_calculator2->contigency_factor)
                ->type("trip_income", $income_expense_calculator2->trip_income)
                ->type("other_costs", $income_expense_calculator2->other_costs)
                ->type("total_costs", $income_expense_calculator2->total_costs)
                ->type("balance", $income_expense_calculator2->balance)
                ->press('Update')
                ->assertRouteIs('admin.income_expense_calculators.index')
                ->assertSeeIn("tr:last-child td[field-key='route']", $income_expense_calculator2->route->route)
                ->assertSeeIn("tr:last-child td[field-key='distance']", $income_expense_calculator2->distance)
                ->assertSeeIn("tr:last-child td[field-key='load_status']", $income_expense_calculator2->load_status)
                ->assertSeeIn("tr:last-child td[field-key='truck_attachment_status']", $income_expense_calculator2->truck_attachment_status->attachment)
                ->assertSeeIn("tr:last-child td[field-key='machinery_attachment_type']", $income_expense_calculator2->machinery_attachment_type->machinery_type)
                ->assertSeeIn("tr:last-child td[field-key='size']", $income_expense_calculator2->size->size)
                ->assertSeeIn("tr:last-child td[field-key='vehicles']", $income_expense_calculator2->vehicles->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='purchase_price']", $income_expense_calculator2->purchase_price)
                ->assertSeeIn("tr:last-child td[field-key='salvage_value']", $income_expense_calculator2->salvage_value)
                ->assertSeeIn("tr:last-child td[field-key='avg_investment']", $income_expense_calculator2->avg_investment)
                ->assertSeeIn("tr:last-child td[field-key='depreciation']", $income_expense_calculator2->depreciation)
                ->assertSeeIn("tr:last-child td[field-key='insurance']", $income_expense_calculator2->insurance)
                ->assertSeeIn("tr:last-child td[field-key='license']", $income_expense_calculator2->license)
                ->assertSeeIn("tr:last-child td[field-key='fuel_price']", $income_expense_calculator2->fuel_price)
                ->assertSeeIn("tr:last-child td[field-key='fuel_usage']", $income_expense_calculator2->fuel_usage)
                ->assertSeeIn("tr:last-child td[field-key='fuel']", $income_expense_calculator2->fuel)
                ->assertSeeIn("tr:last-child td[field-key='fuel_consumption']", $income_expense_calculator2->fuel_consumption)
                ->assertSeeIn("tr:last-child td[field-key='oil_price']", $income_expense_calculator2->oil_price)
                ->assertSeeIn("tr:last-child td[field-key='oil_usage']", $income_expense_calculator2->oil_usage)
                ->assertSeeIn("tr:last-child td[field-key='oil']", $income_expense_calculator2->oil)
                ->assertSeeIn("tr:last-child td[field-key='oil_consumption']", $income_expense_calculator2->oil_consumption)
                ->assertSeeIn("tr:last-child td[field-key='tyre_price']", $income_expense_calculator2->tyre_price)
                ->assertSeeIn("tr:last-child td[field-key='number_of_tyres']", $income_expense_calculator2->number_of_tyres)
                ->assertSeeIn("tr:last-child td[field-key='tyre']", $income_expense_calculator2->tyre)
                ->assertSeeIn("tr:last-child td[field-key='repair_maintenance']", $income_expense_calculator2->repair_maintenance)
                ->assertSeeIn("tr:last-child td[field-key='contigency_factor']", $income_expense_calculator2->contigency_factor)
                ->assertSeeIn("tr:last-child td[field-key='trip_income']", $income_expense_calculator2->trip_income)
                ->assertSeeIn("tr:last-child td[field-key='other_costs']", $income_expense_calculator2->other_costs)
                ->assertSeeIn("tr:last-child td[field-key='total_costs']", $income_expense_calculator2->total_costs)
                ->assertSeeIn("tr:last-child td[field-key='balance']", $income_expense_calculator2->balance)
                ->logout();
        });
    }

    public function testShowIncomeExpenseCalculator()
    {
        $admin = \App\User::find(1);
        $income_expense_calculator = factory('App\IncomeExpenseCalculator')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $income_expense_calculator) {
            $browser->loginAs($admin)
                ->visit(route('admin.income_expense_calculators.index'))
                ->click('tr[data-entry-id="' . $income_expense_calculator->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='route']", $income_expense_calculator->route->route)
                ->assertSeeIn("td[field-key='distance']", $income_expense_calculator->distance)
                ->assertSeeIn("td[field-key='load_status']", $income_expense_calculator->load_status)
                ->assertSeeIn("td[field-key='truck_attachment_status']", $income_expense_calculator->truck_attachment_status->attachment)
                ->assertSeeIn("td[field-key='machinery_attachment_type']", $income_expense_calculator->machinery_attachment_type->machinery_type)
                ->assertSeeIn("td[field-key='size']", $income_expense_calculator->size->size)
                ->assertSeeIn("td[field-key='vehicles']", $income_expense_calculator->vehicles->vehicle_description)
                ->assertSeeIn("td[field-key='purchase_price']", $income_expense_calculator->purchase_price)
                ->assertSeeIn("td[field-key='salvage_value']", $income_expense_calculator->salvage_value)
                ->assertSeeIn("td[field-key='avg_investment']", $income_expense_calculator->avg_investment)
                ->assertSeeIn("td[field-key='depreciation']", $income_expense_calculator->depreciation)
                ->assertSeeIn("td[field-key='insurance']", $income_expense_calculator->insurance)
                ->assertSeeIn("td[field-key='license']", $income_expense_calculator->license)
                ->assertSeeIn("td[field-key='fuel_price']", $income_expense_calculator->fuel_price)
                ->assertSeeIn("td[field-key='fuel_usage']", $income_expense_calculator->fuel_usage)
                ->assertSeeIn("td[field-key='fuel']", $income_expense_calculator->fuel)
                ->assertSeeIn("td[field-key='fuel_consumption']", $income_expense_calculator->fuel_consumption)
                ->assertSeeIn("td[field-key='oil_price']", $income_expense_calculator->oil_price)
                ->assertSeeIn("td[field-key='oil_usage']", $income_expense_calculator->oil_usage)
                ->assertSeeIn("td[field-key='oil']", $income_expense_calculator->oil)
                ->assertSeeIn("td[field-key='oil_consumption']", $income_expense_calculator->oil_consumption)
                ->assertSeeIn("td[field-key='tyre_price']", $income_expense_calculator->tyre_price)
                ->assertSeeIn("td[field-key='number_of_tyres']", $income_expense_calculator->number_of_tyres)
                ->assertSeeIn("td[field-key='tyre']", $income_expense_calculator->tyre)
                ->assertSeeIn("td[field-key='repair_maintenance']", $income_expense_calculator->repair_maintenance)
                ->assertSeeIn("td[field-key='contigency_factor']", $income_expense_calculator->contigency_factor)
                ->assertSeeIn("td[field-key='trip_income']", $income_expense_calculator->trip_income)
                ->assertSeeIn("td[field-key='other_costs']", $income_expense_calculator->other_costs)
                ->assertSeeIn("td[field-key='total_costs']", $income_expense_calculator->total_costs)
                ->assertSeeIn("td[field-key='balance']", $income_expense_calculator->balance)
                ->logout();
        });
    }

}
