<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ClientVehicleTest extends DuskTestCase
{

    public function testCreateClientVehicle()
    {
        $admin = \App\User::find(1);
        $client_vehicle = factory('App\ClientVehicle')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_vehicle) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_vehicles.index'))
                ->clickLink('Add new')
                ->select("client_id", $client_vehicle->client_id)
                ->type("registration_number", $client_vehicle->registration_number)
                ->select("vehicle_type", $client_vehicle->vehicle_type)
                ->type("make", $client_vehicle->make)
                ->type("model", $client_vehicle->model)
                ->type("starting_mileage", $client_vehicle->starting_mileage)
                ->type("next_service_mileage", $client_vehicle->next_service_mileage)
                ->type("next_service_date", $client_vehicle->next_service_date)
                ->select("status", $client_vehicle->status)
                ->press('Save')
                ->assertRouteIs('admin.client_vehicles.index')
                ->assertSeeIn("tr:last-child td[field-key='client']", $client_vehicle->client->name)
                ->assertSeeIn("tr:last-child td[field-key='registration_number']", $client_vehicle->registration_number)
                ->assertSeeIn("tr:last-child td[field-key='vehicle_type']", $client_vehicle->vehicle_type)
                ->assertSeeIn("tr:last-child td[field-key='make']", $client_vehicle->make)
                ->assertSeeIn("tr:last-child td[field-key='model']", $client_vehicle->model)
                ->assertSeeIn("tr:last-child td[field-key='starting_mileage']", $client_vehicle->starting_mileage)
                ->assertSeeIn("tr:last-child td[field-key='next_service_mileage']", $client_vehicle->next_service_mileage)
                ->assertSeeIn("tr:last-child td[field-key='next_service_date']", $client_vehicle->next_service_date)
                ->assertSeeIn("tr:last-child td[field-key='status']", $client_vehicle->status)
                ->logout();
        });
    }

    public function testEditClientVehicle()
    {
        $admin = \App\User::find(1);
        $client_vehicle = factory('App\ClientVehicle')->create();
        $client_vehicle2 = factory('App\ClientVehicle')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_vehicle, $client_vehicle2) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_vehicles.index'))
                ->click('tr[data-entry-id="' . $client_vehicle->id . '"] .btn-info')
                ->select("client_id", $client_vehicle2->client_id)
                ->type("registration_number", $client_vehicle2->registration_number)
                ->select("vehicle_type", $client_vehicle2->vehicle_type)
                ->type("make", $client_vehicle2->make)
                ->type("model", $client_vehicle2->model)
                ->type("starting_mileage", $client_vehicle2->starting_mileage)
                ->type("next_service_mileage", $client_vehicle2->next_service_mileage)
                ->type("next_service_date", $client_vehicle2->next_service_date)
                ->select("status", $client_vehicle2->status)
                ->press('Update')
                ->assertRouteIs('admin.client_vehicles.index')
                ->assertSeeIn("tr:last-child td[field-key='client']", $client_vehicle2->client->name)
                ->assertSeeIn("tr:last-child td[field-key='registration_number']", $client_vehicle2->registration_number)
                ->assertSeeIn("tr:last-child td[field-key='vehicle_type']", $client_vehicle2->vehicle_type)
                ->assertSeeIn("tr:last-child td[field-key='make']", $client_vehicle2->make)
                ->assertSeeIn("tr:last-child td[field-key='model']", $client_vehicle2->model)
                ->assertSeeIn("tr:last-child td[field-key='starting_mileage']", $client_vehicle2->starting_mileage)
                ->assertSeeIn("tr:last-child td[field-key='next_service_mileage']", $client_vehicle2->next_service_mileage)
                ->assertSeeIn("tr:last-child td[field-key='next_service_date']", $client_vehicle2->next_service_date)
                ->assertSeeIn("tr:last-child td[field-key='status']", $client_vehicle2->status)
                ->logout();
        });
    }

    public function testShowClientVehicle()
    {
        $admin = \App\User::find(1);
        $client_vehicle = factory('App\ClientVehicle')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $client_vehicle) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_vehicles.index'))
                ->click('tr[data-entry-id="' . $client_vehicle->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='client']", $client_vehicle->client->name)
                ->assertSeeIn("td[field-key='registration_number']", $client_vehicle->registration_number)
                ->assertSeeIn("td[field-key='vehicle_type']", $client_vehicle->vehicle_type)
                ->assertSeeIn("td[field-key='make']", $client_vehicle->make)
                ->assertSeeIn("td[field-key='model']", $client_vehicle->model)
                ->assertSeeIn("td[field-key='starting_mileage']", $client_vehicle->starting_mileage)
                ->assertSeeIn("td[field-key='next_service_mileage']", $client_vehicle->next_service_mileage)
                ->assertSeeIn("td[field-key='next_service_date']", $client_vehicle->next_service_date)
                ->assertSeeIn("td[field-key='status']", $client_vehicle->status)
                ->logout();
        });
    }

}
