<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class WorkshopTest extends DuskTestCase
{

    public function testCreateWorkshop()
    {
        $admin = \App\User::find(1);
        $workshop = factory('App\Workshop')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $workshop) {
            $browser->loginAs($admin)
                ->visit(route('admin.workshops.index'))
                ->clickLink('Add new')
                ->select("vendor_id", $workshop->vendor_id)
                ->type("center_name", $workshop->center_name)
                ->press('Save')
                ->assertRouteIs('admin.workshops.index')
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $workshop->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='center_name']", $workshop->center_name)
                ->logout();
        });
    }

    public function testEditWorkshop()
    {
        $admin = \App\User::find(1);
        $workshop = factory('App\Workshop')->create();
        $workshop2 = factory('App\Workshop')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $workshop, $workshop2) {
            $browser->loginAs($admin)
                ->visit(route('admin.workshops.index'))
                ->click('tr[data-entry-id="' . $workshop->id . '"] .btn-info')
                ->select("vendor_id", $workshop2->vendor_id)
                ->type("center_name", $workshop2->center_name)
                ->press('Update')
                ->assertRouteIs('admin.workshops.index')
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $workshop2->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='center_name']", $workshop2->center_name)
                ->logout();
        });
    }

    public function testShowWorkshop()
    {
        $admin = \App\User::find(1);
        $workshop = factory('App\Workshop')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $workshop) {
            $browser->loginAs($admin)
                ->visit(route('admin.workshops.index'))
                ->click('tr[data-entry-id="' . $workshop->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='vendor']", $workshop->vendor->name)
                ->assertSeeIn("td[field-key='center_name']", $workshop->center_name)
                ->logout();
        });
    }

}
