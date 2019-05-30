<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadPostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_group_posts()
    {
        $post = create('App\Post');
        $group = \App\Group::find($post->group_id);

        $response = $this->get(route('groups.show', $group));
        $response->assertSee($post->content);
    }
}
