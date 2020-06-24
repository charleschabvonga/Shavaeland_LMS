<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class LoadingRequirementTest extends DuskTestCase
{

    public function testCreateLoadingRequirement()
    {
        $admin = \App\User::find(1);
        $loading_requirement = factory('App\LoadingRequirement')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $loading_requirement) {
            $browser->loginAs($admin)
                ->visit(route('admin.loading_requirements.index'))
                ->clickLink('Add new')
                ->select("loading_instruction_number_id", $loading_requirement->loading_instruction_number_id)
                ->type("item_description", $loading_requirement->item_description)
                ->type("qty", $loading_requirement->qty)
                ->type("unit", $loading_requirement->unit)
                ->press('Save')
                ->assertRouteIs('admin.loading_requirements.index')
                ->assertSeeIn("tr:last-child td[field-key='loading_instruction_number']", $loading_requirement->loading_instruction_number->loading_instruction_number)
                ->assertSeeIn("tr:last-child td[field-key='item_description']", $loading_requirement->item_description)
                ->assertSeeIn("tr:last-child td[field-key='qty']", $loading_requirement->qty)
                ->assertSeeIn("tr:last-child td[field-key='unit']", $loading_requirement->unit)
                ->logout();
        });
    }

    public function testEditLoadingRequirement()
    {
        $admin = \App\User::find(1);
        $loading_requirement = factory('App\LoadingRequirement')->create();
        $loading_requirement2 = factory('App\LoadingRequirement')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $loading_requirement, $loading_requirement2) {
            $browser->loginAs($admin)
                ->visit(route('admin.loading_requirements.index'))
                ->click('tr[data-entry-id="' . $loading_requirement->id . '"] .btn-info')
                ->select("loading_instruction_number_id", $loading_requirement2->loading_instruction_number_id)
                ->type("item_description", $loading_requirement2->item_description)
                ->type("qty", $loading_requirement2->qty)
                ->type("unit", $loading_requirement2->unit)
                ->press('Update')
                ->assertRouteIs('admin.loading_requirements.index')
                ->assertSeeIn("tr:last-child td[field-key='loading_instruction_number']", $loading_requirement2->loading_instruction_number->loading_instruction_number)
                ->assertSeeIn("tr:last-child td[field-key='item_description']", $loading_requirement2->item_description)
                ->assertSeeIn("tr:last-child td[field-key='qty']", $loading_requirement2->qty)
                ->assertSeeIn("tr:last-child td[field-key='unit']", $loading_requirement2->unit)
                ->logout();
        });
    }

    public function testShowLoadingRequirement()
    {
        $admin = \App\User::find(1);
        $loading_requirement = factory('App\LoadingRequirement')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $loading_requirement) {
            $browser->loginAs($admin)
                ->visit(route('admin.loading_requirements.index'))
                ->click('tr[data-entry-id="' . $loading_requirement->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='loading_instruction_number']", $loading_requirement->loading_instruction_number->loading_instruction_number)
                ->assertSeeIn("td[field-key='item_description']", $loading_requirement->item_description)
                ->assertSeeIn("td[field-key='qty']", $loading_requirement->qty)
                ->assertSeeIn("td[field-key='unit']", $loading_requirement->unit)
                ->logout();
        });
    }

}
