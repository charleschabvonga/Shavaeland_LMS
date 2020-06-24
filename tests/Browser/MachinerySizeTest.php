<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class MachinerySizeTest extends DuskTestCase
{

    public function testCreateMachinerySize()
    {
        $admin = \App\User::find(1);
        $machinery_size = factory('App\MachinerySize')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $machinery_size) {
            $browser->loginAs($admin)
                ->visit(route('admin.machinery_sizes.index'))
                ->clickLink('Add new')
                ->type("size", $machinery_size->size)
                ->select("attachment_id", $machinery_size->attachment_id)
                ->press('Save')
                ->assertRouteIs('admin.machinery_sizes.index')
                ->assertSeeIn("tr:last-child td[field-key='size']", $machinery_size->size)
                ->assertSeeIn("tr:last-child td[field-key='attachment']", $machinery_size->attachment->attachment)
                ->logout();
        });
    }

    public function testEditMachinerySize()
    {
        $admin = \App\User::find(1);
        $machinery_size = factory('App\MachinerySize')->create();
        $machinery_size2 = factory('App\MachinerySize')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $machinery_size, $machinery_size2) {
            $browser->loginAs($admin)
                ->visit(route('admin.machinery_sizes.index'))
                ->click('tr[data-entry-id="' . $machinery_size->id . '"] .btn-info')
                ->type("size", $machinery_size2->size)
                ->select("attachment_id", $machinery_size2->attachment_id)
                ->press('Update')
                ->assertRouteIs('admin.machinery_sizes.index')
                ->assertSeeIn("tr:last-child td[field-key='size']", $machinery_size2->size)
                ->assertSeeIn("tr:last-child td[field-key='attachment']", $machinery_size2->attachment->attachment)
                ->logout();
        });
    }

    public function testShowMachinerySize()
    {
        $admin = \App\User::find(1);
        $machinery_size = factory('App\MachinerySize')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $machinery_size) {
            $browser->loginAs($admin)
                ->visit(route('admin.machinery_sizes.index'))
                ->click('tr[data-entry-id="' . $machinery_size->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='size']", $machinery_size->size)
                ->assertSeeIn("td[field-key='attachment']", $machinery_size->attachment->attachment)
                ->logout();
        });
    }

}
