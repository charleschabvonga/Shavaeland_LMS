<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ClientAccountTest extends DuskTestCase
{

    public function testCreateClientAccount()
    {
        $admin = \App\User::find(1);
        $client_account = factory('App\ClientAccount')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_account) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_accounts.index'))
                ->clickLink('Add new')
                ->select("client_id", $client_account->client_id)
                ->select("contact_person_id", $client_account->contact_person_id)
                ->select("account_manager_id", $client_account->account_manager_id)
                ->type("account_number", $client_account->account_number)
                ->select("status", $client_account->status)
                ->press('Save')
                ->assertRouteIs('admin.client_accounts.index')
                ->assertSeeIn("tr:last-child td[field-key='client']", $client_account->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $client_account->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='account_manager']", $client_account->account_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='account_number']", $client_account->account_number)
                ->assertSeeIn("tr:last-child td[field-key='status']", $client_account->status)
                ->logout();
        });
    }

    public function testEditClientAccount()
    {
        $admin = \App\User::find(1);
        $client_account = factory('App\ClientAccount')->create();
        $client_account2 = factory('App\ClientAccount')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $client_account, $client_account2) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_accounts.index'))
                ->click('tr[data-entry-id="' . $client_account->id . '"] .btn-info')
                ->select("client_id", $client_account2->client_id)
                ->select("contact_person_id", $client_account2->contact_person_id)
                ->select("account_manager_id", $client_account2->account_manager_id)
                ->type("account_number", $client_account2->account_number)
                ->select("status", $client_account2->status)
                ->press('Update')
                ->assertRouteIs('admin.client_accounts.index')
                ->assertSeeIn("tr:last-child td[field-key='client']", $client_account2->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $client_account2->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='account_manager']", $client_account2->account_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='account_number']", $client_account2->account_number)
                ->assertSeeIn("tr:last-child td[field-key='status']", $client_account2->status)
                ->logout();
        });
    }

    public function testShowClientAccount()
    {
        $admin = \App\User::find(1);
        $client_account = factory('App\ClientAccount')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $client_account) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_accounts.index'))
                ->click('tr[data-entry-id="' . $client_account->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='client']", $client_account->client->name)
                ->assertSeeIn("td[field-key='contact_person']", $client_account->contact_person->contact_name)
                ->assertSeeIn("td[field-key='account_manager']", $client_account->account_manager->name)
                ->assertSeeIn("td[field-key='account_number']", $client_account->account_number)
                ->assertSeeIn("td[field-key='status']", $client_account->status)
                ->logout();
        });
    }

}
