<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class VehicleScTest extends DuskTestCase
{

    public function testCreateVehicleSc()
    {
        $admin = \App\User::find(1);
        $vehicle_sc = factory('App\VehicleSc')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $vehicle_sc) {
            $browser->loginAs($admin)
                ->visit(route('admin.vehicle_scs.index'))
                ->clickLink('Add new')
                ->select("vendor_id", $vehicle_sc->vendor_id)
                ->select("subcontractor_number_id", $vehicle_sc->subcontractor_number_id)
                ->select("vehicle_type", $vehicle_sc->vehicle_type)
                ->type("make", $vehicle_sc->make)
                ->type("model", $vehicle_sc->model)
                ->type("registration_number", $vehicle_sc->registration_number)
                ->attach("certificate_of_registration", base_path("tests/_resources/test.jpg"))
                ->type("certificate_of_fitness_number", $vehicle_sc->certificate_of_fitness_number)
                ->attach("certificate_of_fitness", base_path("tests/_resources/test.jpg"))
                ->type("tracker_pin_details", $vehicle_sc->tracker_pin_details)
                ->type("tracker_password", $vehicle_sc->tracker_password)
                ->type("expiration_date", $vehicle_sc->expiration_date)
                ->attach("service_history_reports", base_path("tests/_resources/test.jpg"))
                ->select("status", $vehicle_sc->status)
                ->press('Save')
                ->assertRouteIs('admin.vehicle_scs.index')
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $vehicle_sc->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='subcontractor_number']", $vehicle_sc->subcontractor_number->subcontractor_number)
                ->assertSeeIn("tr:last-child td[field-key='vehicle_type']", $vehicle_sc->vehicle_type)
                ->assertSeeIn("tr:last-child td[field-key='make']", $vehicle_sc->make)
                ->assertSeeIn("tr:last-child td[field-key='model']", $vehicle_sc->model)
                ->assertSeeIn("tr:last-child td[field-key='registration_number']", $vehicle_sc->registration_number)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\VehicleSc::first()->certificate_of_registration . "']")
                ->assertSeeIn("tr:last-child td[field-key='certificate_of_fitness_number']", $vehicle_sc->certificate_of_fitness_number)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\VehicleSc::first()->certificate_of_fitness . "']")
                ->assertSeeIn("tr:last-child td[field-key='tracker_pin_details']", $vehicle_sc->tracker_pin_details)
                ->assertSeeIn("tr:last-child td[field-key='expiration_date']", $vehicle_sc->expiration_date)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\VehicleSc::first()->service_history_reports . "']")
                ->assertSeeIn("tr:last-child td[field-key='status']", $vehicle_sc->status)
                ->logout();
        });
    }

    public function testEditVehicleSc()
    {
        $admin = \App\User::find(1);
        $vehicle_sc = factory('App\VehicleSc')->create();
        $vehicle_sc2 = factory('App\VehicleSc')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $vehicle_sc, $vehicle_sc2) {
            $browser->loginAs($admin)
                ->visit(route('admin.vehicle_scs.index'))
                ->click('tr[data-entry-id="' . $vehicle_sc->id . '"] .btn-info')
                ->select("vendor_id", $vehicle_sc2->vendor_id)
                ->select("subcontractor_number_id", $vehicle_sc2->subcontractor_number_id)
                ->select("vehicle_type", $vehicle_sc2->vehicle_type)
                ->type("make", $vehicle_sc2->make)
                ->type("model", $vehicle_sc2->model)
                ->type("registration_number", $vehicle_sc2->registration_number)
                ->attach("certificate_of_registration", base_path("tests/_resources/test.jpg"))
                ->type("certificate_of_fitness_number", $vehicle_sc2->certificate_of_fitness_number)
                ->attach("certificate_of_fitness", base_path("tests/_resources/test.jpg"))
                ->type("tracker_pin_details", $vehicle_sc2->tracker_pin_details)
                ->type("tracker_password", $vehicle_sc2->tracker_password)
                ->type("expiration_date", $vehicle_sc2->expiration_date)
                ->attach("service_history_reports", base_path("tests/_resources/test.jpg"))
                ->select("status", $vehicle_sc2->status)
                ->press('Update')
                ->assertRouteIs('admin.vehicle_scs.index')
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $vehicle_sc2->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='subcontractor_number']", $vehicle_sc2->subcontractor_number->subcontractor_number)
                ->assertSeeIn("tr:last-child td[field-key='vehicle_type']", $vehicle_sc2->vehicle_type)
                ->assertSeeIn("tr:last-child td[field-key='make']", $vehicle_sc2->make)
                ->assertSeeIn("tr:last-child td[field-key='model']", $vehicle_sc2->model)
                ->assertSeeIn("tr:last-child td[field-key='registration_number']", $vehicle_sc2->registration_number)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\VehicleSc::first()->certificate_of_registration . "']")
                ->assertSeeIn("tr:last-child td[field-key='certificate_of_fitness_number']", $vehicle_sc2->certificate_of_fitness_number)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\VehicleSc::first()->certificate_of_fitness . "']")
                ->assertSeeIn("tr:last-child td[field-key='tracker_pin_details']", $vehicle_sc2->tracker_pin_details)
                ->assertSeeIn("tr:last-child td[field-key='expiration_date']", $vehicle_sc2->expiration_date)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\VehicleSc::first()->service_history_reports . "']")
                ->assertSeeIn("tr:last-child td[field-key='status']", $vehicle_sc2->status)
                ->logout();
        });
    }

    public function testShowVehicleSc()
    {
        $admin = \App\User::find(1);
        $vehicle_sc = factory('App\VehicleSc')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $vehicle_sc) {
            $browser->loginAs($admin)
                ->visit(route('admin.vehicle_scs.index'))
                ->click('tr[data-entry-id="' . $vehicle_sc->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='vendor']", $vehicle_sc->vendor->name)
                ->assertSeeIn("td[field-key='subcontractor_number']", $vehicle_sc->subcontractor_number->subcontractor_number)
                ->assertSeeIn("td[field-key='vehicle_type']", $vehicle_sc->vehicle_type)
                ->assertSeeIn("td[field-key='make']", $vehicle_sc->make)
                ->assertSeeIn("td[field-key='model']", $vehicle_sc->model)
                ->assertSeeIn("td[field-key='registration_number']", $vehicle_sc->registration_number)
                ->assertSeeIn("td[field-key='certificate_of_fitness_number']", $vehicle_sc->certificate_of_fitness_number)
                ->assertSeeIn("td[field-key='tracker_pin_details']", $vehicle_sc->tracker_pin_details)
                ->assertSeeIn("td[field-key='expiration_date']", $vehicle_sc->expiration_date)
                ->assertSeeIn("td[field-key='status']", $vehicle_sc->status)
                ->logout();
        });
    }

}
