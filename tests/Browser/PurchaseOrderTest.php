<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PurchaseOrderTest extends DuskTestCase
{

    public function testCreatePurchaseOrder()
    {
        $admin = \App\User::find(1);
        $purchase_order = factory('App\PurchaseOrder')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $purchase_order) {
            $browser->loginAs($admin)
                ->visit(route('admin.purchase_orders.index'))
                ->clickLink('Add new')
                ->select("vendor_id", $purchase_order->vendor_id)
                ->select("contact_person_id", $purchase_order->contact_person_id)
                ->select("buyer_id", $purchase_order->buyer_id)
                ->type("purchase_order_number", $purchase_order->purchase_order_number)
                ->type("date", $purchase_order->date)
                ->type("request_date", $purchase_order->request_date)
                ->type("procurement_date", $purchase_order->procurement_date)
                ->type("subtotal", $purchase_order->subtotal)
                ->select("status", $purchase_order->status)
                ->type("vat", $purchase_order->vat)
                ->type("vat_amount", $purchase_order->vat_amount)
                ->type("total_amount", $purchase_order->total_amount)
                ->type("prepared_by", $purchase_order->prepared_by)
                ->type("requested_by", $purchase_order->requested_by)
                ->check("hod")
                ->check("gm")
                ->check("accounts")
                ->press('Save')
                ->assertRouteIs('admin.purchase_orders.index')
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $purchase_order->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $purchase_order->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='buyer']", $purchase_order->buyer->name)
                ->assertSeeIn("tr:last-child td[field-key='purchase_order_number']", $purchase_order->purchase_order_number)
                ->assertSeeIn("tr:last-child td[field-key='date']", $purchase_order->date)
                ->assertSeeIn("tr:last-child td[field-key='request_date']", $purchase_order->request_date)
                ->assertSeeIn("tr:last-child td[field-key='procurement_date']", $purchase_order->procurement_date)
                ->assertSeeIn("tr:last-child td[field-key='subtotal']", $purchase_order->subtotal)
                ->assertSeeIn("tr:last-child td[field-key='status']", $purchase_order->status)
                ->assertSeeIn("tr:last-child td[field-key='vat']", $purchase_order->vat)
                ->assertSeeIn("tr:last-child td[field-key='vat_amount']", $purchase_order->vat_amount)
                ->assertSeeIn("tr:last-child td[field-key='total_amount']", $purchase_order->total_amount)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $purchase_order->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='requested_by']", $purchase_order->requested_by)
                ->assertChecked("hod")
                ->assertChecked("gm")
                ->assertChecked("accounts")
                ->logout();
        });
    }

    public function testEditPurchaseOrder()
    {
        $admin = \App\User::find(1);
        $purchase_order = factory('App\PurchaseOrder')->create();
        $purchase_order2 = factory('App\PurchaseOrder')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $purchase_order, $purchase_order2) {
            $browser->loginAs($admin)
                ->visit(route('admin.purchase_orders.index'))
                ->click('tr[data-entry-id="' . $purchase_order->id . '"] .btn-info')
                ->select("vendor_id", $purchase_order2->vendor_id)
                ->select("contact_person_id", $purchase_order2->contact_person_id)
                ->select("buyer_id", $purchase_order2->buyer_id)
                ->type("purchase_order_number", $purchase_order2->purchase_order_number)
                ->type("date", $purchase_order2->date)
                ->type("request_date", $purchase_order2->request_date)
                ->type("procurement_date", $purchase_order2->procurement_date)
                ->type("subtotal", $purchase_order2->subtotal)
                ->select("status", $purchase_order2->status)
                ->type("vat", $purchase_order2->vat)
                ->type("vat_amount", $purchase_order2->vat_amount)
                ->type("total_amount", $purchase_order2->total_amount)
                ->type("prepared_by", $purchase_order2->prepared_by)
                ->type("requested_by", $purchase_order2->requested_by)
                ->check("hod")
                ->check("gm")
                ->check("accounts")
                ->press('Update')
                ->assertRouteIs('admin.purchase_orders.index')
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $purchase_order2->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $purchase_order2->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='buyer']", $purchase_order2->buyer->name)
                ->assertSeeIn("tr:last-child td[field-key='purchase_order_number']", $purchase_order2->purchase_order_number)
                ->assertSeeIn("tr:last-child td[field-key='date']", $purchase_order2->date)
                ->assertSeeIn("tr:last-child td[field-key='request_date']", $purchase_order2->request_date)
                ->assertSeeIn("tr:last-child td[field-key='procurement_date']", $purchase_order2->procurement_date)
                ->assertSeeIn("tr:last-child td[field-key='subtotal']", $purchase_order2->subtotal)
                ->assertSeeIn("tr:last-child td[field-key='status']", $purchase_order2->status)
                ->assertSeeIn("tr:last-child td[field-key='vat']", $purchase_order2->vat)
                ->assertSeeIn("tr:last-child td[field-key='vat_amount']", $purchase_order2->vat_amount)
                ->assertSeeIn("tr:last-child td[field-key='total_amount']", $purchase_order2->total_amount)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $purchase_order2->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='requested_by']", $purchase_order2->requested_by)
                ->assertChecked("hod")
                ->assertChecked("gm")
                ->assertChecked("accounts")
                ->logout();
        });
    }

    public function testShowPurchaseOrder()
    {
        $admin = \App\User::find(1);
        $purchase_order = factory('App\PurchaseOrder')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $purchase_order) {
            $browser->loginAs($admin)
                ->visit(route('admin.purchase_orders.index'))
                ->click('tr[data-entry-id="' . $purchase_order->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='vendor']", $purchase_order->vendor->name)
                ->assertSeeIn("td[field-key='contact_person']", $purchase_order->contact_person->contact_name)
                ->assertSeeIn("td[field-key='buyer']", $purchase_order->buyer->name)
                ->assertSeeIn("td[field-key='purchase_order_number']", $purchase_order->purchase_order_number)
                ->assertSeeIn("td[field-key='date']", $purchase_order->date)
                ->assertSeeIn("td[field-key='request_date']", $purchase_order->request_date)
                ->assertSeeIn("td[field-key='procurement_date']", $purchase_order->procurement_date)
                ->assertSeeIn("td[field-key='subtotal']", $purchase_order->subtotal)
                ->assertSeeIn("td[field-key='status']", $purchase_order->status)
                ->assertSeeIn("td[field-key='vat']", $purchase_order->vat)
                ->assertSeeIn("td[field-key='vat_amount']", $purchase_order->vat_amount)
                ->assertSeeIn("td[field-key='total_amount']", $purchase_order->total_amount)
                ->assertSeeIn("td[field-key='prepared_by']", $purchase_order->prepared_by)
                ->assertSeeIn("td[field-key='requested_by']", $purchase_order->requested_by)
                ->assertNotChecked("hod")
                ->assertNotChecked("gm")
                ->assertNotChecked("accounts")
                ->logout();
        });
    }

}
