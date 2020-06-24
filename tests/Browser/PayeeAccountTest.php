<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PayeeAccountTest extends DuskTestCase
{

    public function testCreatePayeeAccount()
    {
        $admin = \App\User::find(1);
        $payee_account = factory('App\PayeeAccount')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $payee_account) {
            $browser->loginAs($admin)
                ->visit(route('admin.payee_accounts.index'))
                ->clickLink('Add new')
                ->select("employee_id", $payee_account->employee_id)
                ->type("bank", $payee_account->bank)
                ->type("account_number", $payee_account->account_number)
                ->type("branch_code", $payee_account->branch_code)
                ->type("branch", $payee_account->branch)
                ->select("department_id", $payee_account->department_id)
                ->select("position_id", $payee_account->position_id)
                ->select("status", $payee_account->status)
                ->select("pymt_measurement_type", $payee_account->pymt_measurement_type)
                ->type("wage_rate", $payee_account->wage_rate)
                ->type("pension_rate", $payee_account->pension_rate)
                ->type("overtime_rate", $payee_account->overtime_rate)
                ->type("public_holiday_rate", $payee_account->public_holiday_rate)
                ->type("medical_aid", $payee_account->medical_aid)
                ->type("sales_rate", $payee_account->sales_rate)
                ->press('Save')
                ->assertRouteIs('admin.payee_accounts.index')
                ->assertSeeIn("tr:last-child td[field-key='employee']", $payee_account->employee->name)
                ->assertSeeIn("tr:last-child td[field-key='bank']", $payee_account->bank)
                ->assertSeeIn("tr:last-child td[field-key='account_number']", $payee_account->account_number)
                ->assertSeeIn("tr:last-child td[field-key='branch_code']", $payee_account->branch_code)
                ->assertSeeIn("tr:last-child td[field-key='branch']", $payee_account->branch)
                ->assertSeeIn("tr:last-child td[field-key='department']", $payee_account->department->dept_name)
                ->assertSeeIn("tr:last-child td[field-key='position']", $payee_account->position->position)
                ->assertSeeIn("tr:last-child td[field-key='status']", $payee_account->status)
                ->assertSeeIn("tr:last-child td[field-key='pymt_measurement_type']", $payee_account->pymt_measurement_type)
                ->assertSeeIn("tr:last-child td[field-key='wage_rate']", $payee_account->wage_rate)
                ->assertSeeIn("tr:last-child td[field-key='pension_rate']", $payee_account->pension_rate)
                ->assertSeeIn("tr:last-child td[field-key='overtime_rate']", $payee_account->overtime_rate)
                ->assertSeeIn("tr:last-child td[field-key='public_holiday_rate']", $payee_account->public_holiday_rate)
                ->assertSeeIn("tr:last-child td[field-key='medical_aid']", $payee_account->medical_aid)
                ->assertSeeIn("tr:last-child td[field-key='sales_rate']", $payee_account->sales_rate)
                ->logout();
        });
    }

    public function testEditPayeeAccount()
    {
        $admin = \App\User::find(1);
        $payee_account = factory('App\PayeeAccount')->create();
        $payee_account2 = factory('App\PayeeAccount')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $payee_account, $payee_account2) {
            $browser->loginAs($admin)
                ->visit(route('admin.payee_accounts.index'))
                ->click('tr[data-entry-id="' . $payee_account->id . '"] .btn-info')
                ->select("employee_id", $payee_account2->employee_id)
                ->type("bank", $payee_account2->bank)
                ->type("account_number", $payee_account2->account_number)
                ->type("branch_code", $payee_account2->branch_code)
                ->type("branch", $payee_account2->branch)
                ->select("department_id", $payee_account2->department_id)
                ->select("position_id", $payee_account2->position_id)
                ->select("status", $payee_account2->status)
                ->select("pymt_measurement_type", $payee_account2->pymt_measurement_type)
                ->type("wage_rate", $payee_account2->wage_rate)
                ->type("pension_rate", $payee_account2->pension_rate)
                ->type("overtime_rate", $payee_account2->overtime_rate)
                ->type("public_holiday_rate", $payee_account2->public_holiday_rate)
                ->type("medical_aid", $payee_account2->medical_aid)
                ->type("sales_rate", $payee_account2->sales_rate)
                ->press('Update')
                ->assertRouteIs('admin.payee_accounts.index')
                ->assertSeeIn("tr:last-child td[field-key='employee']", $payee_account2->employee->name)
                ->assertSeeIn("tr:last-child td[field-key='bank']", $payee_account2->bank)
                ->assertSeeIn("tr:last-child td[field-key='account_number']", $payee_account2->account_number)
                ->assertSeeIn("tr:last-child td[field-key='branch_code']", $payee_account2->branch_code)
                ->assertSeeIn("tr:last-child td[field-key='branch']", $payee_account2->branch)
                ->assertSeeIn("tr:last-child td[field-key='department']", $payee_account2->department->dept_name)
                ->assertSeeIn("tr:last-child td[field-key='position']", $payee_account2->position->position)
                ->assertSeeIn("tr:last-child td[field-key='status']", $payee_account2->status)
                ->assertSeeIn("tr:last-child td[field-key='pymt_measurement_type']", $payee_account2->pymt_measurement_type)
                ->assertSeeIn("tr:last-child td[field-key='wage_rate']", $payee_account2->wage_rate)
                ->assertSeeIn("tr:last-child td[field-key='pension_rate']", $payee_account2->pension_rate)
                ->assertSeeIn("tr:last-child td[field-key='overtime_rate']", $payee_account2->overtime_rate)
                ->assertSeeIn("tr:last-child td[field-key='public_holiday_rate']", $payee_account2->public_holiday_rate)
                ->assertSeeIn("tr:last-child td[field-key='medical_aid']", $payee_account2->medical_aid)
                ->assertSeeIn("tr:last-child td[field-key='sales_rate']", $payee_account2->sales_rate)
                ->logout();
        });
    }

    public function testShowPayeeAccount()
    {
        $admin = \App\User::find(1);
        $payee_account = factory('App\PayeeAccount')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $payee_account) {
            $browser->loginAs($admin)
                ->visit(route('admin.payee_accounts.index'))
                ->click('tr[data-entry-id="' . $payee_account->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='employee']", $payee_account->employee->name)
                ->assertSeeIn("td[field-key='bank']", $payee_account->bank)
                ->assertSeeIn("td[field-key='account_number']", $payee_account->account_number)
                ->assertSeeIn("td[field-key='branch_code']", $payee_account->branch_code)
                ->assertSeeIn("td[field-key='branch']", $payee_account->branch)
                ->assertSeeIn("td[field-key='department']", $payee_account->department->dept_name)
                ->assertSeeIn("td[field-key='position']", $payee_account->position->position)
                ->assertSeeIn("td[field-key='status']", $payee_account->status)
                ->assertSeeIn("td[field-key='pymt_measurement_type']", $payee_account->pymt_measurement_type)
                ->assertSeeIn("td[field-key='wage_rate']", $payee_account->wage_rate)
                ->assertSeeIn("td[field-key='pension_rate']", $payee_account->pension_rate)
                ->assertSeeIn("td[field-key='overtime_rate']", $payee_account->overtime_rate)
                ->assertSeeIn("td[field-key='public_holiday_rate']", $payee_account->public_holiday_rate)
                ->assertSeeIn("td[field-key='medical_aid']", $payee_account->medical_aid)
                ->assertSeeIn("td[field-key='sales_rate']", $payee_account->sales_rate)
                ->logout();
        });
    }

}
