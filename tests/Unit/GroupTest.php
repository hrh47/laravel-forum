<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GroupTest extends TestCase
{
	use RefreshDatabase;

  /** @test */
  public function it_has_a_owner()
  {
  	$group = factory('App\Group')->create();

   	$this->assertInstanceOf('App\User', $group->user);
  }

  /** @test */
  function a_group_has_posts()
  {
  	$group = create('App\Group');

   	$this->assertInstanceOf(
   		'Illuminate\Database\Eloquent\Collection', $group->posts
   	);
  }

  /** @test */
  function a_group_can_add_a_post()
  {
		$user = create('App\User');  
  	$group = create('App\Group');

  	$post = create('App\Post', [
  		'user_id' => $user->id,
  		'group_id' => $group->id
  	]);
  	$this->assertCount(1, $group->posts);
  	$this->assertTrue($group->posts->contains($post));
  }
}
