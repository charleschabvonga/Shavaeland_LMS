<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PartTest extends DuskTestCase
{

    public function testCreatePart()
    {
        $admin = \App\User::find(1);
        $part = factory('App\Part')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $part) {
            $browser->loginAs($admin)
                ->visit(route('admin.parts.index'))
                ->clickLink('Add new')
                ->select("repair_center_id", $part->repair_center_id)
                ->type("part", $part->part)
                ->type("qty", $part->qty)
                ->select("unit_id", $part->unit_id)
                ->select("status", $part->status)
                ->press('Save')
                ->assertRouteIs('admin.parts.index')
                ->assertSeeIn("tr:last-child td[field-key='repair_center']", $part->repair_center->center_name)
                ->assertSeeIn("tr:last-child td[field-key='part']", $part->part)
                ->assertSeeIn("tr:last-child td[field-key='qty']", $part->qty)
                ->assertSeeIn("tr:last-child td[field-key='unit']", $part->unit->measurement_type)
                ->assertSeeIn("tr:last-child td[field-key='status']", $part->status)
                ->logout();
        });
    }

    public function testEditPart()
    {
        $admin = \App\User::find(1);
        $part = factory('App\Part')->create();
        $part2 = factory('App\Part')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $part, $part2) {
            $browser->loginAs($admin)
                ->visit(route('admin.parts.index'))
                ->click('tr[data-entry-id="' . $part->id . '"] .btn-info')
                ->select("repair_center_id", $part2->repair_center_id)
                ->type("part", $part2->part)
                ->type("qty", $part2->qty)
                ->select("unit_id", $part2->unit_id)
                ->select("status", $part2->status)
                ->press('Update')
                ->assertRouteIs('admin.parts.index')
                ->assertSeeIn("tr:last-child td[field-key='repair_center']", $part2->repair_center->center_name)
                ->assertSeeIn("tr:last-child td[field-key='part']", $part2->part)
                ->assertSeeIn("tr:last-child td[field-key='qty']", $part2->qty)
                ->assertSeeIn("tr:last-child td[field-key='unit']", $part2->unit->measurement_type)
                ->assertSeeIn("tr:last-child td[field-key='status']", $part2->status)
                ->logout();
        });
    }

    public function testShowPart()
    {
        $admin = \App\User::find(1);
        $part = factory('App\Part')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $part) {
            $browser->loginAs($admin)
                ->visit(route('admin.parts.index'))
                ->click('tr[data-entry-id="' . $part->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='repair_center']", $part->repair_center->center_name)
                ->assertSeeIn("td[field-key='part']", $part->part)
                ->assertSeeIn("td[field-key='qty']", $part->qty)
                ->assertSeeIn("td[field-key='unit']", $part->unit->measurement_type)
                ->assertSeeIn("td[field-key='status']", $part->status)
                ->logout();
        });
    }

}
