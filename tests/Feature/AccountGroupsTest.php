<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountGroupsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_all_groups_he_joins()
    {
        $user = $this->signIn();
        $group = create('App\Group', [
            'user_id' => $user->id
        ]);
        $user->join($group);

        $response = $this->get(route('account.groups.index'));
        $response->assertSee($group->title)
            ->assertSee($group->description);
    }
}
