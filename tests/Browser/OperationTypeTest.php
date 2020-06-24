<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class OperationTypeTest extends DuskTestCase
{

    public function testCreateOperationType()
    {
        $admin = \App\User::find(1);
        $operation_type = factory('App\OperationType')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $operation_type) {
            $browser->loginAs($admin)
                ->visit(route('admin.operation_types.index'))
                ->clickLink('Add new')
                ->type("name", $operation_type->name)
                ->press('Save')
                ->assertRouteIs('admin.operation_types.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $operation_type->name)
                ->logout();
        });
    }

    public function testEditOperationType()
    {
        $admin = \App\User::find(1);
        $operation_type = factory('App\OperationType')->create();
        $operation_type2 = factory('App\OperationType')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $operation_type, $operation_type2) {
            $browser->loginAs($admin)
                ->visit(route('admin.operation_types.index'))
                ->click('tr[data-entry-id="' . $operation_type->id . '"] .btn-info')
                ->type("name", $operation_type2->name)
                ->press('Update')
                ->assertRouteIs('admin.operation_types.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $operation_type2->name)
                ->logout();
        });
    }

    public function testShowOperationType()
    {
        $admin = \App\User::find(1);
        $operation_type = factory('App\OperationType')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $operation_type) {
            $browser->loginAs($admin)
                ->visit(route('admin.operation_types.index'))
                ->click('tr[data-entry-id="' . $operation_type->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $operation_type->name)
                ->logout();
        });
    }

}
