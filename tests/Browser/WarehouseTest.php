<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class WarehouseTest extends DuskTestCase
{

    public function testCreateWarehouse()
    {
        $admin = \App\User::find(1);
        $warehouse = factory('App\Warehouse')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $warehouse) {
            $browser->loginAs($admin)
                ->visit(route('admin.warehouses.index'))
                ->clickLink('Add new')
                ->select("vendor_id", $warehouse->vendor_id)
                ->type("center_name", $warehouse->center_name)
                ->type("square_meters", $warehouse->square_meters)
                ->type("available_space", $warehouse->available_space)
                ->press('Save')
                ->assertRouteIs('admin.warehouses.index')
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $warehouse->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='center_name']", $warehouse->center_name)
                ->assertSeeIn("tr:last-child td[field-key='square_meters']", $warehouse->square_meters)
                ->assertSeeIn("tr:last-child td[field-key='available_space']", $warehouse->available_space)
                ->logout();
        });
    }

    public function testEditWarehouse()
    {
        $admin = \App\User::find(1);
        $warehouse = factory('App\Warehouse')->create();
        $warehouse2 = factory('App\Warehouse')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $warehouse, $warehouse2) {
            $browser->loginAs($admin)
                ->visit(route('admin.warehouses.index'))
                ->click('tr[data-entry-id="' . $warehouse->id . '"] .btn-info')
                ->select("vendor_id", $warehouse2->vendor_id)
                ->type("center_name", $warehouse2->center_name)
                ->type("square_meters", $warehouse2->square_meters)
                ->type("available_space", $warehouse2->available_space)
                ->press('Update')
                ->assertRouteIs('admin.warehouses.index')
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $warehouse2->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='center_name']", $warehouse2->center_name)
                ->assertSeeIn("tr:last-child td[field-key='square_meters']", $warehouse2->square_meters)
                ->assertSeeIn("tr:last-child td[field-key='available_space']", $warehouse2->available_space)
                ->logout();
        });
    }

    public function testShowWarehouse()
    {
        $admin = \App\User::find(1);
        $warehouse = factory('App\Warehouse')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $warehouse) {
            $browser->loginAs($admin)
                ->visit(route('admin.warehouses.index'))
                ->click('tr[data-entry-id="' . $warehouse->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='vendor']", $warehouse->vendor->name)
                ->assertSeeIn("td[field-key='center_name']", $warehouse->center_name)
                ->assertSeeIn("td[field-key='square_meters']", $warehouse->square_meters)
                ->assertSeeIn("td[field-key='available_space']", $warehouse->available_space)
                ->logout();
        });
    }

}
