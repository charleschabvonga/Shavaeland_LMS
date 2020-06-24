<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ExpenseCategoryTest extends DuskTestCase
{

    public function testCreateExpenseCategory()
    {
        $admin = \App\User::find(1);
        $expense_category = factory('App\ExpenseCategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $expense_category) {
            $browser->loginAs($admin)
                ->visit(route('admin.expense_categories.index'))
                ->clickLink('Add new')
                ->select("transaction_type_id", $expense_category->transaction_type_id)
                ->select("transaction_number_id", $expense_category->transaction_number_id)
                ->type("entry_date", $expense_category->entry_date)
                ->type("due_date", $expense_category->due_date)
                ->type("prepared_by", $expense_category->prepared_by)
                ->type("credit_note_number", $expense_category->credit_note_number)
                ->select("vendor_id", $expense_category->vendor_id)
                ->select("contact_person_id", $expense_category->contact_person_id)
                ->select("account_manager_id", $expense_category->account_manager_id)
                ->select("purchase_order_number_id", $expense_category->purchase_order_number_id)
                ->type("vendor_purchase_order_number", $expense_category->vendor_purchase_order_number)
                ->attach("upload_document", base_path("tests/_resources/test.jpg"))
                ->select("status", $expense_category->status)
                ->type("terms_and_conditions", $expense_category->terms_and_conditions)
                ->type("subtotal", $expense_category->subtotal)
                ->type("percent_discount", $expense_category->percent_discount)
                ->type("discount_amount", $expense_category->discount_amount)
                ->type("discounted_subtotal", $expense_category->discounted_subtotal)
                ->type("vat", $expense_category->vat)
                ->type("vat_amount", $expense_category->vat_amount)
                ->type("total_amount", $expense_category->total_amount)
                ->type("paid_to_date", $expense_category->paid_to_date)
                ->type("balance", $expense_category->balance)
                ->press('Save')
                ->assertRouteIs('admin.expense_categories.index')
                ->assertSeeIn("tr:last-child td[field-key='transaction_type']", $expense_category->transaction_type->name)
                ->assertSeeIn("tr:last-child td[field-key='transaction_number']", $expense_category->transaction_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='entry_date']", $expense_category->entry_date)
                ->assertSeeIn("tr:last-child td[field-key='due_date']", $expense_category->due_date)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $expense_category->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='credit_note_number']", $expense_category->credit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $expense_category->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $expense_category->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='account_manager']", $expense_category->account_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='purchase_order_number']", $expense_category->purchase_order_number->purchase_order_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor_purchase_order_number']", $expense_category->vendor_purchase_order_number)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\ExpenseCategory::first()->upload_document . "']")
                ->assertSeeIn("tr:last-child td[field-key='status']", $expense_category->status)
                ->assertSeeIn("tr:last-child td[field-key='terms_and_conditions']", $expense_category->terms_and_conditions)
                ->assertSeeIn("tr:last-child td[field-key='subtotal']", $expense_category->subtotal)
                ->assertSeeIn("tr:last-child td[field-key='percent_discount']", $expense_category->percent_discount)
                ->assertSeeIn("tr:last-child td[field-key='discount_amount']", $expense_category->discount_amount)
                ->assertSeeIn("tr:last-child td[field-key='discounted_subtotal']", $expense_category->discounted_subtotal)
                ->assertSeeIn("tr:last-child td[field-key='vat']", $expense_category->vat)
                ->assertSeeIn("tr:last-child td[field-key='vat_amount']", $expense_category->vat_amount)
                ->assertSeeIn("tr:last-child td[field-key='total_amount']", $expense_category->total_amount)
                ->assertSeeIn("tr:last-child td[field-key='paid_to_date']", $expense_category->paid_to_date)
                ->assertSeeIn("tr:last-child td[field-key='balance']", $expense_category->balance)
                ->logout();
        });
    }

    public function testEditExpenseCategory()
    {
        $admin = \App\User::find(1);
        $expense_category = factory('App\ExpenseCategory')->create();
        $expense_category2 = factory('App\ExpenseCategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $expense_category, $expense_category2) {
            $browser->loginAs($admin)
                ->visit(route('admin.expense_categories.index'))
                ->click('tr[data-entry-id="' . $expense_category->id . '"] .btn-info')
                ->select("transaction_type_id", $expense_category2->transaction_type_id)
                ->select("transaction_number_id", $expense_category2->transaction_number_id)
                ->type("entry_date", $expense_category2->entry_date)
                ->type("due_date", $expense_category2->due_date)
                ->type("prepared_by", $expense_category2->prepared_by)
                ->type("credit_note_number", $expense_category2->credit_note_number)
                ->select("vendor_id", $expense_category2->vendor_id)
                ->select("contact_person_id", $expense_category2->contact_person_id)
                ->select("account_manager_id", $expense_category2->account_manager_id)
                ->select("purchase_order_number_id", $expense_category2->purchase_order_number_id)
                ->type("vendor_purchase_order_number", $expense_category2->vendor_purchase_order_number)
                ->attach("upload_document", base_path("tests/_resources/test.jpg"))
                ->select("status", $expense_category2->status)
                ->type("terms_and_conditions", $expense_category2->terms_and_conditions)
                ->type("subtotal", $expense_category2->subtotal)
                ->type("percent_discount", $expense_category2->percent_discount)
                ->type("discount_amount", $expense_category2->discount_amount)
                ->type("discounted_subtotal", $expense_category2->discounted_subtotal)
                ->type("vat", $expense_category2->vat)
                ->type("vat_amount", $expense_category2->vat_amount)
                ->type("total_amount", $expense_category2->total_amount)
                ->type("paid_to_date", $expense_category2->paid_to_date)
                ->type("balance", $expense_category2->balance)
                ->press('Update')
                ->assertRouteIs('admin.expense_categories.index')
                ->assertSeeIn("tr:last-child td[field-key='transaction_type']", $expense_category2->transaction_type->name)
                ->assertSeeIn("tr:last-child td[field-key='transaction_number']", $expense_category2->transaction_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='entry_date']", $expense_category2->entry_date)
                ->assertSeeIn("tr:last-child td[field-key='due_date']", $expense_category2->due_date)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $expense_category2->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='credit_note_number']", $expense_category2->credit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $expense_category2->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $expense_category2->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='account_manager']", $expense_category2->account_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='purchase_order_number']", $expense_category2->purchase_order_number->purchase_order_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor_purchase_order_number']", $expense_category2->vendor_purchase_order_number)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\ExpenseCategory::first()->upload_document . "']")
                ->assertSeeIn("tr:last-child td[field-key='status']", $expense_category2->status)
                ->assertSeeIn("tr:last-child td[field-key='terms_and_conditions']", $expense_category2->terms_and_conditions)
                ->assertSeeIn("tr:last-child td[field-key='subtotal']", $expense_category2->subtotal)
                ->assertSeeIn("tr:last-child td[field-key='percent_discount']", $expense_category2->percent_discount)
                ->assertSeeIn("tr:last-child td[field-key='discount_amount']", $expense_category2->discount_amount)
                ->assertSeeIn("tr:last-child td[field-key='discounted_subtotal']", $expense_category2->discounted_subtotal)
                ->assertSeeIn("tr:last-child td[field-key='vat']", $expense_category2->vat)
                ->assertSeeIn("tr:last-child td[field-key='vat_amount']", $expense_category2->vat_amount)
                ->assertSeeIn("tr:last-child td[field-key='total_amount']", $expense_category2->total_amount)
                ->assertSeeIn("tr:last-child td[field-key='paid_to_date']", $expense_category2->paid_to_date)
                ->assertSeeIn("tr:last-child td[field-key='balance']", $expense_category2->balance)
                ->logout();
        });
    }

    public function testShowExpenseCategory()
    {
        $admin = \App\User::find(1);
        $expense_category = factory('App\ExpenseCategory')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $expense_category) {
            $browser->loginAs($admin)
                ->visit(route('admin.expense_categories.index'))
                ->click('tr[data-entry-id="' . $expense_category->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='transaction_type']", $expense_category->transaction_type->name)
                ->assertSeeIn("td[field-key='transaction_number']", $expense_category->transaction_number->operation_number)
                ->assertSeeIn("td[field-key='entry_date']", $expense_category->entry_date)
                ->assertSeeIn("td[field-key='due_date']", $expense_category->due_date)
                ->assertSeeIn("td[field-key='prepared_by']", $expense_category->prepared_by)
                ->assertSeeIn("td[field-key='credit_note_number']", $expense_category->credit_note_number)
                ->assertSeeIn("td[field-key='vendor']", $expense_category->vendor->name)
                ->assertSeeIn("td[field-key='contact_person']", $expense_category->contact_person->contact_name)
                ->assertSeeIn("td[field-key='account_manager']", $expense_category->account_manager->name)
                ->assertSeeIn("td[field-key='purchase_order_number']", $expense_category->purchase_order_number->purchase_order_number)
                ->assertSeeIn("td[field-key='vendor_purchase_order_number']", $expense_category->vendor_purchase_order_number)
                ->assertSeeIn("td[field-key='status']", $expense_category->status)
                ->assertSeeIn("td[field-key='terms_and_conditions']", $expense_category->terms_and_conditions)
                ->assertSeeIn("td[field-key='subtotal']", $expense_category->subtotal)
                ->assertSeeIn("td[field-key='percent_discount']", $expense_category->percent_discount)
                ->assertSeeIn("td[field-key='discount_amount']", $expense_category->discount_amount)
                ->assertSeeIn("td[field-key='discounted_subtotal']", $expense_category->discounted_subtotal)
                ->assertSeeIn("td[field-key='vat']", $expense_category->vat)
                ->assertSeeIn("td[field-key='vat_amount']", $expense_category->vat_amount)
                ->assertSeeIn("td[field-key='total_amount']", $expense_category->total_amount)
                ->assertSeeIn("td[field-key='paid_to_date']", $expense_category->paid_to_date)
                ->assertSeeIn("td[field-key='balance']", $expense_category->balance)
                ->logout();
        });
    }

}
