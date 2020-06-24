<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ViolationTest extends DuskTestCase
{

    public function testCreateViolation()
    {
        $admin = \App\User::find(1);
        $violation = factory('App\Violation')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $violation) {
            $browser->loginAs($admin)
                ->visit(route('admin.violations.index'))
                ->clickLink('Add new')
                ->select("employee_name_id", $violation->employee_name_id)
                ->select("vehicle_description_id", $violation->vehicle_description_id)
                ->select("trailer_id", $violation->trailer_id)
                ->select("road_freight_number_id", $violation->road_freight_number_id)
                ->type("citation_number", $violation->citation_number)
                ->type("citation_date", $violation->citation_date)
                ->type("description", $violation->description)
                ->attach("file", base_path("tests/_resources/test.jpg"))
                ->select("status", $violation->status)
                ->type("amount", $violation->amount)
                ->press('Save')
                ->assertRouteIs('admin.violations.index')
                ->assertSeeIn("tr:last-child td[field-key='employee_name']", $violation->employee_name->name)
                ->assertSeeIn("tr:last-child td[field-key='vehicle_description']", $violation->vehicle_description->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='trailer']", $violation->trailer->trailer_description)
                ->assertSeeIn("tr:last-child td[field-key='road_freight_number']", $violation->road_freight_number->road_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='citation_number']", $violation->citation_number)
                ->assertSeeIn("tr:last-child td[field-key='citation_date']", $violation->citation_date)
                ->assertSeeIn("tr:last-child td[field-key='description']", $violation->description)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Violation::first()->file . "']")
                ->assertSeeIn("tr:last-child td[field-key='status']", $violation->status)
                ->assertSeeIn("tr:last-child td[field-key='amount']", $violation->amount)
                ->logout();
        });
    }

    public function testEditViolation()
    {
        $admin = \App\User::find(1);
        $violation = factory('App\Violation')->create();
        $violation2 = factory('App\Violation')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $violation, $violation2) {
            $browser->loginAs($admin)
                ->visit(route('admin.violations.index'))
                ->click('tr[data-entry-id="' . $violation->id . '"] .btn-info')
                ->select("employee_name_id", $violation2->employee_name_id)
                ->select("vehicle_description_id", $violation2->vehicle_description_id)
                ->select("trailer_id", $violation2->trailer_id)
                ->select("road_freight_number_id", $violation2->road_freight_number_id)
                ->type("citation_number", $violation2->citation_number)
                ->type("citation_date", $violation2->citation_date)
                ->type("description", $violation2->description)
                ->attach("file", base_path("tests/_resources/test.jpg"))
                ->select("status", $violation2->status)
                ->type("amount", $violation2->amount)
                ->press('Update')
                ->assertRouteIs('admin.violations.index')
                ->assertSeeIn("tr:last-child td[field-key='employee_name']", $violation2->employee_name->name)
                ->assertSeeIn("tr:last-child td[field-key='vehicle_description']", $violation2->vehicle_description->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='trailer']", $violation2->trailer->trailer_description)
                ->assertSeeIn("tr:last-child td[field-key='road_freight_number']", $violation2->road_freight_number->road_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='citation_number']", $violation2->citation_number)
                ->assertSeeIn("tr:last-child td[field-key='citation_date']", $violation2->citation_date)
                ->assertSeeIn("tr:last-child td[field-key='description']", $violation2->description)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Violation::first()->file . "']")
                ->assertSeeIn("tr:last-child td[field-key='status']", $violation2->status)
                ->assertSeeIn("tr:last-child td[field-key='amount']", $violation2->amount)
                ->logout();
        });
    }

    public function testShowViolation()
    {
        $admin = \App\User::find(1);
        $violation = factory('App\Violation')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $violation) {
            $browser->loginAs($admin)
                ->visit(route('admin.violations.index'))
                ->click('tr[data-entry-id="' . $violation->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='employee_name']", $violation->employee_name->name)
                ->assertSeeIn("td[field-key='vehicle_description']", $violation->vehicle_description->vehicle_description)
                ->assertSeeIn("td[field-key='trailer']", $violation->trailer->trailer_description)
                ->assertSeeIn("td[field-key='road_freight_number']", $violation->road_freight_number->road_freight_number)
                ->assertSeeIn("td[field-key='citation_number']", $violation->citation_number)
                ->assertSeeIn("td[field-key='citation_date']", $violation->citation_date)
                ->assertSeeIn("td[field-key='description']", $violation->description)
                ->assertSeeIn("td[field-key='status']", $violation->status)
                ->assertSeeIn("td[field-key='amount']", $violation->amount)
                ->logout();
        });
    }

}
