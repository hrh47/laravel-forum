<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatePostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_may_not_create_posts()
    {
        $group = create('App\Group');
        $post = make('App\Post');

        $response = $this->post(route('groups.posts.store', $group), $post->toArray());

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function a_user_in_the_group_can_create_new_posts()
    {
        $user = create('App\User');
        $group = create('App\Group');
        if (! $user->isMemberOf($group)) {
            $user->join($group);
        }
        
        $user = \App\User::find($user->id);
        $this->actingAs($user);

        $post = make('App\Post');

        $response = $this->post(route('groups.posts.store', $group), $post->toArray());

        $response->assertRedirect(route('groups.show', $group));

        $this->assertDatabaseHas('posts', [
            'content' => $post->content,
            'user_id' => $user->id,
            'group_id' => $group->id
        ]);
    }

    /** @test */
    public function a_user_cannot_create_new_posts_in_the_group_he_does_not_join()
    {
        $user = $this->signIn();
        $group = create('App\Group');
        
        $this->assertTrue(! $user->isMemberOf($group));

        $post = make('App\Post');

        $response = $this->post(route('groups.posts.store', $group), $post->toArray());
        $response->assertStatus(403);

        $this->assertDatabaseMissing('posts', [
            'content' => $post->content,
            'user_id' => $user->id,
            'group_id' => $group->id
        ]);
    }

    /** @test */
    public function a_user_cannot_create_a_group_with_empty_title()
    {
        $user = $this->signIn();
        $group = make('App\Group', [
            'title' => '',
            'user_id' => $user->id
        ]);

        $response = $this->post(route('groups.store'), $group->toArray());

        $response->assertSessionHasErrors([
            'title' => 'The title field is required.'
        ]);

        $this->assertDatabaseMissing('groups', $group->toArray());
    }
}
