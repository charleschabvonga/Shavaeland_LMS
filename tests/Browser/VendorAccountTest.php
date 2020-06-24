<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class VendorAccountTest extends DuskTestCase
{

    public function testCreateVendorAccount()
    {
        $admin = \App\User::find(1);
        $vendor_account = factory('App\VendorAccount')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $vendor_account) {
            $browser->loginAs($admin)
                ->visit(route('admin.vendor_accounts.index'))
                ->clickLink('Add new')
                ->select("vendor_id", $vendor_account->vendor_id)
                ->select("contact_person_id", $vendor_account->contact_person_id)
                ->select("account_manager_id", $vendor_account->account_manager_id)
                ->type("account_number", $vendor_account->account_number)
                ->select("status", $vendor_account->status)
                ->press('Save')
                ->assertRouteIs('admin.vendor_accounts.index')
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $vendor_account->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $vendor_account->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='account_manager']", $vendor_account->account_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='account_number']", $vendor_account->account_number)
                ->assertSeeIn("tr:last-child td[field-key='status']", $vendor_account->status)
                ->logout();
        });
    }

    public function testEditVendorAccount()
    {
        $admin = \App\User::find(1);
        $vendor_account = factory('App\VendorAccount')->create();
        $vendor_account2 = factory('App\VendorAccount')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $vendor_account, $vendor_account2) {
            $browser->loginAs($admin)
                ->visit(route('admin.vendor_accounts.index'))
                ->click('tr[data-entry-id="' . $vendor_account->id . '"] .btn-info')
                ->select("vendor_id", $vendor_account2->vendor_id)
                ->select("contact_person_id", $vendor_account2->contact_person_id)
                ->select("account_manager_id", $vendor_account2->account_manager_id)
                ->type("account_number", $vendor_account2->account_number)
                ->select("status", $vendor_account2->status)
                ->press('Update')
                ->assertRouteIs('admin.vendor_accounts.index')
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $vendor_account2->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $vendor_account2->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='account_manager']", $vendor_account2->account_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='account_number']", $vendor_account2->account_number)
                ->assertSeeIn("tr:last-child td[field-key='status']", $vendor_account2->status)
                ->logout();
        });
    }

    public function testShowVendorAccount()
    {
        $admin = \App\User::find(1);
        $vendor_account = factory('App\VendorAccount')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $vendor_account) {
            $browser->loginAs($admin)
                ->visit(route('admin.vendor_accounts.index'))
                ->click('tr[data-entry-id="' . $vendor_account->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='vendor']", $vendor_account->vendor->name)
                ->assertSeeIn("td[field-key='contact_person']", $vendor_account->contact_person->contact_name)
                ->assertSeeIn("td[field-key='account_manager']", $vendor_account->account_manager->name)
                ->assertSeeIn("td[field-key='account_number']", $vendor_account->account_number)
                ->assertSeeIn("td[field-key='status']", $vendor_account->status)
                ->logout();
        });
    }

}
