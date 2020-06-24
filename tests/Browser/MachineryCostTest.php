<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class MachineryCostTest extends DuskTestCase
{

    public function testCreateMachineryCost()
    {
        $admin = \App\User::find(1);
        $machinery_cost = factory('App\MachineryCost')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $machinery_cost) {
            $browser->loginAs($admin)
                ->visit(route('admin.machinery_costs.index'))
                ->clickLink('Add new')
                ->select("road_freight_number_id", $machinery_cost->road_freight_number_id)
                ->select("route_id", $machinery_cost->route_id)
                ->type("distance", $machinery_cost->distance)
                ->select("load_status", $machinery_cost->load_status)
                ->select("truck_attachment_status_id", $machinery_cost->truck_attachment_status_id)
                ->select("machinery_attachment_type_id", $machinery_cost->machinery_attachment_type_id)
                ->select("size_id", $machinery_cost->size_id)
                ->select("vehicle_description_id", $machinery_cost->vehicle_description_id)
                ->type("purchase_price", $machinery_cost->purchase_price)
                ->type("salvage_value", $machinery_cost->salvage_value)
                ->type("avg_investment", $machinery_cost->avg_investment)
                ->type("depreciation", $machinery_cost->depreciation)
                ->type("insurance", $machinery_cost->insurance)
                ->type("license", $machinery_cost->license)
                ->type("fuel_price", $machinery_cost->fuel_price)
                ->type("fuel_usage", $machinery_cost->fuel_usage)
                ->type("fuel", $machinery_cost->fuel)
                ->type("fuel_consumption", $machinery_cost->fuel_consumption)
                ->type("oil_price", $machinery_cost->oil_price)
                ->type("oil_usage", $machinery_cost->oil_usage)
                ->type("oil", $machinery_cost->oil)
                ->type("oil_consumption", $machinery_cost->oil_consumption)
                ->type("number_of_tyres", $machinery_cost->number_of_tyres)
                ->type("tyre_price", $machinery_cost->tyre_price)
                ->type("tyre", $machinery_cost->tyre)
                ->type("repair_maintenance", $machinery_cost->repair_maintenance)
                ->type("contigency_factor", $machinery_cost->contigency_factor)
                ->type("total_costs", $machinery_cost->total_costs)
                ->select("attachment_type", $machinery_cost->attachment_type)
                ->press('Save')
                ->assertRouteIs('admin.machinery_costs.index')
                ->assertSeeIn("tr:last-child td[field-key='road_freight_number']", $machinery_cost->road_freight_number->road_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='route']", $machinery_cost->route->route)
                ->assertSeeIn("tr:last-child td[field-key='distance']", $machinery_cost->distance)
                ->assertSeeIn("tr:last-child td[field-key='load_status']", $machinery_cost->load_status)
                ->assertSeeIn("tr:last-child td[field-key='truck_attachment_status']", $machinery_cost->truck_attachment_status->attachment)
                ->assertSeeIn("tr:last-child td[field-key='machinery_attachment_type']", $machinery_cost->machinery_attachment_type->machinery_type)
                ->assertSeeIn("tr:last-child td[field-key='size']", $machinery_cost->size->size)
                ->assertSeeIn("tr:last-child td[field-key='vehicle_description']", $machinery_cost->vehicle_description->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='purchase_price']", $machinery_cost->purchase_price)
                ->assertSeeIn("tr:last-child td[field-key='salvage_value']", $machinery_cost->salvage_value)
                ->assertSeeIn("tr:last-child td[field-key='avg_investment']", $machinery_cost->avg_investment)
                ->assertSeeIn("tr:last-child td[field-key='depreciation']", $machinery_cost->depreciation)
                ->assertSeeIn("tr:last-child td[field-key='insurance']", $machinery_cost->insurance)
                ->assertSeeIn("tr:last-child td[field-key='license']", $machinery_cost->license)
                ->assertSeeIn("tr:last-child td[field-key='fuel_price']", $machinery_cost->fuel_price)
                ->assertSeeIn("tr:last-child td[field-key='fuel_usage']", $machinery_cost->fuel_usage)
                ->assertSeeIn("tr:last-child td[field-key='fuel']", $machinery_cost->fuel)
                ->assertSeeIn("tr:last-child td[field-key='fuel_consumption']", $machinery_cost->fuel_consumption)
                ->assertSeeIn("tr:last-child td[field-key='oil_price']", $machinery_cost->oil_price)
                ->assertSeeIn("tr:last-child td[field-key='oil_usage']", $machinery_cost->oil_usage)
                ->assertSeeIn("tr:last-child td[field-key='oil']", $machinery_cost->oil)
                ->assertSeeIn("tr:last-child td[field-key='oil_consumption']", $machinery_cost->oil_consumption)
                ->assertSeeIn("tr:last-child td[field-key='number_of_tyres']", $machinery_cost->number_of_tyres)
                ->assertSeeIn("tr:last-child td[field-key='tyre_price']", $machinery_cost->tyre_price)
                ->assertSeeIn("tr:last-child td[field-key='tyre']", $machinery_cost->tyre)
                ->assertSeeIn("tr:last-child td[field-key='repair_maintenance']", $machinery_cost->repair_maintenance)
                ->assertSeeIn("tr:last-child td[field-key='contigency_factor']", $machinery_cost->contigency_factor)
                ->assertSeeIn("tr:last-child td[field-key='total_costs']", $machinery_cost->total_costs)
                ->assertSeeIn("tr:last-child td[field-key='attachment_type']", $machinery_cost->attachment_type)
                ->logout();
        });
    }

    public function testEditMachineryCost()
    {
        $admin = \App\User::find(1);
        $machinery_cost = factory('App\MachineryCost')->create();
        $machinery_cost2 = factory('App\MachineryCost')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $machinery_cost, $machinery_cost2) {
            $browser->loginAs($admin)
                ->visit(route('admin.machinery_costs.index'))
                ->click('tr[data-entry-id="' . $machinery_cost->id . '"] .btn-info')
                ->select("road_freight_number_id", $machinery_cost2->road_freight_number_id)
                ->select("route_id", $machinery_cost2->route_id)
                ->type("distance", $machinery_cost2->distance)
                ->select("load_status", $machinery_cost2->load_status)
                ->select("truck_attachment_status_id", $machinery_cost2->truck_attachment_status_id)
                ->select("machinery_attachment_type_id", $machinery_cost2->machinery_attachment_type_id)
                ->select("size_id", $machinery_cost2->size_id)
                ->select("vehicle_description_id", $machinery_cost2->vehicle_description_id)
                ->type("purchase_price", $machinery_cost2->purchase_price)
                ->type("salvage_value", $machinery_cost2->salvage_value)
                ->type("avg_investment", $machinery_cost2->avg_investment)
                ->type("depreciation", $machinery_cost2->depreciation)
                ->type("insurance", $machinery_cost2->insurance)
                ->type("license", $machinery_cost2->license)
                ->type("fuel_price", $machinery_cost2->fuel_price)
                ->type("fuel_usage", $machinery_cost2->fuel_usage)
                ->type("fuel", $machinery_cost2->fuel)
                ->type("fuel_consumption", $machinery_cost2->fuel_consumption)
                ->type("oil_price", $machinery_cost2->oil_price)
                ->type("oil_usage", $machinery_cost2->oil_usage)
                ->type("oil", $machinery_cost2->oil)
                ->type("oil_consumption", $machinery_cost2->oil_consumption)
                ->type("number_of_tyres", $machinery_cost2->number_of_tyres)
                ->type("tyre_price", $machinery_cost2->tyre_price)
                ->type("tyre", $machinery_cost2->tyre)
                ->type("repair_maintenance", $machinery_cost2->repair_maintenance)
                ->type("contigency_factor", $machinery_cost2->contigency_factor)
                ->type("total_costs", $machinery_cost2->total_costs)
                ->select("attachment_type", $machinery_cost2->attachment_type)
                ->press('Update')
                ->assertRouteIs('admin.machinery_costs.index')
                ->assertSeeIn("tr:last-child td[field-key='road_freight_number']", $machinery_cost2->road_freight_number->road_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='route']", $machinery_cost2->route->route)
                ->assertSeeIn("tr:last-child td[field-key='distance']", $machinery_cost2->distance)
                ->assertSeeIn("tr:last-child td[field-key='load_status']", $machinery_cost2->load_status)
                ->assertSeeIn("tr:last-child td[field-key='truck_attachment_status']", $machinery_cost2->truck_attachment_status->attachment)
                ->assertSeeIn("tr:last-child td[field-key='machinery_attachment_type']", $machinery_cost2->machinery_attachment_type->machinery_type)
                ->assertSeeIn("tr:last-child td[field-key='size']", $machinery_cost2->size->size)
                ->assertSeeIn("tr:last-child td[field-key='vehicle_description']", $machinery_cost2->vehicle_description->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='purchase_price']", $machinery_cost2->purchase_price)
                ->assertSeeIn("tr:last-child td[field-key='salvage_value']", $machinery_cost2->salvage_value)
                ->assertSeeIn("tr:last-child td[field-key='avg_investment']", $machinery_cost2->avg_investment)
                ->assertSeeIn("tr:last-child td[field-key='depreciation']", $machinery_cost2->depreciation)
                ->assertSeeIn("tr:last-child td[field-key='insurance']", $machinery_cost2->insurance)
                ->assertSeeIn("tr:last-child td[field-key='license']", $machinery_cost2->license)
                ->assertSeeIn("tr:last-child td[field-key='fuel_price']", $machinery_cost2->fuel_price)
                ->assertSeeIn("tr:last-child td[field-key='fuel_usage']", $machinery_cost2->fuel_usage)
                ->assertSeeIn("tr:last-child td[field-key='fuel']", $machinery_cost2->fuel)
                ->assertSeeIn("tr:last-child td[field-key='fuel_consumption']", $machinery_cost2->fuel_consumption)
                ->assertSeeIn("tr:last-child td[field-key='oil_price']", $machinery_cost2->oil_price)
                ->assertSeeIn("tr:last-child td[field-key='oil_usage']", $machinery_cost2->oil_usage)
                ->assertSeeIn("tr:last-child td[field-key='oil']", $machinery_cost2->oil)
                ->assertSeeIn("tr:last-child td[field-key='oil_consumption']", $machinery_cost2->oil_consumption)
                ->assertSeeIn("tr:last-child td[field-key='number_of_tyres']", $machinery_cost2->number_of_tyres)
                ->assertSeeIn("tr:last-child td[field-key='tyre_price']", $machinery_cost2->tyre_price)
                ->assertSeeIn("tr:last-child td[field-key='tyre']", $machinery_cost2->tyre)
                ->assertSeeIn("tr:last-child td[field-key='repair_maintenance']", $machinery_cost2->repair_maintenance)
                ->assertSeeIn("tr:last-child td[field-key='contigency_factor']", $machinery_cost2->contigency_factor)
                ->assertSeeIn("tr:last-child td[field-key='total_costs']", $machinery_cost2->total_costs)
                ->assertSeeIn("tr:last-child td[field-key='attachment_type']", $machinery_cost2->attachment_type)
                ->logout();
        });
    }

    public function testShowMachineryCost()
    {
        $admin = \App\User::find(1);
        $machinery_cost = factory('App\MachineryCost')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $machinery_cost) {
            $browser->loginAs($admin)
                ->visit(route('admin.machinery_costs.index'))
                ->click('tr[data-entry-id="' . $machinery_cost->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='road_freight_number']", $machinery_cost->road_freight_number->road_freight_number)
                ->assertSeeIn("td[field-key='route']", $machinery_cost->route->route)
                ->assertSeeIn("td[field-key='distance']", $machinery_cost->distance)
                ->assertSeeIn("td[field-key='load_status']", $machinery_cost->load_status)
                ->assertSeeIn("td[field-key='truck_attachment_status']", $machinery_cost->truck_attachment_status->attachment)
                ->assertSeeIn("td[field-key='machinery_attachment_type']", $machinery_cost->machinery_attachment_type->machinery_type)
                ->assertSeeIn("td[field-key='size']", $machinery_cost->size->size)
                ->assertSeeIn("td[field-key='vehicle_description']", $machinery_cost->vehicle_description->vehicle_description)
                ->assertSeeIn("td[field-key='purchase_price']", $machinery_cost->purchase_price)
                ->assertSeeIn("td[field-key='salvage_value']", $machinery_cost->salvage_value)
                ->assertSeeIn("td[field-key='avg_investment']", $machinery_cost->avg_investment)
                ->assertSeeIn("td[field-key='depreciation']", $machinery_cost->depreciation)
                ->assertSeeIn("td[field-key='insurance']", $machinery_cost->insurance)
                ->assertSeeIn("td[field-key='license']", $machinery_cost->license)
                ->assertSeeIn("td[field-key='fuel_price']", $machinery_cost->fuel_price)
                ->assertSeeIn("td[field-key='fuel_usage']", $machinery_cost->fuel_usage)
                ->assertSeeIn("td[field-key='fuel']", $machinery_cost->fuel)
                ->assertSeeIn("td[field-key='fuel_consumption']", $machinery_cost->fuel_consumption)
                ->assertSeeIn("td[field-key='oil_price']", $machinery_cost->oil_price)
                ->assertSeeIn("td[field-key='oil_usage']", $machinery_cost->oil_usage)
                ->assertSeeIn("td[field-key='oil']", $machinery_cost->oil)
                ->assertSeeIn("td[field-key='oil_consumption']", $machinery_cost->oil_consumption)
                ->assertSeeIn("td[field-key='number_of_tyres']", $machinery_cost->number_of_tyres)
                ->assertSeeIn("td[field-key='tyre_price']", $machinery_cost->tyre_price)
                ->assertSeeIn("td[field-key='tyre']", $machinery_cost->tyre)
                ->assertSeeIn("td[field-key='repair_maintenance']", $machinery_cost->repair_maintenance)
                ->assertSeeIn("td[field-key='contigency_factor']", $machinery_cost->contigency_factor)
                ->assertSeeIn("td[field-key='total_costs']", $machinery_cost->total_costs)
                ->assertSeeIn("td[field-key='attachment_type']", $machinery_cost->attachment_type)
                ->logout();
        });
    }

}
