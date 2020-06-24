<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class TruckAttachmentStatusTest extends DuskTestCase
{

    public function testCreateTruckAttachmentStatus()
    {
        $admin = \App\User::find(1);
        $truck_attachment_status = factory('App\TruckAttachmentStatus')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $truck_attachment_status) {
            $browser->loginAs($admin)
                ->visit(route('admin.truck_attachment_statuses.index'))
                ->clickLink('Add new')
                ->type("attachment", $truck_attachment_status->attachment)
                ->press('Save')
                ->assertRouteIs('admin.truck_attachment_statuses.index')
                ->assertSeeIn("tr:last-child td[field-key='attachment']", $truck_attachment_status->attachment)
                ->logout();
        });
    }

    public function testEditTruckAttachmentStatus()
    {
        $admin = \App\User::find(1);
        $truck_attachment_status = factory('App\TruckAttachmentStatus')->create();
        $truck_attachment_status2 = factory('App\TruckAttachmentStatus')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $truck_attachment_status, $truck_attachment_status2) {
            $browser->loginAs($admin)
                ->visit(route('admin.truck_attachment_statuses.index'))
                ->click('tr[data-entry-id="' . $truck_attachment_status->id . '"] .btn-info')
                ->type("attachment", $truck_attachment_status2->attachment)
                ->press('Update')
                ->assertRouteIs('admin.truck_attachment_statuses.index')
                ->assertSeeIn("tr:last-child td[field-key='attachment']", $truck_attachment_status2->attachment)
                ->logout();
        });
    }

    public function testShowTruckAttachmentStatus()
    {
        $admin = \App\User::find(1);
        $truck_attachment_status = factory('App\TruckAttachmentStatus')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $truck_attachment_status) {
            $browser->loginAs($admin)
                ->visit(route('admin.truck_attachment_statuses.index'))
                ->click('tr[data-entry-id="' . $truck_attachment_status->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='attachment']", $truck_attachment_status->attachment)
                ->logout();
        });
    }

}
