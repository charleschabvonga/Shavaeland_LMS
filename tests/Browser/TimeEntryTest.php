<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class TimeEntryTest extends DuskTestCase
{

    public function testCreateTimeEntry()
    {
        $admin = \App\User::find(1);
        $time_entry = factory('App\TimeEntry')->make();

        $relations = [
            factory('App\TimeWorkType')->create(), 
            factory('App\TimeWorkType')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $time_entry, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.time_entries.index'))
                ->clickLink('Add new')
                ->type("operation_number", $time_entry->operation_number)
                ->type("entry_date", $time_entry->entry_date)
                ->select('select[name="work_type[]"]', $relations[0]->id)
                ->select('select[name="work_type[]"]', $relations[1]->id)
                ->select("client_id", $time_entry->client_id)
                ->type("start_time", $time_entry->start_time)
                ->type("end_time", $time_entry->end_time)
                ->select("status", $time_entry->status)
                ->press('Save')
                ->assertRouteIs('admin.time_entries.index')
                ->assertSeeIn("tr:last-child td[field-key='operation_number']", $time_entry->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='entry_date']", $time_entry->entry_date)
                ->assertSeeIn("tr:last-child td[field-key='work_type'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='work_type'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='client']", $time_entry->client->name)
                ->assertSeeIn("tr:last-child td[field-key='start_time']", $time_entry->start_time)
                ->assertSeeIn("tr:last-child td[field-key='end_time']", $time_entry->end_time)
                ->assertSeeIn("tr:last-child td[field-key='status']", $time_entry->status)
                ->logout();
        });
    }

    public function testEditTimeEntry()
    {
        $admin = \App\User::find(1);
        $time_entry = factory('App\TimeEntry')->create();
        $time_entry2 = factory('App\TimeEntry')->make();

        $relations = [
            factory('App\TimeWorkType')->create(), 
            factory('App\TimeWorkType')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $time_entry, $time_entry2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.time_entries.index'))
                ->click('tr[data-entry-id="' . $time_entry->id . '"] .btn-info')
                ->type("operation_number", $time_entry2->operation_number)
                ->type("entry_date", $time_entry2->entry_date)
                ->select('select[name="work_type[]"]', $relations[0]->id)
                ->select('select[name="work_type[]"]', $relations[1]->id)
                ->select("client_id", $time_entry2->client_id)
                ->type("start_time", $time_entry2->start_time)
                ->type("end_time", $time_entry2->end_time)
                ->select("status", $time_entry2->status)
                ->press('Update')
                ->assertRouteIs('admin.time_entries.index')
                ->assertSeeIn("tr:last-child td[field-key='operation_number']", $time_entry2->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='entry_date']", $time_entry2->entry_date)
                ->assertSeeIn("tr:last-child td[field-key='work_type'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='work_type'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='client']", $time_entry2->client->name)
                ->assertSeeIn("tr:last-child td[field-key='start_time']", $time_entry2->start_time)
                ->assertSeeIn("tr:last-child td[field-key='end_time']", $time_entry2->end_time)
                ->assertSeeIn("tr:last-child td[field-key='status']", $time_entry2->status)
                ->logout();
        });
    }

    public function testShowTimeEntry()
    {
        $admin = \App\User::find(1);
        $time_entry = factory('App\TimeEntry')->create();

        $relations = [
            factory('App\TimeWorkType')->create(), 
            factory('App\TimeWorkType')->create(), 
        ];

        $time_entry->work_type()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $time_entry, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.time_entries.index'))
                ->click('tr[data-entry-id="' . $time_entry->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='operation_number']", $time_entry->operation_number)
                ->assertSeeIn("td[field-key='entry_date']", $time_entry->entry_date)
                ->assertSeeIn("tr:last-child td[field-key='work_type'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='work_type'] span:last-child", $relations[1]->name)
                ->assertSeeIn("td[field-key='client']", $time_entry->client->name)
                ->assertSeeIn("td[field-key='start_time']", $time_entry->start_time)
                ->assertSeeIn("td[field-key='end_time']", $time_entry->end_time)
                ->assertSeeIn("td[field-key='status']", $time_entry->status)
                ->logout();
        });
    }

}
