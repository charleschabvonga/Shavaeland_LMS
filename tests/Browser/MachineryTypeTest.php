<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class MachineryTypeTest extends DuskTestCase
{

    public function testCreateMachineryType()
    {
        $admin = \App\User::find(1);
        $machinery_type = factory('App\MachineryType')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $machinery_type) {
            $browser->loginAs($admin)
                ->visit(route('admin.machinery_types.index'))
                ->clickLink('Add new')
                ->type("machinery_type", $machinery_type->machinery_type)
                ->select("attachment_id", $machinery_type->attachment_id)
                ->press('Save')
                ->assertRouteIs('admin.machinery_types.index')
                ->assertSeeIn("tr:last-child td[field-key='machinery_type']", $machinery_type->machinery_type)
                ->assertSeeIn("tr:last-child td[field-key='attachment']", $machinery_type->attachment->attachment)
                ->logout();
        });
    }

    public function testEditMachineryType()
    {
        $admin = \App\User::find(1);
        $machinery_type = factory('App\MachineryType')->create();
        $machinery_type2 = factory('App\MachineryType')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $machinery_type, $machinery_type2) {
            $browser->loginAs($admin)
                ->visit(route('admin.machinery_types.index'))
                ->click('tr[data-entry-id="' . $machinery_type->id . '"] .btn-info')
                ->type("machinery_type", $machinery_type2->machinery_type)
                ->select("attachment_id", $machinery_type2->attachment_id)
                ->press('Update')
                ->assertRouteIs('admin.machinery_types.index')
                ->assertSeeIn("tr:last-child td[field-key='machinery_type']", $machinery_type2->machinery_type)
                ->assertSeeIn("tr:last-child td[field-key='attachment']", $machinery_type2->attachment->attachment)
                ->logout();
        });
    }

    public function testShowMachineryType()
    {
        $admin = \App\User::find(1);
        $machinery_type = factory('App\MachineryType')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $machinery_type) {
            $browser->loginAs($admin)
                ->visit(route('admin.machinery_types.index'))
                ->click('tr[data-entry-id="' . $machinery_type->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='machinery_type']", $machinery_type->machinery_type)
                ->assertSeeIn("td[field-key='attachment']", $machinery_type->attachment->attachment)
                ->logout();
        });
    }

}
