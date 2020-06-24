<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ClientContactTest extends DuskTestCase
{

    public function testCreateClientContact()
    {
        $admin = \App\User::find(1);
        $client_contact = factory('App\ClientContact')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_contact) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_contacts.index'))
                ->clickLink('Add new')
                ->select("company_name_id", $client_contact->company_name_id)
                ->type("contact_name", $client_contact->contact_name)
                ->type("phone_number", $client_contact->phone_number)
                ->type("email", $client_contact->email)
                ->press('Save')
                ->assertRouteIs('admin.client_contacts.index')
                ->assertSeeIn("tr:last-child td[field-key='company_name']", $client_contact->company_name->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_name']", $client_contact->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='phone_number']", $client_contact->phone_number)
                ->assertSeeIn("tr:last-child td[field-key='email']", $client_contact->email)
                ->logout();
        });
    }

    public function testEditClientContact()
    {
        $admin = \App\User::find(1);
        $client_contact = factory('App\ClientContact')->create();
        $client_contact2 = factory('App\ClientContact')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_contact, $client_contact2) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_contacts.index'))
                ->click('tr[data-entry-id="' . $client_contact->id . '"] .btn-info')
                ->select("company_name_id", $client_contact2->company_name_id)
                ->type("contact_name", $client_contact2->contact_name)
                ->type("phone_number", $client_contact2->phone_number)
                ->type("email", $client_contact2->email)
                ->press('Update')
                ->assertRouteIs('admin.client_contacts.index')
                ->assertSeeIn("tr:last-child td[field-key='company_name']", $client_contact2->company_name->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_name']", $client_contact2->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='phone_number']", $client_contact2->phone_number)
                ->assertSeeIn("tr:last-child td[field-key='email']", $client_contact2->email)
                ->logout();
        });
    }

    public function testShowClientContact()
    {
        $admin = \App\User::find(1);
        $client_contact = factory('App\ClientContact')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $client_contact) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_contacts.index'))
                ->click('tr[data-entry-id="' . $client_contact->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='company_name']", $client_contact->company_name->name)
                ->assertSeeIn("td[field-key='contact_name']", $client_contact->contact_name)
                ->assertSeeIn("td[field-key='phone_number']", $client_contact->phone_number)
                ->assertSeeIn("td[field-key='email']", $client_contact->email)
                ->logout();
        });
    }

}
