<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class IncomeCategoryTest extends DuskTestCase
{

    public function testCreateIncomeCategory()
    {
        $admin = \App\User::find(1);
        $income_category = factory('App\IncomeCategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $income_category) {
            $browser->loginAs($admin)
                ->visit(route('admin.income_categories.index'))
                ->clickLink('Add new')
                ->select("project_type_id", $income_category->project_type_id)
                ->select("project_number_id", $income_category->project_number_id)
                ->type("entry_date", $income_category->entry_date)
                ->type("due_date", $income_category->due_date)
                ->type("prepared_by", $income_category->prepared_by)
                ->type("invoice_number", $income_category->invoice_number)
                ->select("client_id", $income_category->client_id)
                ->select("contact_person_id", $income_category->contact_person_id)
                ->select("account_manager_id", $income_category->account_manager_id)
                ->select("quotation_number_id", $income_category->quotation_number_id)
                ->type("sales_order_number", $income_category->sales_order_number)
                ->select("status", $income_category->status)
                ->type("subtotal", $income_category->subtotal)
                ->type("percent_discount", $income_category->percent_discount)
                ->type("discount_amount", $income_category->discount_amount)
                ->type("discounted_subtotal", $income_category->discounted_subtotal)
                ->type("vat", $income_category->vat)
                ->type("vat_amount", $income_category->vat_amount)
                ->type("total_amount", $income_category->total_amount)
                ->type("paid_to_date", $income_category->paid_to_date)
                ->type("balance", $income_category->balance)
                ->press('Save')
                ->assertRouteIs('admin.income_categories.index')
                ->assertSeeIn("tr:last-child td[field-key='project_type']", $income_category->project_type->name)
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $income_category->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='entry_date']", $income_category->entry_date)
                ->assertSeeIn("tr:last-child td[field-key='due_date']", $income_category->due_date)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $income_category->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='invoice_number']", $income_category->invoice_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $income_category->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $income_category->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='account_manager']", $income_category->account_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='quotation_number']", $income_category->quotation_number->quotation_number)
                ->assertSeeIn("tr:last-child td[field-key='sales_order_number']", $income_category->sales_order_number)
                ->assertSeeIn("tr:last-child td[field-key='status']", $income_category->status)
                ->assertSeeIn("tr:last-child td[field-key='subtotal']", $income_category->subtotal)
                ->assertSeeIn("tr:last-child td[field-key='percent_discount']", $income_category->percent_discount)
                ->assertSeeIn("tr:last-child td[field-key='discount_amount']", $income_category->discount_amount)
                ->assertSeeIn("tr:last-child td[field-key='discounted_subtotal']", $income_category->discounted_subtotal)
                ->assertSeeIn("tr:last-child td[field-key='vat']", $income_category->vat)
                ->assertSeeIn("tr:last-child td[field-key='vat_amount']", $income_category->vat_amount)
                ->assertSeeIn("tr:last-child td[field-key='total_amount']", $income_category->total_amount)
                ->assertSeeIn("tr:last-child td[field-key='paid_to_date']", $income_category->paid_to_date)
                ->assertSeeIn("tr:last-child td[field-key='balance']", $income_category->balance)
                ->logout();
        });
    }

    public function testEditIncomeCategory()
    {
        $admin = \App\User::find(1);
        $income_category = factory('App\IncomeCategory')->create();
        $income_category2 = factory('App\IncomeCategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $income_category, $income_category2) {
            $browser->loginAs($admin)
                ->visit(route('admin.income_categories.index'))
                ->click('tr[data-entry-id="' . $income_category->id . '"] .btn-info')
                ->select("project_type_id", $income_category2->project_type_id)
                ->select("project_number_id", $income_category2->project_number_id)
                ->type("entry_date", $income_category2->entry_date)
                ->type("due_date", $income_category2->due_date)
                ->type("prepared_by", $income_category2->prepared_by)
                ->type("invoice_number", $income_category2->invoice_number)
                ->select("client_id", $income_category2->client_id)
                ->select("contact_person_id", $income_category2->contact_person_id)
                ->select("account_manager_id", $income_category2->account_manager_id)
                ->select("quotation_number_id", $income_category2->quotation_number_id)
                ->type("sales_order_number", $income_category2->sales_order_number)
                ->select("status", $income_category2->status)
                ->type("subtotal", $income_category2->subtotal)
                ->type("percent_discount", $income_category2->percent_discount)
                ->type("discount_amount", $income_category2->discount_amount)
                ->type("discounted_subtotal", $income_category2->discounted_subtotal)
                ->type("vat", $income_category2->vat)
                ->type("vat_amount", $income_category2->vat_amount)
                ->type("total_amount", $income_category2->total_amount)
                ->type("paid_to_date", $income_category2->paid_to_date)
                ->type("balance", $income_category2->balance)
                ->press('Update')
                ->assertRouteIs('admin.income_categories.index')
                ->assertSeeIn("tr:last-child td[field-key='project_type']", $income_category2->project_type->name)
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $income_category2->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='entry_date']", $income_category2->entry_date)
                ->assertSeeIn("tr:last-child td[field-key='due_date']", $income_category2->due_date)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $income_category2->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='invoice_number']", $income_category2->invoice_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $income_category2->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $income_category2->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='account_manager']", $income_category2->account_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='quotation_number']", $income_category2->quotation_number->quotation_number)
                ->assertSeeIn("tr:last-child td[field-key='sales_order_number']", $income_category2->sales_order_number)
                ->assertSeeIn("tr:last-child td[field-key='status']", $income_category2->status)
                ->assertSeeIn("tr:last-child td[field-key='subtotal']", $income_category2->subtotal)
                ->assertSeeIn("tr:last-child td[field-key='percent_discount']", $income_category2->percent_discount)
                ->assertSeeIn("tr:last-child td[field-key='discount_amount']", $income_category2->discount_amount)
                ->assertSeeIn("tr:last-child td[field-key='discounted_subtotal']", $income_category2->discounted_subtotal)
                ->assertSeeIn("tr:last-child td[field-key='vat']", $income_category2->vat)
                ->assertSeeIn("tr:last-child td[field-key='vat_amount']", $income_category2->vat_amount)
                ->assertSeeIn("tr:last-child td[field-key='total_amount']", $income_category2->total_amount)
                ->assertSeeIn("tr:last-child td[field-key='paid_to_date']", $income_category2->paid_to_date)
                ->assertSeeIn("tr:last-child td[field-key='balance']", $income_category2->balance)
                ->logout();
        });
    }

    public function testShowIncomeCategory()
    {
        $admin = \App\User::find(1);
        $income_category = factory('App\IncomeCategory')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $income_category) {
            $browser->loginAs($admin)
                ->visit(route('admin.income_categories.index'))
                ->click('tr[data-entry-id="' . $income_category->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='project_type']", $income_category->project_type->name)
                ->assertSeeIn("td[field-key='project_number']", $income_category->project_number->operation_number)
                ->assertSeeIn("td[field-key='entry_date']", $income_category->entry_date)
                ->assertSeeIn("td[field-key='due_date']", $income_category->due_date)
                ->assertSeeIn("td[field-key='prepared_by']", $income_category->prepared_by)
                ->assertSeeIn("td[field-key='invoice_number']", $income_category->invoice_number)
                ->assertSeeIn("td[field-key='client']", $income_category->client->name)
                ->assertSeeIn("td[field-key='contact_person']", $income_category->contact_person->contact_name)
                ->assertSeeIn("td[field-key='account_manager']", $income_category->account_manager->name)
                ->assertSeeIn("td[field-key='quotation_number']", $income_category->quotation_number->quotation_number)
                ->assertSeeIn("td[field-key='sales_order_number']", $income_category->sales_order_number)
                ->assertSeeIn("td[field-key='status']", $income_category->status)
                ->assertSeeIn("td[field-key='subtotal']", $income_category->subtotal)
                ->assertSeeIn("td[field-key='percent_discount']", $income_category->percent_discount)
                ->assertSeeIn("td[field-key='discount_amount']", $income_category->discount_amount)
                ->assertSeeIn("td[field-key='discounted_subtotal']", $income_category->discounted_subtotal)
                ->assertSeeIn("td[field-key='vat']", $income_category->vat)
                ->assertSeeIn("td[field-key='vat_amount']", $income_category->vat_amount)
                ->assertSeeIn("td[field-key='total_amount']", $income_category->total_amount)
                ->assertSeeIn("td[field-key='paid_to_date']", $income_category->paid_to_date)
                ->assertSeeIn("td[field-key='balance']", $income_category->balance)
                ->logout();
        });
    }

}
