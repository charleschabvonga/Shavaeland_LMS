<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class TimeWorkTypeTest extends DuskTestCase
{

    public function testCreateTimeWorkType()
    {
        $admin = \App\User::find(1);
        $time_work_type = factory('App\TimeWorkType')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $time_work_type) {
            $browser->loginAs($admin)
                ->visit(route('admin.time_work_types.index'))
                ->clickLink('Add new')
                ->type("name", $time_work_type->name)
                ->press('Save')
                ->assertRouteIs('admin.time_work_types.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $time_work_type->name)
                ->logout();
        });
    }

    public function testEditTimeWorkType()
    {
        $admin = \App\User::find(1);
        $time_work_type = factory('App\TimeWorkType')->create();
        $time_work_type2 = factory('App\TimeWorkType')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $time_work_type, $time_work_type2) {
            $browser->loginAs($admin)
                ->visit(route('admin.time_work_types.index'))
                ->click('tr[data-entry-id="' . $time_work_type->id . '"] .btn-info')
                ->type("name", $time_work_type2->name)
                ->press('Update')
                ->assertRouteIs('admin.time_work_types.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $time_work_type2->name)
                ->logout();
        });
    }

    public function testShowTimeWorkType()
    {
        $admin = \App\User::find(1);
        $time_work_type = factory('App\TimeWorkType')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $time_work_type) {
            $browser->loginAs($admin)
                ->visit(route('admin.time_work_types.index'))
                ->click('tr[data-entry-id="' . $time_work_type->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $time_work_type->name)
                ->logout();
        });
    }

}
