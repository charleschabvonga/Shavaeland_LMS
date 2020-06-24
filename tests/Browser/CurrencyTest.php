<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CurrencyTest extends DuskTestCase
{

    public function testCreateCurrency()
    {
        $admin = \App\User::find(1);
        $currency = factory('App\Currency')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $currency) {
            $browser->loginAs($admin)
                ->visit(route('admin.currencies.index'))
                ->clickLink('Add new')
                ->type("name", $currency->name)
                ->type("symbol", $currency->symbol)
                ->press('Save')
                ->assertRouteIs('admin.currencies.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $currency->name)
                ->assertSeeIn("tr:last-child td[field-key='symbol']", $currency->symbol)
                ->logout();
        });
    }

    public function testEditCurrency()
    {
        $admin = \App\User::find(1);
        $currency = factory('App\Currency')->create();
        $currency2 = factory('App\Currency')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $currency, $currency2) {
            $browser->loginAs($admin)
                ->visit(route('admin.currencies.index'))
                ->click('tr[data-entry-id="' . $currency->id . '"] .btn-info')
                ->type("name", $currency2->name)
                ->type("symbol", $currency2->symbol)
                ->press('Update')
                ->assertRouteIs('admin.currencies.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $currency2->name)
                ->assertSeeIn("tr:last-child td[field-key='symbol']", $currency2->symbol)
                ->logout();
        });
    }

    public function testShowCurrency()
    {
        $admin = \App\User::find(1);
        $currency = factory('App\Currency')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $currency) {
            $browser->loginAs($admin)
                ->visit(route('admin.currencies.index'))
                ->click('tr[data-entry-id="' . $currency->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $currency->name)
                ->assertSeeIn("td[field-key='symbol']", $currency->symbol)
                ->logout();
        });
    }

}
