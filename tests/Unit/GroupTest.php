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
}
