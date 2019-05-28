<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateGroupsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_may_not_update_groups()
    {
        $group = create('App\Group');
        $newGroup = make('App\Group');

        $response = $this->put(route('groups.update', $group), $newGroup->toArray());
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_user_can_update_his_groups()
    {
        $user = $this->signIn();
        $group = create('App\Group',[
            'user_id' => $user->id
        ]);
        $newGroup = make('App\Group');

        $response = $this->put(route('groups.update', $group), $newGroup->toArray());
        $response->assertRedirect(route('groups.index'));

        $this->assertDatabaseHas('groups', [
            'title' => $newGroup->title,
            'description' => $newGroup->description,
            'user_id' => $user->id
        ]);
    }

    /** @test */
    public function an_user_cannot_update_groups_belong_to_another_user()
    {
        $user = $this->signIn();

        $anotherUser = create('App\User');
        $group = create('App\Group', [
            'user_id' => $anotherUser->id
        ]);
        $newGroup = make('App\Group');

        $this->assertTrue($user->id !== $anotherUser->id);

        $response = $this->put(route('groups.update', $group), $newGroup->toArray());
        $response->assertStatus(403);

        $this->assertDatabaseHas('groups', [
            'title' => $group->title,
            'description' => $group->description,
            'user_id' => $anotherUser->id
        ]);
    }
}
