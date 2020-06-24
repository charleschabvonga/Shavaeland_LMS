<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class LightVehicleTest extends DuskTestCase
{

    public function testCreateLightVehicle()
    {
        $admin = \App\User::find(1);
        $light_vehicle = factory('App\LightVehicle')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $light_vehicle) {
            $browser->loginAs($admin)
                ->visit(route('admin.light_vehicles.index'))
                ->clickLink('Add new')
                ->select("vehicle_type", $light_vehicle->vehicle_type)
                ->type("vehicle_description", $light_vehicle->vehicle_description)
                ->type("make", $light_vehicle->make)
                ->type("model", $light_vehicle->model)
                ->type("purchase_date", $light_vehicle->purchase_date)
                ->type("purchase_price", $light_vehicle->purchase_price)
                ->type("chasis_number", $light_vehicle->chasis_number)
                ->type("engine_number", $light_vehicle->engine_number)
                ->select("size_id", $light_vehicle->size_id)
                ->type("starting_mileage", $light_vehicle->starting_mileage)
                ->type("next_service_mileage", $light_vehicle->next_service_mileage)
                ->type("next_service_date", $light_vehicle->next_service_date)
                ->select("service_status", $light_vehicle->service_status)
                ->select("availability", $light_vehicle->availability)
                ->type("salvage_value", $light_vehicle->salvage_value)
                ->type("investment", $light_vehicle->investment)
                ->type("depreciation", $light_vehicle->depreciation)
                ->type("maintenance", $light_vehicle->maintenance)
                ->type("tyre", $light_vehicle->tyre)
                ->press('Save')
                ->assertRouteIs('admin.light_vehicles.index')
                ->assertSeeIn("tr:last-child td[field-key='vehicle_type']", $light_vehicle->vehicle_type)
                ->assertSeeIn("tr:last-child td[field-key='vehicle_description']", $light_vehicle->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='make']", $light_vehicle->make)
                ->assertSeeIn("tr:last-child td[field-key='model']", $light_vehicle->model)
                ->assertSeeIn("tr:last-child td[field-key='purchase_date']", $light_vehicle->purchase_date)
                ->assertSeeIn("tr:last-child td[field-key='purchase_price']", $light_vehicle->purchase_price)
                ->assertSeeIn("tr:last-child td[field-key='chasis_number']", $light_vehicle->chasis_number)
                ->assertSeeIn("tr:last-child td[field-key='engine_number']", $light_vehicle->engine_number)
                ->assertSeeIn("tr:last-child td[field-key='size']", $light_vehicle->size->size)
                ->assertSeeIn("tr:last-child td[field-key='starting_mileage']", $light_vehicle->starting_mileage)
                ->assertSeeIn("tr:last-child td[field-key='next_service_mileage']", $light_vehicle->next_service_mileage)
                ->assertSeeIn("tr:last-child td[field-key='next_service_date']", $light_vehicle->next_service_date)
                ->assertSeeIn("tr:last-child td[field-key='service_status']", $light_vehicle->service_status)
                ->assertSeeIn("tr:last-child td[field-key='availability']", $light_vehicle->availability)
                ->assertSeeIn("tr:last-child td[field-key='salvage_value']", $light_vehicle->salvage_value)
                ->assertSeeIn("tr:last-child td[field-key='investment']", $light_vehicle->investment)
                ->assertSeeIn("tr:last-child td[field-key='depreciation']", $light_vehicle->depreciation)
                ->assertSeeIn("tr:last-child td[field-key='maintenance']", $light_vehicle->maintenance)
                ->assertSeeIn("tr:last-child td[field-key='tyre']", $light_vehicle->tyre)
                ->logout();
        });
    }

    public function testEditLightVehicle()
    {
        $admin = \App\User::find(1);
        $light_vehicle = factory('App\LightVehicle')->create();
        $light_vehicle2 = factory('App\LightVehicle')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $light_vehicle, $light_vehicle2) {
            $browser->loginAs($admin)
                ->visit(route('admin.light_vehicles.index'))
                ->click('tr[data-entry-id="' . $light_vehicle->id . '"] .btn-info')
                ->select("vehicle_type", $light_vehicle2->vehicle_type)
                ->type("vehicle_description", $light_vehicle2->vehicle_description)
                ->type("make", $light_vehicle2->make)
                ->type("model", $light_vehicle2->model)
                ->type("purchase_date", $light_vehicle2->purchase_date)
                ->type("purchase_price", $light_vehicle2->purchase_price)
                ->type("chasis_number", $light_vehicle2->chasis_number)
                ->type("engine_number", $light_vehicle2->engine_number)
                ->select("size_id", $light_vehicle2->size_id)
                ->type("starting_mileage", $light_vehicle2->starting_mileage)
                ->type("next_service_mileage", $light_vehicle2->next_service_mileage)
                ->type("next_service_date", $light_vehicle2->next_service_date)
                ->select("service_status", $light_vehicle2->service_status)
                ->select("availability", $light_vehicle2->availability)
                ->type("salvage_value", $light_vehicle2->salvage_value)
                ->type("investment", $light_vehicle2->investment)
                ->type("depreciation", $light_vehicle2->depreciation)
                ->type("maintenance", $light_vehicle2->maintenance)
                ->type("tyre", $light_vehicle2->tyre)
                ->press('Update')
                ->assertRouteIs('admin.light_vehicles.index')
                ->assertSeeIn("tr:last-child td[field-key='vehicle_type']", $light_vehicle2->vehicle_type)
                ->assertSeeIn("tr:last-child td[field-key='vehicle_description']", $light_vehicle2->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='make']", $light_vehicle2->make)
                ->assertSeeIn("tr:last-child td[field-key='model']", $light_vehicle2->model)
                ->assertSeeIn("tr:last-child td[field-key='purchase_date']", $light_vehicle2->purchase_date)
                ->assertSeeIn("tr:last-child td[field-key='purchase_price']", $light_vehicle2->purchase_price)
                ->assertSeeIn("tr:last-child td[field-key='chasis_number']", $light_vehicle2->chasis_number)
                ->assertSeeIn("tr:last-child td[field-key='engine_number']", $light_vehicle2->engine_number)
                ->assertSeeIn("tr:last-child td[field-key='size']", $light_vehicle2->size->size)
                ->assertSeeIn("tr:last-child td[field-key='starting_mileage']", $light_vehicle2->starting_mileage)
                ->assertSeeIn("tr:last-child td[field-key='next_service_mileage']", $light_vehicle2->next_service_mileage)
                ->assertSeeIn("tr:last-child td[field-key='next_service_date']", $light_vehicle2->next_service_date)
                ->assertSeeIn("tr:last-child td[field-key='service_status']", $light_vehicle2->service_status)
                ->assertSeeIn("tr:last-child td[field-key='availability']", $light_vehicle2->availability)
                ->assertSeeIn("tr:last-child td[field-key='salvage_value']", $light_vehicle2->salvage_value)
                ->assertSeeIn("tr:last-child td[field-key='investment']", $light_vehicle2->investment)
                ->assertSeeIn("tr:last-child td[field-key='depreciation']", $light_vehicle2->depreciation)
                ->assertSeeIn("tr:last-child td[field-key='maintenance']", $light_vehicle2->maintenance)
                ->assertSeeIn("tr:last-child td[field-key='tyre']", $light_vehicle2->tyre)
                ->logout();
        });
    }

    public function testShowLightVehicle()
    {
        $admin = \App\User::find(1);
        $light_vehicle = factory('App\LightVehicle')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $light_vehicle) {
            $browser->loginAs($admin)
                ->visit(route('admin.light_vehicles.index'))
                ->click('tr[data-entry-id="' . $light_vehicle->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='vehicle_type']", $light_vehicle->vehicle_type)
                ->assertSeeIn("td[field-key='vehicle_description']", $light_vehicle->vehicle_description)
                ->assertSeeIn("td[field-key='make']", $light_vehicle->make)
                ->assertSeeIn("td[field-key='model']", $light_vehicle->model)
                ->assertSeeIn("td[field-key='purchase_date']", $light_vehicle->purchase_date)
                ->assertSeeIn("td[field-key='purchase_price']", $light_vehicle->purchase_price)
                ->assertSeeIn("td[field-key='chasis_number']", $light_vehicle->chasis_number)
                ->assertSeeIn("td[field-key='engine_number']", $light_vehicle->engine_number)
                ->assertSeeIn("td[field-key='size']", $light_vehicle->size->size)
                ->assertSeeIn("td[field-key='starting_mileage']", $light_vehicle->starting_mileage)
                ->assertSeeIn("td[field-key='next_service_mileage']", $light_vehicle->next_service_mileage)
                ->assertSeeIn("td[field-key='next_service_date']", $light_vehicle->next_service_date)
                ->assertSeeIn("td[field-key='service_status']", $light_vehicle->service_status)
                ->assertSeeIn("td[field-key='availability']", $light_vehicle->availability)
                ->assertSeeIn("td[field-key='salvage_value']", $light_vehicle->salvage_value)
                ->assertSeeIn("td[field-key='investment']", $light_vehicle->investment)
                ->assertSeeIn("td[field-key='depreciation']", $light_vehicle->depreciation)
                ->assertSeeIn("td[field-key='maintenance']", $light_vehicle->maintenance)
                ->assertSeeIn("td[field-key='tyre']", $light_vehicle->tyre)
                ->logout();
        });
    }

}
