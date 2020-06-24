<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ReceivedItemTest extends DuskTestCase
{

    public function testCreateReceivedItem()
    {
        $admin = \App\User::find(1);
        $received_item = factory('App\ReceivedItem')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $received_item) {
            $browser->loginAs($admin)
                ->visit(route('admin.received_items.index'))
                ->clickLink('Add new')
                ->select("receipt_number_id", $received_item->receipt_number_id)
                ->select("release_number_id", $received_item->release_number_id)
                ->type("item", $received_item->item)
                ->type("qty", $received_item->qty)
                ->type("area", $received_item->area)
                ->type("unit", $received_item->unit)
                ->press('Save')
                ->assertRouteIs('admin.received_items.index')
                ->assertSeeIn("tr:last-child td[field-key='receipt_number']", $received_item->receipt_number->receipt_number)
                ->assertSeeIn("tr:last-child td[field-key='release_number']", $received_item->release_number->release_number)
                ->assertSeeIn("tr:last-child td[field-key='item']", $received_item->item)
                ->assertSeeIn("tr:last-child td[field-key='qty']", $received_item->qty)
                ->assertSeeIn("tr:last-child td[field-key='area']", $received_item->area)
                ->assertSeeIn("tr:last-child td[field-key='unit']", $received_item->unit)
                ->logout();
        });
    }

    public function testEditReceivedItem()
    {
        $admin = \App\User::find(1);
        $received_item = factory('App\ReceivedItem')->create();
        $received_item2 = factory('App\ReceivedItem')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $received_item, $received_item2) {
            $browser->loginAs($admin)
                ->visit(route('admin.received_items.index'))
                ->click('tr[data-entry-id="' . $received_item->id . '"] .btn-info')
                ->select("receipt_number_id", $received_item2->receipt_number_id)
                ->select("release_number_id", $received_item2->release_number_id)
                ->type("item", $received_item2->item)
                ->type("qty", $received_item2->qty)
                ->type("area", $received_item2->area)
                ->type("unit", $received_item2->unit)
                ->press('Update')
                ->assertRouteIs('admin.received_items.index')
                ->assertSeeIn("tr:last-child td[field-key='receipt_number']", $received_item2->receipt_number->receipt_number)
                ->assertSeeIn("tr:last-child td[field-key='release_number']", $received_item2->release_number->release_number)
                ->assertSeeIn("tr:last-child td[field-key='item']", $received_item2->item)
                ->assertSeeIn("tr:last-child td[field-key='qty']", $received_item2->qty)
                ->assertSeeIn("tr:last-child td[field-key='area']", $received_item2->area)
                ->assertSeeIn("tr:last-child td[field-key='unit']", $received_item2->unit)
                ->logout();
        });
    }

    public function testShowReceivedItem()
    {
        $admin = \App\User::find(1);
        $received_item = factory('App\ReceivedItem')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $received_item) {
            $browser->loginAs($admin)
                ->visit(route('admin.received_items.index'))
                ->click('tr[data-entry-id="' . $received_item->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='receipt_number']", $received_item->receipt_number->receipt_number)
                ->assertSeeIn("td[field-key='release_number']", $received_item->release_number->release_number)
                ->assertSeeIn("td[field-key='item']", $received_item->item)
                ->assertSeeIn("td[field-key='qty']", $received_item->qty)
                ->assertSeeIn("td[field-key='area']", $received_item->area)
                ->assertSeeIn("td[field-key='unit']", $received_item->unit)
                ->logout();
        });
    }

}
