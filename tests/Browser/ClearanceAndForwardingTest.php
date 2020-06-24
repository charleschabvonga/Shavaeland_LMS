<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ClearanceAndForwardingTest extends DuskTestCase
{

    public function testCreateClearanceAndForwarding()
    {
        $admin = \App\User::find(1);
        $clearance_and_forwarding = factory('App\ClearanceAndForwarding')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $clearance_and_forwarding) {
            $browser->loginAs($admin)
                ->visit(route('admin.clearance_and_forwardings.index'))
                ->clickLink('Add new')
                ->select("project_number_id", $clearance_and_forwarding->project_number_id)
                ->type("clearance_and_forwarding_number", $clearance_and_forwarding->clearance_and_forwarding_number)
                ->type("border_post", $clearance_and_forwarding->border_post)
                ->select("client_id", $clearance_and_forwarding->client_id)
                ->select("contact_person_id", $clearance_and_forwarding->contact_person_id)
                ->select("agent_id", $clearance_and_forwarding->agent_id)
                ->select("agent_contact_id", $clearance_and_forwarding->agent_contact_id)
                ->select("project_manager_id", $clearance_and_forwarding->project_manager_id)
                ->press('Save')
                ->assertRouteIs('admin.clearance_and_forwardings.index')
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $clearance_and_forwarding->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='clearance_and_forwarding_number']", $clearance_and_forwarding->clearance_and_forwarding_number)
                ->assertSeeIn("tr:last-child td[field-key='border_post']", $clearance_and_forwarding->border_post)
                ->assertSeeIn("tr:last-child td[field-key='client']", $clearance_and_forwarding->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $clearance_and_forwarding->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='agent']", $clearance_and_forwarding->agent->name)
                ->assertSeeIn("tr:last-child td[field-key='agent_contact']", $clearance_and_forwarding->agent_contact->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='project_manager']", $clearance_and_forwarding->project_manager->name)
                ->logout();
        });
    }

    public function testEditClearanceAndForwarding()
    {
        $admin = \App\User::find(1);
        $clearance_and_forwarding = factory('App\ClearanceAndForwarding')->create();
        $clearance_and_forwarding2 = factory('App\ClearanceAndForwarding')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $clearance_and_forwarding, $clearance_and_forwarding2) {
            $browser->loginAs($admin)
                ->visit(route('admin.clearance_and_forwardings.index'))
                ->click('tr[data-entry-id="' . $clearance_and_forwarding->id . '"] .btn-info')
                ->select("project_number_id", $clearance_and_forwarding2->project_number_id)
                ->type("clearance_and_forwarding_number", $clearance_and_forwarding2->clearance_and_forwarding_number)
                ->type("border_post", $clearance_and_forwarding2->border_post)
                ->select("client_id", $clearance_and_forwarding2->client_id)
                ->select("contact_person_id", $clearance_and_forwarding2->contact_person_id)
                ->select("agent_id", $clearance_and_forwarding2->agent_id)
                ->select("agent_contact_id", $clearance_and_forwarding2->agent_contact_id)
                ->select("project_manager_id", $clearance_and_forwarding2->project_manager_id)
                ->press('Update')
                ->assertRouteIs('admin.clearance_and_forwardings.index')
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $clearance_and_forwarding2->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='clearance_and_forwarding_number']", $clearance_and_forwarding2->clearance_and_forwarding_number)
                ->assertSeeIn("tr:last-child td[field-key='border_post']", $clearance_and_forwarding2->border_post)
                ->assertSeeIn("tr:last-child td[field-key='client']", $clearance_and_forwarding2->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $clearance_and_forwarding2->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='agent']", $clearance_and_forwarding2->agent->name)
                ->assertSeeIn("tr:last-child td[field-key='agent_contact']", $clearance_and_forwarding2->agent_contact->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='project_manager']", $clearance_and_forwarding2->project_manager->name)
                ->logout();
        });
    }

    public function testShowClearanceAndForwarding()
    {
        $admin = \App\User::find(1);
        $clearance_and_forwarding = factory('App\ClearanceAndForwarding')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $clearance_and_forwarding) {
            $browser->loginAs($admin)
                ->visit(route('admin.clearance_and_forwardings.index'))
                ->click('tr[data-entry-id="' . $clearance_and_forwarding->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='project_number']", $clearance_and_forwarding->project_number->operation_number)
                ->assertSeeIn("td[field-key='clearance_and_forwarding_number']", $clearance_and_forwarding->clearance_and_forwarding_number)
                ->assertSeeIn("td[field-key='border_post']", $clearance_and_forwarding->border_post)
                ->assertSeeIn("td[field-key='client']", $clearance_and_forwarding->client->name)
                ->assertSeeIn("td[field-key='contact_person']", $clearance_and_forwarding->contact_person->contact_name)
                ->assertSeeIn("td[field-key='agent']", $clearance_and_forwarding->agent->name)
                ->assertSeeIn("td[field-key='agent_contact']", $clearance_and_forwarding->agent_contact->contact_name)
                ->assertSeeIn("td[field-key='project_manager']", $clearance_and_forwarding->project_manager->name)
                ->logout();
        });
    }

}
