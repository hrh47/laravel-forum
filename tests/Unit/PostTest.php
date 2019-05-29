<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function it_has_a_owner()
  {
  	$post = create('App\Post');

   	$this->assertInstanceOf('App\User', $post->user);
  }

  /** @test */
  public function it_belongs_to_a_group()
  {
  	$post = create('App\Post');

   	$this->assertInstanceOf('App\Group', $post->group);
  }
}
