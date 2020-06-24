<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class JobCardItemTest extends DuskTestCase
{

    public function testCreateJobCardItem()
    {
        $admin = \App\User::find(1);
        $job_card_item = factory('App\JobCardItem')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $job_card_item) {
            $browser->loginAs($admin)
                ->visit(route('admin.job_card_items.index'))
                ->clickLink('Add new')
                ->select("job_card_items_id", $job_card_item->job_card_items_id)
                ->select("client_job_card_number_id", $job_card_item->client_job_card_number_id)
                ->type("workshop", $job_card_item->workshop)
                ->type("part", $job_card_item->part)
                ->type("price", $job_card_item->price)
                ->type("qty", $job_card_item->qty)
                ->type("unit", $job_card_item->unit)
                ->type("total", $job_card_item->total)
                ->press('Save')
                ->assertRouteIs('admin.job_card_items.index')
                ->assertSeeIn("tr:last-child td[field-key='job_card_items']", $job_card_item->job_card_items->job_card_number)
                ->assertSeeIn("tr:last-child td[field-key='client_job_card_number']", $job_card_item->client_job_card_number->job_card_number)
                ->assertSeeIn("tr:last-child td[field-key='workshop']", $job_card_item->workshop)
                ->assertSeeIn("tr:last-child td[field-key='part']", $job_card_item->part)
                ->assertSeeIn("tr:last-child td[field-key='price']", $job_card_item->price)
                ->assertSeeIn("tr:last-child td[field-key='qty']", $job_card_item->qty)
                ->assertSeeIn("tr:last-child td[field-key='unit']", $job_card_item->unit)
                ->assertSeeIn("tr:last-child td[field-key='total']", $job_card_item->total)
                ->logout();
        });
    }

    public function testEditJobCardItem()
    {
        $admin = \App\User::find(1);
        $job_card_item = factory('App\JobCardItem')->create();
        $job_card_item2 = factory('App\JobCardItem')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $job_card_item, $job_card_item2) {
            $browser->loginAs($admin)
                ->visit(route('admin.job_card_items.index'))
                ->click('tr[data-entry-id="' . $job_card_item->id . '"] .btn-info')
                ->select("job_card_items_id", $job_card_item2->job_card_items_id)
                ->select("client_job_card_number_id", $job_card_item2->client_job_card_number_id)
                ->type("workshop", $job_card_item2->workshop)
                ->type("part", $job_card_item2->part)
                ->type("price", $job_card_item2->price)
                ->type("qty", $job_card_item2->qty)
                ->type("unit", $job_card_item2->unit)
                ->type("total", $job_card_item2->total)
                ->press('Update')
                ->assertRouteIs('admin.job_card_items.index')
                ->assertSeeIn("tr:last-child td[field-key='job_card_items']", $job_card_item2->job_card_items->job_card_number)
                ->assertSeeIn("tr:last-child td[field-key='client_job_card_number']", $job_card_item2->client_job_card_number->job_card_number)
                ->assertSeeIn("tr:last-child td[field-key='workshop']", $job_card_item2->workshop)
                ->assertSeeIn("tr:last-child td[field-key='part']", $job_card_item2->part)
                ->assertSeeIn("tr:last-child td[field-key='price']", $job_card_item2->price)
                ->assertSeeIn("tr:last-child td[field-key='qty']", $job_card_item2->qty)
                ->assertSeeIn("tr:last-child td[field-key='unit']", $job_card_item2->unit)
                ->assertSeeIn("tr:last-child td[field-key='total']", $job_card_item2->total)
                ->logout();
        });
    }

    public function testShowJobCardItem()
    {
        $admin = \App\User::find(1);
        $job_card_item = factory('App\JobCardItem')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $job_card_item) {
            $browser->loginAs($admin)
                ->visit(route('admin.job_card_items.index'))
                ->click('tr[data-entry-id="' . $job_card_item->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='job_card_items']", $job_card_item->job_card_items->job_card_number)
                ->assertSeeIn("td[field-key='client_job_card_number']", $job_card_item->client_job_card_number->job_card_number)
                ->assertSeeIn("td[field-key='workshop']", $job_card_item->workshop)
                ->assertSeeIn("td[field-key='part']", $job_card_item->part)
                ->assertSeeIn("td[field-key='price']", $job_card_item->price)
                ->assertSeeIn("td[field-key='qty']", $job_card_item->qty)
                ->assertSeeIn("td[field-key='unit']", $job_card_item->unit)
                ->assertSeeIn("td[field-key='total']", $job_card_item->total)
                ->logout();
        });
    }

}
