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
}
