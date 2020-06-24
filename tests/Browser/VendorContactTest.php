<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class VendorContactTest extends DuskTestCase
{

    public function testCreateVendorContact()
    {
        $admin = \App\User::find(1);
        $vendor_contact = factory('App\VendorContact')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $vendor_contact) {
            $browser->loginAs($admin)
                ->visit(route('admin.vendor_contacts.index'))
                ->clickLink('Add new')
                ->select("company_name_id", $vendor_contact->company_name_id)
                ->type("contact_name", $vendor_contact->contact_name)
                ->type("phone_number", $vendor_contact->phone_number)
                ->type("email", $vendor_contact->email)
                ->press('Save')
                ->assertRouteIs('admin.vendor_contacts.index')
                ->assertSeeIn("tr:last-child td[field-key='company_name']", $vendor_contact->company_name->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_name']", $vendor_contact->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='phone_number']", $vendor_contact->phone_number)
                ->assertSeeIn("tr:last-child td[field-key='email']", $vendor_contact->email)
                ->logout();
        });
    }

    public function testEditVendorContact()
    {
        $admin = \App\User::find(1);
        $vendor_contact = factory('App\VendorContact')->create();
        $vendor_contact2 = factory('App\VendorContact')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $vendor_contact, $vendor_contact2) {
            $browser->loginAs($admin)
                ->visit(route('admin.vendor_contacts.index'))
                ->click('tr[data-entry-id="' . $vendor_contact->id . '"] .btn-info')
                ->select("company_name_id", $vendor_contact2->company_name_id)
                ->type("contact_name", $vendor_contact2->contact_name)
                ->type("phone_number", $vendor_contact2->phone_number)
                ->type("email", $vendor_contact2->email)
                ->press('Update')
                ->assertRouteIs('admin.vendor_contacts.index')
                ->assertSeeIn("tr:last-child td[field-key='company_name']", $vendor_contact2->company_name->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_name']", $vendor_contact2->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='phone_number']", $vendor_contact2->phone_number)
                ->assertSeeIn("tr:last-child td[field-key='email']", $vendor_contact2->email)
                ->logout();
        });
    }

    public function testShowVendorContact()
    {
        $admin = \App\User::find(1);
        $vendor_contact = factory('App\VendorContact')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $vendor_contact) {
            $browser->loginAs($admin)
                ->visit(route('admin.vendor_contacts.index'))
                ->click('tr[data-entry-id="' . $vendor_contact->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='company_name']", $vendor_contact->company_name->name)
                ->assertSeeIn("td[field-key='contact_name']", $vendor_contact->contact_name)
                ->assertSeeIn("td[field-key='phone_number']", $vendor_contact->phone_number)
                ->assertSeeIn("td[field-key='email']", $vendor_contact->email)
                ->logout();
        });
    }

}
