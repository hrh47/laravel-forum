<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
	use RefreshDatabase;

  /** @test */
  function a_user_has_groups()
  {
  	$user = create('App\User');

   	$this->assertInstanceOf(
   		'Illuminate\Database\Eloquent\Collection', $user->groups
   	);
  }

  /** @test */
  function a_user_has_posts()
  {
  	$user = create('App\User');

   	$this->assertInstanceOf(
   		'Illuminate\Database\Eloquent\Collection', $user->posts
   	);
  }

  /** @test */
  function a_user_can_join_a_group()
  {
    $user = create('App\User');
    $group = create('App\Group');

    $this->assertTrue(! $user->isMemberOf($group));

    $user->join($group);
    $user = \App\User::find($user->id);
    $this->assertTrue($user->isMemberOf($group));
  }

  /** @test */
  function a_user_can_quit_a_group()
  {
    $user = create('App\User');
    $group = create('App\Group');

    $user->join($group);
    $user = \App\User::find($user->id);
    $this->assertTrue($user->isMemberOf($group));

    $user->quit($group);
    $user = \App\User::find($user->id);
    $this->assertTrue(! $user->isMemberOf($group));
  }
}
