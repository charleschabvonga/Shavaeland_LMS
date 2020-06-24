<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class VehicleTest extends DuskTestCase
{

    public function testCreateVehicle()
    {
        $admin = \App\User::find(1);
        $vehicle = factory('App\Vehicle')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $vehicle) {
            $browser->loginAs($admin)
                ->visit(route('admin.vehicles.index'))
                ->clickLink('Add new')
                ->type("vehicle_description", $vehicle->vehicle_description)
                ->type("make", $vehicle->make)
                ->type("model", $vehicle->model)
                ->type("purchase_date", $vehicle->purchase_date)
                ->type("purchase_price", $vehicle->purchase_price)
                ->type("chasis_number", $vehicle->chasis_number)
                ->type("engine_number", $vehicle->engine_number)
                ->select("size_id", $vehicle->size_id)
                ->type("starting_mileage", $vehicle->starting_mileage)
                ->type("next_service_mileage", $vehicle->next_service_mileage)
                ->type("next_service_date", $vehicle->next_service_date)
                ->select("service_status", $vehicle->service_status)
                ->select("availability", $vehicle->availability)
                ->type("salvage_value", $vehicle->salvage_value)
                ->type("investment", $vehicle->investment)
                ->type("depreciation", $vehicle->depreciation)
                ->type("maintenance", $vehicle->maintenance)
                ->type("tyre", $vehicle->tyre)
                ->press('Save')
                ->assertRouteIs('admin.vehicles.index')
                ->assertSeeIn("tr:last-child td[field-key='vehicle_description']", $vehicle->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='make']", $vehicle->make)
                ->assertSeeIn("tr:last-child td[field-key='model']", $vehicle->model)
                ->assertSeeIn("tr:last-child td[field-key='purchase_date']", $vehicle->purchase_date)
                ->assertSeeIn("tr:last-child td[field-key='purchase_price']", $vehicle->purchase_price)
                ->assertSeeIn("tr:last-child td[field-key='chasis_number']", $vehicle->chasis_number)
                ->assertSeeIn("tr:last-child td[field-key='engine_number']", $vehicle->engine_number)
                ->assertSeeIn("tr:last-child td[field-key='size']", $vehicle->size->size)
                ->assertSeeIn("tr:last-child td[field-key='starting_mileage']", $vehicle->starting_mileage)
                ->assertSeeIn("tr:last-child td[field-key='next_service_mileage']", $vehicle->next_service_mileage)
                ->assertSeeIn("tr:last-child td[field-key='next_service_date']", $vehicle->next_service_date)
                ->assertSeeIn("tr:last-child td[field-key='service_status']", $vehicle->service_status)
                ->assertSeeIn("tr:last-child td[field-key='availability']", $vehicle->availability)
                ->assertSeeIn("tr:last-child td[field-key='salvage_value']", $vehicle->salvage_value)
                ->assertSeeIn("tr:last-child td[field-key='investment']", $vehicle->investment)
                ->assertSeeIn("tr:last-child td[field-key='depreciation']", $vehicle->depreciation)
                ->assertSeeIn("tr:last-child td[field-key='maintenance']", $vehicle->maintenance)
                ->assertSeeIn("tr:last-child td[field-key='tyre']", $vehicle->tyre)
                ->logout();
        });
    }

    public function testEditVehicle()
    {
        $admin = \App\User::find(1);
        $vehicle = factory('App\Vehicle')->create();
        $vehicle2 = factory('App\Vehicle')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $vehicle, $vehicle2) {
            $browser->loginAs($admin)
                ->visit(route('admin.vehicles.index'))
                ->click('tr[data-entry-id="' . $vehicle->id . '"] .btn-info')
                ->type("vehicle_description", $vehicle2->vehicle_description)
                ->type("make", $vehicle2->make)
                ->type("model", $vehicle2->model)
                ->type("purchase_date", $vehicle2->purchase_date)
                ->type("purchase_price", $vehicle2->purchase_price)
                ->type("chasis_number", $vehicle2->chasis_number)
                ->type("engine_number", $vehicle2->engine_number)
                ->select("size_id", $vehicle2->size_id)
                ->type("starting_mileage", $vehicle2->starting_mileage)
                ->type("next_service_mileage", $vehicle2->next_service_mileage)
                ->type("next_service_date", $vehicle2->next_service_date)
                ->select("service_status", $vehicle2->service_status)
                ->select("availability", $vehicle2->availability)
                ->type("salvage_value", $vehicle2->salvage_value)
                ->type("investment", $vehicle2->investment)
                ->type("depreciation", $vehicle2->depreciation)
                ->type("maintenance", $vehicle2->maintenance)
                ->type("tyre", $vehicle2->tyre)
                ->press('Update')
                ->assertRouteIs('admin.vehicles.index')
                ->assertSeeIn("tr:last-child td[field-key='vehicle_description']", $vehicle2->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='make']", $vehicle2->make)
                ->assertSeeIn("tr:last-child td[field-key='model']", $vehicle2->model)
                ->assertSeeIn("tr:last-child td[field-key='purchase_date']", $vehicle2->purchase_date)
                ->assertSeeIn("tr:last-child td[field-key='purchase_price']", $vehicle2->purchase_price)
                ->assertSeeIn("tr:last-child td[field-key='chasis_number']", $vehicle2->chasis_number)
                ->assertSeeIn("tr:last-child td[field-key='engine_number']", $vehicle2->engine_number)
                ->assertSeeIn("tr:last-child td[field-key='size']", $vehicle2->size->size)
                ->assertSeeIn("tr:last-child td[field-key='starting_mileage']", $vehicle2->starting_mileage)
                ->assertSeeIn("tr:last-child td[field-key='next_service_mileage']", $vehicle2->next_service_mileage)
                ->assertSeeIn("tr:last-child td[field-key='next_service_date']", $vehicle2->next_service_date)
                ->assertSeeIn("tr:last-child td[field-key='service_status']", $vehicle2->service_status)
                ->assertSeeIn("tr:last-child td[field-key='availability']", $vehicle2->availability)
                ->assertSeeIn("tr:last-child td[field-key='salvage_value']", $vehicle2->salvage_value)
                ->assertSeeIn("tr:last-child td[field-key='investment']", $vehicle2->investment)
                ->assertSeeIn("tr:last-child td[field-key='depreciation']", $vehicle2->depreciation)
                ->assertSeeIn("tr:last-child td[field-key='maintenance']", $vehicle2->maintenance)
                ->assertSeeIn("tr:last-child td[field-key='tyre']", $vehicle2->tyre)
                ->logout();
        });
    }

    public function testShowVehicle()
    {
        $admin = \App\User::find(1);
        $vehicle = factory('App\Vehicle')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $vehicle) {
            $browser->loginAs($admin)
                ->visit(route('admin.vehicles.index'))
                ->click('tr[data-entry-id="' . $vehicle->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='vehicle_description']", $vehicle->vehicle_description)
                ->assertSeeIn("td[field-key='make']", $vehicle->make)
                ->assertSeeIn("td[field-key='model']", $vehicle->model)
                ->assertSeeIn("td[field-key='purchase_date']", $vehicle->purchase_date)
                ->assertSeeIn("td[field-key='purchase_price']", $vehicle->purchase_price)
                ->assertSeeIn("td[field-key='chasis_number']", $vehicle->chasis_number)
                ->assertSeeIn("td[field-key='engine_number']", $vehicle->engine_number)
                ->assertSeeIn("td[field-key='size']", $vehicle->size->size)
                ->assertSeeIn("td[field-key='starting_mileage']", $vehicle->starting_mileage)
                ->assertSeeIn("td[field-key='next_service_mileage']", $vehicle->next_service_mileage)
                ->assertSeeIn("td[field-key='next_service_date']", $vehicle->next_service_date)
                ->assertSeeIn("td[field-key='service_status']", $vehicle->service_status)
                ->assertSeeIn("td[field-key='availability']", $vehicle->availability)
                ->assertSeeIn("td[field-key='salvage_value']", $vehicle->salvage_value)
                ->assertSeeIn("td[field-key='investment']", $vehicle->investment)
                ->assertSeeIn("td[field-key='depreciation']", $vehicle->depreciation)
                ->assertSeeIn("td[field-key='maintenance']", $vehicle->maintenance)
                ->assertSeeIn("td[field-key='tyre']", $vehicle->tyre)
                ->logout();
        });
    }

}
