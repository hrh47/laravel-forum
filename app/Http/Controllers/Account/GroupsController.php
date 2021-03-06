<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupsController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

  public function index()
  {
  	$groups = auth()->user()->participatedGroups;

   	return view('account.groups.index', compact('groups'));
  }
}
