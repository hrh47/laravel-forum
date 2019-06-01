<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeletePostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_may_not_delete_posts()
    {
        $post = create('App\Post');
        $group = \App\Group::find($post->id);

        $response = $this->delete(route('groups.posts.destroy', [$group, $post]));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_user_can_delete_his_posts()
    {
        $user = $this->signIn();
        $post = create('App\Post',[
            'user_id' => $user->id
        ]);
        $group = \App\Group::find($post->id);

        $this->app['session']->setPreviousUrl(route('groups.show', $group));
        $response = $this->delete(route('groups.posts.destroy', [$group, $post]));
        $response->assertRedirect(route('groups.show', $group));

        $this->assertDatabaseMissing('posts', $post->toArray());
    }

    /** @test */
    public function an_user_cannot_delete_posts_belong_to_another_user()
    {
        $user = $this->signIn();

        $anotherUser = create('App\User');
        $post = create('App\Post', [
            'user_id' => $anotherUser->id
        ]);
        $group = \App\Group::find($post->id);

        $this->assertTrue($user->id !== $anotherUser->id);

        $this->app['session']->setPreviousUrl(route('groups.show', $group));
        $response = $this->delete(route('groups.posts.destroy', [$group, $post]));
        $response->assertStatus(403);

        $this->assertDatabaseHas('groups', $group->toArray());
    }
}
