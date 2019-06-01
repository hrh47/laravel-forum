<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountPostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_all_posts_he_created()
    {
        $user = $this->signIn();
        $post = create('App\Post', [
            'user_id' => $user->id
        ]);

        $response = $this->get(route('account.posts.index'));
        $response->assertSee($post->content);
    }
}
