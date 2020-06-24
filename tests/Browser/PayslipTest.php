<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PayslipTest extends DuskTestCase
{

    public function testCreatePayslip()
    {
        $admin = \App\User::find(1);
        $payslip = factory('App\Payslip')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $payslip) {
            $browser->loginAs($admin)
                ->visit(route('admin.payslips.index'))
                ->clickLink('Add new')
                ->type("date", $payslip->date)
                ->type("starting_date", $payslip->starting_date)
                ->type("ending_date", $payslip->ending_date)
                ->select("employee_id", $payslip->employee_id)
                ->select("batch_number_id", $payslip->batch_number_id)
                ->select("account_number_id", $payslip->account_number_id)
                ->type("payslip_number", $payslip->payslip_number)
                ->select("status", $payslip->status)
                ->type("overtime_and_bonus_total", $payslip->overtime_and_bonus_total)
                ->type("deductions_total", $payslip->deductions_total)
                ->type("gross", $payslip->gross)
                ->type("income_tax", $payslip->income_tax)
                ->type("income_tax_amount", $payslip->income_tax_amount)
                ->type("net_income", $payslip->net_income)
                ->type("paid_to_date", $payslip->paid_to_date)
                ->type("balance", $payslip->balance)
                ->type("prepared_by", $payslip->prepared_by)
                ->press('Save')
                ->assertRouteIs('admin.payslips.index')
                ->assertSeeIn("tr:last-child td[field-key='date']", $payslip->date)
                ->assertSeeIn("tr:last-child td[field-key='starting_date']", $payslip->starting_date)
                ->assertSeeIn("tr:last-child td[field-key='ending_date']", $payslip->ending_date)
                ->assertSeeIn("tr:last-child td[field-key='employee']", $payslip->employee->name)
                ->assertSeeIn("tr:last-child td[field-key='batch_number']", $payslip->batch_number->batch_number)
                ->assertSeeIn("tr:last-child td[field-key='account_number']", $payslip->account_number->account_number)
                ->assertSeeIn("tr:last-child td[field-key='payslip_number']", $payslip->payslip_number)
                ->assertSeeIn("tr:last-child td[field-key='status']", $payslip->status)
                ->assertSeeIn("tr:last-child td[field-key='overtime_and_bonus_total']", $payslip->overtime_and_bonus_total)
                ->assertSeeIn("tr:last-child td[field-key='deductions_total']", $payslip->deductions_total)
                ->assertSeeIn("tr:last-child td[field-key='gross']", $payslip->gross)
                ->assertSeeIn("tr:last-child td[field-key='income_tax']", $payslip->income_tax)
                ->assertSeeIn("tr:last-child td[field-key='income_tax_amount']", $payslip->income_tax_amount)
                ->assertSeeIn("tr:last-child td[field-key='net_income']", $payslip->net_income)
                ->assertSeeIn("tr:last-child td[field-key='paid_to_date']", $payslip->paid_to_date)
                ->assertSeeIn("tr:last-child td[field-key='balance']", $payslip->balance)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $payslip->prepared_by)
                ->logout();
        });
    }

    public function testEditPayslip()
    {
        $admin = \App\User::find(1);
        $payslip = factory('App\Payslip')->create();
        $payslip2 = factory('App\Payslip')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $payslip, $payslip2) {
            $browser->loginAs($admin)
                ->visit(route('admin.payslips.index'))
                ->click('tr[data-entry-id="' . $payslip->id . '"] .btn-info')
                ->type("date", $payslip2->date)
                ->type("starting_date", $payslip2->starting_date)
                ->type("ending_date", $payslip2->ending_date)
                ->select("employee_id", $payslip2->employee_id)
                ->select("batch_number_id", $payslip2->batch_number_id)
                ->select("account_number_id", $payslip2->account_number_id)
                ->type("payslip_number", $payslip2->payslip_number)
                ->select("status", $payslip2->status)
                ->type("overtime_and_bonus_total", $payslip2->overtime_and_bonus_total)
                ->type("deductions_total", $payslip2->deductions_total)
                ->type("gross", $payslip2->gross)
                ->type("income_tax", $payslip2->income_tax)
                ->type("income_tax_amount", $payslip2->income_tax_amount)
                ->type("net_income", $payslip2->net_income)
                ->type("paid_to_date", $payslip2->paid_to_date)
                ->type("balance", $payslip2->balance)
                ->type("prepared_by", $payslip2->prepared_by)
                ->press('Update')
                ->assertRouteIs('admin.payslips.index')
                ->assertSeeIn("tr:last-child td[field-key='date']", $payslip2->date)
                ->assertSeeIn("tr:last-child td[field-key='starting_date']", $payslip2->starting_date)
                ->assertSeeIn("tr:last-child td[field-key='ending_date']", $payslip2->ending_date)
                ->assertSeeIn("tr:last-child td[field-key='employee']", $payslip2->employee->name)
                ->assertSeeIn("tr:last-child td[field-key='batch_number']", $payslip2->batch_number->batch_number)
                ->assertSeeIn("tr:last-child td[field-key='account_number']", $payslip2->account_number->account_number)
                ->assertSeeIn("tr:last-child td[field-key='payslip_number']", $payslip2->payslip_number)
                ->assertSeeIn("tr:last-child td[field-key='status']", $payslip2->status)
                ->assertSeeIn("tr:last-child td[field-key='overtime_and_bonus_total']", $payslip2->overtime_and_bonus_total)
                ->assertSeeIn("tr:last-child td[field-key='deductions_total']", $payslip2->deductions_total)
                ->assertSeeIn("tr:last-child td[field-key='gross']", $payslip2->gross)
                ->assertSeeIn("tr:last-child td[field-key='income_tax']", $payslip2->income_tax)
                ->assertSeeIn("tr:last-child td[field-key='income_tax_amount']", $payslip2->income_tax_amount)
                ->assertSeeIn("tr:last-child td[field-key='net_income']", $payslip2->net_income)
                ->assertSeeIn("tr:last-child td[field-key='paid_to_date']", $payslip2->paid_to_date)
                ->assertSeeIn("tr:last-child td[field-key='balance']", $payslip2->balance)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $payslip2->prepared_by)
                ->logout();
        });
    }

    public function testShowPayslip()
    {
        $admin = \App\User::find(1);
        $payslip = factory('App\Payslip')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $payslip) {
            $browser->loginAs($admin)
                ->visit(route('admin.payslips.index'))
                ->click('tr[data-entry-id="' . $payslip->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='date']", $payslip->date)
                ->assertSeeIn("td[field-key='starting_date']", $payslip->starting_date)
                ->assertSeeIn("td[field-key='ending_date']", $payslip->ending_date)
                ->assertSeeIn("td[field-key='employee']", $payslip->employee->name)
                ->assertSeeIn("td[field-key='batch_number']", $payslip->batch_number->batch_number)
                ->assertSeeIn("td[field-key='account_number']", $payslip->account_number->account_number)
                ->assertSeeIn("td[field-key='payslip_number']", $payslip->payslip_number)
                ->assertSeeIn("td[field-key='status']", $payslip->status)
                ->assertSeeIn("td[field-key='overtime_and_bonus_total']", $payslip->overtime_and_bonus_total)
                ->assertSeeIn("td[field-key='deductions_total']", $payslip->deductions_total)
                ->assertSeeIn("td[field-key='gross']", $payslip->gross)
                ->assertSeeIn("td[field-key='income_tax']", $payslip->income_tax)
                ->assertSeeIn("td[field-key='income_tax_amount']", $payslip->income_tax_amount)
                ->assertSeeIn("td[field-key='net_income']", $payslip->net_income)
                ->assertSeeIn("td[field-key='paid_to_date']", $payslip->paid_to_date)
                ->assertSeeIn("td[field-key='balance']", $payslip->balance)
                ->assertSeeIn("td[field-key='prepared_by']", $payslip->prepared_by)
                ->logout();
        });
    }

}
