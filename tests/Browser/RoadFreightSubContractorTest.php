<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RoadFreightSubContractorTest extends DuskTestCase
{

    public function testCreateRoadFreightSubContractor()
    {
        $admin = \App\User::find(1);
        $road_freight_sub_contractor = factory('App\RoadFreightSubContractor')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $road_freight_sub_contractor) {
            $browser->loginAs($admin)
                ->visit(route('admin.road_freight_sub_contractors.index'))
                ->clickLink('Add new')
                ->type("subcontractor_number", $road_freight_sub_contractor->subcontractor_number)
                ->select("vendor_id", $road_freight_sub_contractor->vendor_id)
                ->type("git_cover_number", $road_freight_sub_contractor->git_cover_number)
                ->attach("git_cover", base_path("tests/_resources/test.jpg"))
                ->select("status", $road_freight_sub_contractor->status)
                ->type("git_expiry_date", $road_freight_sub_contractor->git_expiry_date)
                ->select("git_status", $road_freight_sub_contractor->git_status)
                ->press('Save')
                ->assertRouteIs('admin.road_freight_sub_contractors.index')
                ->assertSeeIn("tr:last-child td[field-key='subcontractor_number']", $road_freight_sub_contractor->subcontractor_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $road_freight_sub_contractor->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='git_cover_number']", $road_freight_sub_contractor->git_cover_number)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\RoadFreightSubContractor::first()->git_cover . "']")
                ->assertSeeIn("tr:last-child td[field-key='status']", $road_freight_sub_contractor->status)
                ->assertSeeIn("tr:last-child td[field-key='git_expiry_date']", $road_freight_sub_contractor->git_expiry_date)
                ->assertSeeIn("tr:last-child td[field-key='git_status']", $road_freight_sub_contractor->git_status)
                ->logout();
        });
    }

    public function testEditRoadFreightSubContractor()
    {
        $admin = \App\User::find(1);
        $road_freight_sub_contractor = factory('App\RoadFreightSubContractor')->create();
        $road_freight_sub_contractor2 = factory('App\RoadFreightSubContractor')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $road_freight_sub_contractor, $road_freight_sub_contractor2) {
            $browser->loginAs($admin)
                ->visit(route('admin.road_freight_sub_contractors.index'))
                ->click('tr[data-entry-id="' . $road_freight_sub_contractor->id . '"] .btn-info')
                ->type("subcontractor_number", $road_freight_sub_contractor2->subcontractor_number)
                ->select("vendor_id", $road_freight_sub_contractor2->vendor_id)
                ->type("git_cover_number", $road_freight_sub_contractor2->git_cover_number)
                ->attach("git_cover", base_path("tests/_resources/test.jpg"))
                ->select("status", $road_freight_sub_contractor2->status)
                ->type("git_expiry_date", $road_freight_sub_contractor2->git_expiry_date)
                ->select("git_status", $road_freight_sub_contractor2->git_status)
                ->press('Update')
                ->assertRouteIs('admin.road_freight_sub_contractors.index')
                ->assertSeeIn("tr:last-child td[field-key='subcontractor_number']", $road_freight_sub_contractor2->subcontractor_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $road_freight_sub_contractor2->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='git_cover_number']", $road_freight_sub_contractor2->git_cover_number)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\RoadFreightSubContractor::first()->git_cover . "']")
                ->assertSeeIn("tr:last-child td[field-key='status']", $road_freight_sub_contractor2->status)
                ->assertSeeIn("tr:last-child td[field-key='git_expiry_date']", $road_freight_sub_contractor2->git_expiry_date)
                ->assertSeeIn("tr:last-child td[field-key='git_status']", $road_freight_sub_contractor2->git_status)
                ->logout();
        });
    }

    public function testShowRoadFreightSubContractor()
    {
        $admin = \App\User::find(1);
        $road_freight_sub_contractor = factory('App\RoadFreightSubContractor')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $road_freight_sub_contractor) {
            $browser->loginAs($admin)
                ->visit(route('admin.road_freight_sub_contractors.index'))
                ->click('tr[data-entry-id="' . $road_freight_sub_contractor->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='subcontractor_number']", $road_freight_sub_contractor->subcontractor_number)
                ->assertSeeIn("td[field-key='vendor']", $road_freight_sub_contractor->vendor->name)
                ->assertSeeIn("td[field-key='git_cover_number']", $road_freight_sub_contractor->git_cover_number)
                ->assertSeeIn("td[field-key='status']", $road_freight_sub_contractor->status)
                ->assertSeeIn("td[field-key='git_expiry_date']", $road_freight_sub_contractor->git_expiry_date)
                ->assertSeeIn("td[field-key='git_status']", $road_freight_sub_contractor->git_status)
                ->logout();
        });
    }

}
