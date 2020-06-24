<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ReceivingTest extends DuskTestCase
{

    public function testCreateReceiving()
    {
        $admin = \App\User::find(1);
        $receiving = factory('App\Receiving')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $receiving) {
            $browser->loginAs($admin)
                ->visit(route('admin.receivings.index'))
                ->clickLink('Add new')
                ->type("date", $receiving->date)
                ->select("project_number_id", $receiving->project_number_id)
                ->select("warehouse_id", $receiving->warehouse_id)
                ->type("receipt_number", $receiving->receipt_number)
                ->type("prepared_by", $receiving->prepared_by)
                ->select("client_id", $receiving->client_id)
                ->select("contact_person_id", $receiving->contact_person_id)
                ->select("received_by_id", $receiving->received_by_id)
                ->select("project_manager_id", $receiving->project_manager_id)
                ->type("rate", $receiving->rate)
                ->type("days", $receiving->days)
                ->type("total_area_coverd", $receiving->total_area_coverd)
                ->type("total_amount", $receiving->total_amount)
                ->press('Save')
                ->assertRouteIs('admin.receivings.index')
                ->assertSeeIn("tr:last-child td[field-key='date']", $receiving->date)
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $receiving->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='warehouse']", $receiving->warehouse->center_name)
                ->assertSeeIn("tr:last-child td[field-key='receipt_number']", $receiving->receipt_number)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $receiving->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='client']", $receiving->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $receiving->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='received_by']", $receiving->received_by->name)
                ->assertSeeIn("tr:last-child td[field-key='project_manager']", $receiving->project_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='rate']", $receiving->rate)
                ->assertSeeIn("tr:last-child td[field-key='days']", $receiving->days)
                ->assertSeeIn("tr:last-child td[field-key='total_area_coverd']", $receiving->total_area_coverd)
                ->assertSeeIn("tr:last-child td[field-key='total_amount']", $receiving->total_amount)
                ->logout();
        });
    }

    public function testEditReceiving()
    {
        $admin = \App\User::find(1);
        $receiving = factory('App\Receiving')->create();
        $receiving2 = factory('App\Receiving')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $receiving, $receiving2) {
            $browser->loginAs($admin)
                ->visit(route('admin.receivings.index'))
                ->click('tr[data-entry-id="' . $receiving->id . '"] .btn-info')
                ->type("date", $receiving2->date)
                ->select("project_number_id", $receiving2->project_number_id)
                ->select("warehouse_id", $receiving2->warehouse_id)
                ->type("receipt_number", $receiving2->receipt_number)
                ->type("prepared_by", $receiving2->prepared_by)
                ->select("client_id", $receiving2->client_id)
                ->select("contact_person_id", $receiving2->contact_person_id)
                ->select("received_by_id", $receiving2->received_by_id)
                ->select("project_manager_id", $receiving2->project_manager_id)
                ->type("rate", $receiving2->rate)
                ->type("days", $receiving2->days)
                ->type("total_area_coverd", $receiving2->total_area_coverd)
                ->type("total_amount", $receiving2->total_amount)
                ->press('Update')
                ->assertRouteIs('admin.receivings.index')
                ->assertSeeIn("tr:last-child td[field-key='date']", $receiving2->date)
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $receiving2->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='warehouse']", $receiving2->warehouse->center_name)
                ->assertSeeIn("tr:last-child td[field-key='receipt_number']", $receiving2->receipt_number)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $receiving2->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='client']", $receiving2->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $receiving2->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='received_by']", $receiving2->received_by->name)
                ->assertSeeIn("tr:last-child td[field-key='project_manager']", $receiving2->project_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='rate']", $receiving2->rate)
                ->assertSeeIn("tr:last-child td[field-key='days']", $receiving2->days)
                ->assertSeeIn("tr:last-child td[field-key='total_area_coverd']", $receiving2->total_area_coverd)
                ->assertSeeIn("tr:last-child td[field-key='total_amount']", $receiving2->total_amount)
                ->logout();
        });
    }

    public function testShowReceiving()
    {
        $admin = \App\User::find(1);
        $receiving = factory('App\Receiving')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $receiving) {
            $browser->loginAs($admin)
                ->visit(route('admin.receivings.index'))
                ->click('tr[data-entry-id="' . $receiving->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='date']", $receiving->date)
                ->assertSeeIn("td[field-key='project_number']", $receiving->project_number->operation_number)
                ->assertSeeIn("td[field-key='warehouse']", $receiving->warehouse->center_name)
                ->assertSeeIn("td[field-key='receipt_number']", $receiving->receipt_number)
                ->assertSeeIn("td[field-key='prepared_by']", $receiving->prepared_by)
                ->assertSeeIn("td[field-key='client']", $receiving->client->name)
                ->assertSeeIn("td[field-key='contact_person']", $receiving->contact_person->contact_name)
                ->assertSeeIn("td[field-key='received_by']", $receiving->received_by->name)
                ->assertSeeIn("td[field-key='project_manager']", $receiving->project_manager->name)
                ->assertSeeIn("td[field-key='rate']", $receiving->rate)
                ->assertSeeIn("td[field-key='days']", $receiving->days)
                ->assertSeeIn("td[field-key='total_area_coverd']", $receiving->total_area_coverd)
                ->assertSeeIn("td[field-key='total_amount']", $receiving->total_amount)
                ->logout();
        });
    }

}
