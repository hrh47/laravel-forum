<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JoinGroupsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_may_not_join_groups()
    {
        $group = create('App\Group');

        $response = $this->post(route('groups.join', $group));

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_user_can_join_a_group()
    {
        $user = $this->signIn();
        $group = create('App\Group');

        $response = $this->post(route('groups.join', $group));

        $response->assertRedirect(route('groups.show', $group));

        $user = \App\User::find($user->id);

        $this->assertTrue($user->isMemberOf($group));
    }

    /** @test */
    public function an_authenticated_user_can_quit_a_group()
    {
        $user = $this->signIn();
        $group = create('App\Group');
        $user->join($group);

        $user = \App\User::find($user->id);
        $this->assertTrue($user->isMemberOf($group));

        $response = $this->post(route('groups.quit', $group));

        $response->assertRedirect(route('groups.show', $group));

        $user = \App\User::find($user->id);

        $this->assertTrue(! $user->isMemberOf($group));
    }
}
