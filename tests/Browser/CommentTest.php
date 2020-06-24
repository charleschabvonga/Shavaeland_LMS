<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CommentTest extends DuskTestCase
{

    public function testCreateComment()
    {
        $admin = \App\User::find(1);
        $comment = factory('App\Comment')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $comment) {
            $browser->loginAs($admin)
                ->visit(route('admin.comments.index'))
                ->clickLink('Add new')
                ->type("name", $comment->name)
                ->type("email", $comment->email)
                ->type("comments", $comment->comments)
                ->press('Save')
                ->assertRouteIs('admin.comments.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $comment->name)
                ->assertSeeIn("tr:last-child td[field-key='email']", $comment->email)
                ->assertSeeIn("tr:last-child td[field-key='comments']", $comment->comments)
                ->logout();
        });
    }

    public function testEditComment()
    {
        $admin = \App\User::find(1);
        $comment = factory('App\Comment')->create();
        $comment2 = factory('App\Comment')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $comment, $comment2) {
            $browser->loginAs($admin)
                ->visit(route('admin.comments.index'))
                ->click('tr[data-entry-id="' . $comment->id . '"] .btn-info')
                ->type("name", $comment2->name)
                ->type("email", $comment2->email)
                ->type("comments", $comment2->comments)
                ->press('Update')
                ->assertRouteIs('admin.comments.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $comment2->name)
                ->assertSeeIn("tr:last-child td[field-key='email']", $comment2->email)
                ->assertSeeIn("tr:last-child td[field-key='comments']", $comment2->comments)
                ->logout();
        });
    }

    public function testShowComment()
    {
        $admin = \App\User::find(1);
        $comment = factory('App\Comment')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $comment) {
            $browser->loginAs($admin)
                ->visit(route('admin.comments.index'))
                ->click('tr[data-entry-id="' . $comment->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $comment->name)
                ->assertSeeIn("td[field-key='email']", $comment->email)
                ->assertSeeIn("td[field-key='comments']", $comment->comments)
                ->logout();
        });
    }

}
