<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DriverTest extends DuskTestCase
{

    public function testCreateDriver()
    {
        $admin = \App\User::find(1);
        $driver = factory('App\Driver')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $driver) {
            $browser->loginAs($admin)
                ->visit(route('admin.drivers.index'))
                ->clickLink('Add new')
                ->select("vendor_id", $driver->vendor_id)
                ->select("subcontractor_number_id", $driver->subcontractor_number_id)
                ->type("name", $driver->name)
                ->type("date_of_birth", $driver->date_of_birth)
                ->type("drivers_license_number", $driver->drivers_license_number)
                ->type("drivers_license_expiry_date", $driver->drivers_license_expiry_date)
                ->type("int_drivers_license_no", $driver->int_drivers_license_no)
                ->attach("int_drivers_license", base_path("tests/_resources/test.jpg"))
                ->type("int_drivers_license_expiry_date", $driver->int_drivers_license_expiry_date)
                ->type("drivers_passport_number", $driver->drivers_passport_number)
                ->type("passport_expiry_date", $driver->passport_expiry_date)
                ->type("sa_phone_number", $driver->sa_phone_number)
                ->type("int_phone_number", $driver->int_phone_number)
                ->type("police_clearance_expiry_date", $driver->police_clearance_expiry_date)
                ->type("retest_number", $driver->retest_number)
                ->attach("retest", base_path("tests/_resources/test.jpg"))
                ->type("retest_expiry_date", $driver->retest_expiry_date)
                ->press('Save')
                ->assertRouteIs('admin.drivers.index')
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $driver->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='subcontractor_number']", $driver->subcontractor_number->subcontractor_number)
                ->assertSeeIn("tr:last-child td[field-key='name']", $driver->name)
                ->assertSeeIn("tr:last-child td[field-key='date_of_birth']", $driver->date_of_birth)
                ->assertSeeIn("tr:last-child td[field-key='drivers_license_number']", $driver->drivers_license_number)
                ->assertSeeIn("tr:last-child td[field-key='drivers_license_expiry_date']", $driver->drivers_license_expiry_date)
                ->assertSeeIn("tr:last-child td[field-key='int_drivers_license_no']", $driver->int_drivers_license_no)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Driver::first()->int_drivers_license . "']")
                ->assertSeeIn("tr:last-child td[field-key='int_drivers_license_expiry_date']", $driver->int_drivers_license_expiry_date)
                ->assertSeeIn("tr:last-child td[field-key='drivers_passport_number']", $driver->drivers_passport_number)
                ->assertSeeIn("tr:last-child td[field-key='passport_expiry_date']", $driver->passport_expiry_date)
                ->assertSeeIn("tr:last-child td[field-key='sa_phone_number']", $driver->sa_phone_number)
                ->assertSeeIn("tr:last-child td[field-key='int_phone_number']", $driver->int_phone_number)
                ->assertSeeIn("tr:last-child td[field-key='police_clearance_expiry_date']", $driver->police_clearance_expiry_date)
                ->assertSeeIn("tr:last-child td[field-key='retest_number']", $driver->retest_number)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Driver::first()->retest . "']")
                ->assertSeeIn("tr:last-child td[field-key='retest_expiry_date']", $driver->retest_expiry_date)
                ->logout();
        });
    }

    public function testEditDriver()
    {
        $admin = \App\User::find(1);
        $driver = factory('App\Driver')->create();
        $driver2 = factory('App\Driver')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $driver, $driver2) {
            $browser->loginAs($admin)
                ->visit(route('admin.drivers.index'))
                ->click('tr[data-entry-id="' . $driver->id . '"] .btn-info')
                ->select("vendor_id", $driver2->vendor_id)
                ->select("subcontractor_number_id", $driver2->subcontractor_number_id)
                ->type("name", $driver2->name)
                ->type("date_of_birth", $driver2->date_of_birth)
                ->type("drivers_license_number", $driver2->drivers_license_number)
                ->type("drivers_license_expiry_date", $driver2->drivers_license_expiry_date)
                ->type("int_drivers_license_no", $driver2->int_drivers_license_no)
                ->attach("int_drivers_license", base_path("tests/_resources/test.jpg"))
                ->type("int_drivers_license_expiry_date", $driver2->int_drivers_license_expiry_date)
                ->type("drivers_passport_number", $driver2->drivers_passport_number)
                ->type("passport_expiry_date", $driver2->passport_expiry_date)
                ->type("sa_phone_number", $driver2->sa_phone_number)
                ->type("int_phone_number", $driver2->int_phone_number)
                ->type("police_clearance_expiry_date", $driver2->police_clearance_expiry_date)
                ->type("retest_number", $driver2->retest_number)
                ->attach("retest", base_path("tests/_resources/test.jpg"))
                ->type("retest_expiry_date", $driver2->retest_expiry_date)
                ->press('Update')
                ->assertRouteIs('admin.drivers.index')
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $driver2->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='subcontractor_number']", $driver2->subcontractor_number->subcontractor_number)
                ->assertSeeIn("tr:last-child td[field-key='name']", $driver2->name)
                ->assertSeeIn("tr:last-child td[field-key='date_of_birth']", $driver2->date_of_birth)
                ->assertSeeIn("tr:last-child td[field-key='drivers_license_number']", $driver2->drivers_license_number)
                ->assertSeeIn("tr:last-child td[field-key='drivers_license_expiry_date']", $driver2->drivers_license_expiry_date)
                ->assertSeeIn("tr:last-child td[field-key='int_drivers_license_no']", $driver2->int_drivers_license_no)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Driver::first()->int_drivers_license . "']")
                ->assertSeeIn("tr:last-child td[field-key='int_drivers_license_expiry_date']", $driver2->int_drivers_license_expiry_date)
                ->assertSeeIn("tr:last-child td[field-key='drivers_passport_number']", $driver2->drivers_passport_number)
                ->assertSeeIn("tr:last-child td[field-key='passport_expiry_date']", $driver2->passport_expiry_date)
                ->assertSeeIn("tr:last-child td[field-key='sa_phone_number']", $driver2->sa_phone_number)
                ->assertSeeIn("tr:last-child td[field-key='int_phone_number']", $driver2->int_phone_number)
                ->assertSeeIn("tr:last-child td[field-key='police_clearance_expiry_date']", $driver2->police_clearance_expiry_date)
                ->assertSeeIn("tr:last-child td[field-key='retest_number']", $driver2->retest_number)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Driver::first()->retest . "']")
                ->assertSeeIn("tr:last-child td[field-key='retest_expiry_date']", $driver2->retest_expiry_date)
                ->logout();
        });
    }

    public function testShowDriver()
    {
        $admin = \App\User::find(1);
        $driver = factory('App\Driver')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $driver) {
            $browser->loginAs($admin)
                ->visit(route('admin.drivers.index'))
                ->click('tr[data-entry-id="' . $driver->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='vendor']", $driver->vendor->name)
                ->assertSeeIn("td[field-key='subcontractor_number']", $driver->subcontractor_number->subcontractor_number)
                ->assertSeeIn("td[field-key='name']", $driver->name)
                ->assertSeeIn("td[field-key='date_of_birth']", $driver->date_of_birth)
                ->assertSeeIn("td[field-key='drivers_license_number']", $driver->drivers_license_number)
                ->assertSeeIn("td[field-key='drivers_license_expiry_date']", $driver->drivers_license_expiry_date)
                ->assertSeeIn("td[field-key='int_drivers_license_no']", $driver->int_drivers_license_no)
                ->assertSeeIn("td[field-key='int_drivers_license_expiry_date']", $driver->int_drivers_license_expiry_date)
                ->assertSeeIn("td[field-key='drivers_passport_number']", $driver->drivers_passport_number)
                ->assertSeeIn("td[field-key='passport_expiry_date']", $driver->passport_expiry_date)
                ->assertSeeIn("td[field-key='sa_phone_number']", $driver->sa_phone_number)
                ->assertSeeIn("td[field-key='int_phone_number']", $driver->int_phone_number)
                ->assertSeeIn("td[field-key='police_clearance_expiry_date']", $driver->police_clearance_expiry_date)
                ->assertSeeIn("td[field-key='retest_number']", $driver->retest_number)
                ->assertSeeIn("td[field-key='retest_expiry_date']", $driver->retest_expiry_date)
                ->logout();
        });
    }

}
