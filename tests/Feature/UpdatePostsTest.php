<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdatePostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_may_not_update_posts()
    {
        $post = create('App\Post');
        $newPost = make('App\Post');

        $group = \App\Group::find($post->group_id);

        $response = $this->put(route('groups.posts.update', [$group, $post]), $newPost->toArray());
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_user_can_update_his_posts()
    {
        $user = $this->signIn();
        $post = create('App\Post',[
            'user_id' => $user->id
        ]);
        $newPost = make('App\Post');

        $group = \App\Group::find($post->group_id);

        $response = $this->put(route('groups.posts.update', [$group, $post]), $newPost->toArray());
        $response->assertRedirect(route('groups.show', $group));

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'content' => $newPost->content
        ]);
    }

    /** @test */
    public function a_user_cannot_update_his_post_with_empty_content()
    {
        $user = $this->signIn();
        $post = create('App\Post',[
            'user_id' => $user->id
        ]);

        $group = \App\Group::find($post->group_id);

        $response = $this->put(route('groups.posts.update', [$group, $post]), [
            'content' => ''
        ]);

        $response->assertSessionHasErrors([
            'content' => 'The content field is required.'
        ]);

        $this->assertDatabaseHas('posts', $post->toArray());
    }

    /** @test */
    public function an_user_cannot_update_posts_belong_to_another_user()
    {
        $user = $this->signIn();

        $anotherUser = create('App\User');
        $post = create('App\Post', [
            'user_id' => $anotherUser->id
        ]);
        $newPost = make('App\Post');

        $group = \App\Group::find($post->group_id);

        $this->assertTrue($user->id !== $anotherUser->id);

        $response = $this->put(route('groups.posts.update', [$group, $post]), $newPost->toArray());
        $response->assertStatus(403);

        $this->assertDatabaseHas('posts', $post->toArray());
    }
}
