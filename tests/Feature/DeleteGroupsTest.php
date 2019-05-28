<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DestroyGroupsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_may_not_delete_groups()
    {
        $group = create('App\Group');

        $response = $this->delete(route('groups.destroy', $group));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_user_can_delete_his_groups()
    {
        $user = $this->signIn();
        $group = create('App\Group',[
            'user_id' => $user->id
        ]);

        $response = $this->delete(route('groups.destroy', $group));
        $response->assertRedirect(route('groups.index'));

        $this->assertDatabaseMissing('groups', [
            'title' => $group->title,
            'description' => $group->description,
            'user_id' => $user->id
        ]);
    }

    /** @test */
    public function an_user_cannot_delete_groups_belong_to_another_user()
    {
        $user = $this->signIn();

        $anotherUser = create('App\User');
        $group = create('App\Group', [
            'user_id' => $anotherUser->id
        ]);

        $this->assertTrue($user->id !== $anotherUser->id);

        $response = $this->delete(route('groups.destroy', $group));
        $response->assertStatus(403);

        $this->assertDatabaseHas('groups', [
            'title' => $group->title,
            'description' => $group->description,
            'user_id' => $anotherUser->id
        ]);
    }
}
