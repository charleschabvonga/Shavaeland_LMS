<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class SalariesRequestTotalTest extends DuskTestCase
{

    public function testCreateSalariesRequestTotal()
    {
        $admin = \App\User::find(1);
        $salaries_request_total = factory('App\SalariesRequestTotal')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $salaries_request_total) {
            $browser->loginAs($admin)
                ->visit(route('admin.salaries_request_totals.index'))
                ->clickLink('Add new')
                ->type("batch_number", $salaries_request_total->batch_number)
                ->type("starting_pay_date", $salaries_request_total->starting_pay_date)
                ->type("ending_pay_date", $salaries_request_total->ending_pay_date)
                ->select("status", $salaries_request_total->status)
                ->press('Save')
                ->assertRouteIs('admin.salaries_request_totals.index')
                ->assertSeeIn("tr:last-child td[field-key='batch_number']", $salaries_request_total->batch_number)
                ->assertSeeIn("tr:last-child td[field-key='starting_pay_date']", $salaries_request_total->starting_pay_date)
                ->assertSeeIn("tr:last-child td[field-key='ending_pay_date']", $salaries_request_total->ending_pay_date)
                ->assertSeeIn("tr:last-child td[field-key='status']", $salaries_request_total->status)
                ->logout();
        });
    }

    public function testEditSalariesRequestTotal()
    {
        $admin = \App\User::find(1);
        $salaries_request_total = factory('App\SalariesRequestTotal')->create();
        $salaries_request_total2 = factory('App\SalariesRequestTotal')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $salaries_request_total, $salaries_request_total2) {
            $browser->loginAs($admin)
                ->visit(route('admin.salaries_request_totals.index'))
                ->click('tr[data-entry-id="' . $salaries_request_total->id . '"] .btn-info')
                ->type("batch_number", $salaries_request_total2->batch_number)
                ->type("starting_pay_date", $salaries_request_total2->starting_pay_date)
                ->type("ending_pay_date", $salaries_request_total2->ending_pay_date)
                ->select("status", $salaries_request_total2->status)
                ->press('Update')
                ->assertRouteIs('admin.salaries_request_totals.index')
                ->assertSeeIn("tr:last-child td[field-key='batch_number']", $salaries_request_total2->batch_number)
                ->assertSeeIn("tr:last-child td[field-key='starting_pay_date']", $salaries_request_total2->starting_pay_date)
                ->assertSeeIn("tr:last-child td[field-key='ending_pay_date']", $salaries_request_total2->ending_pay_date)
                ->assertSeeIn("tr:last-child td[field-key='status']", $salaries_request_total2->status)
                ->logout();
        });
    }

    public function testShowSalariesRequestTotal()
    {
        $admin = \App\User::find(1);
        $salaries_request_total = factory('App\SalariesRequestTotal')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $salaries_request_total) {
            $browser->loginAs($admin)
                ->visit(route('admin.salaries_request_totals.index'))
                ->click('tr[data-entry-id="' . $salaries_request_total->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='batch_number']", $salaries_request_total->batch_number)
                ->assertSeeIn("td[field-key='starting_pay_date']", $salaries_request_total->starting_pay_date)
                ->assertSeeIn("td[field-key='ending_pay_date']", $salaries_request_total->ending_pay_date)
                ->assertSeeIn("td[field-key='status']", $salaries_request_total->status)
                ->logout();
        });
    }

}
