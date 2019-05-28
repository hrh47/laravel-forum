<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateGroupsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_may_not_create_groups()
    {
        $group = make('App\Group');

        $response = $this->post(route('groups.store'), $group->toArray());

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_user_can_create_new_groups()
    {
        $user = $this->signIn();

        $group = make('App\Group');

        $response = $this->post(route('groups.store'), $group->toArray());

        $response->assertRedirect(route('groups.index'));

        $this->assertDatabaseHas('groups', [
            'title' => $group->title,
            'description' => $group->description,
            'user_id' => $user->id
        ]);
    }
}
