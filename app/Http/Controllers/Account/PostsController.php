<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}


  public function index()
  {
  	$posts = auth()->user()->posts()->paginate(5);

  	return view('account.posts.index', compact('posts'));
  }
}
