<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadGroupsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_all_groups()
    {
        $group1 = factory('App\Group')->create();
        $group2 = factory('App\Group')->create();

        $response = $this->get(route('groups.index'));
        $response->assertSee($group1->title);
        $response->assertSee($group1->description);

        $response->assertSee($group2->title);
        $response->assertSee($group2->description);
    }

    /** @test */
    public function a_user_view_a_single_group()
    {
        $group = factory('App\Group')->create();

        $response = $this->get(route('groups.show', $group));
        $response->assertSee($group->title);
        $response->assertSee($group->description);
    }
}
