<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RouteTest extends DuskTestCase
{

    public function testCreateRoute()
    {
        $admin = \App\User::find(1);
        $route = factory('App\Route')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $route) {
            $browser->loginAs($admin)
                ->visit(route('admin.routes.index'))
                ->clickLink('Add new')
                ->type("route", $route->route)
                ->type("distance", $route->distance)
                ->press('Save')
                ->assertRouteIs('admin.routes.index')
                ->assertSeeIn("tr:last-child td[field-key='route']", $route->route)
                ->assertSeeIn("tr:last-child td[field-key='distance']", $route->distance)
                ->logout();
        });
    }

    public function testEditRoute()
    {
        $admin = \App\User::find(1);
        $route = factory('App\Route')->create();
        $route2 = factory('App\Route')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $route, $route2) {
            $browser->loginAs($admin)
                ->visit(route('admin.routes.index'))
                ->click('tr[data-entry-id="' . $route->id . '"] .btn-info')
                ->type("route", $route2->route)
                ->type("distance", $route2->distance)
                ->press('Update')
                ->assertRouteIs('admin.routes.index')
                ->assertSeeIn("tr:last-child td[field-key='route']", $route2->route)
                ->assertSeeIn("tr:last-child td[field-key='distance']", $route2->distance)
                ->logout();
        });
    }

    public function testShowRoute()
    {
        $admin = \App\User::find(1);
        $route = factory('App\Route')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $route) {
            $browser->loginAs($admin)
                ->visit(route('admin.routes.index'))
                ->click('tr[data-entry-id="' . $route->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='route']", $route->route)
                ->assertSeeIn("td[field-key='distance']", $route->distance)
                ->logout();
        });
    }

}
