<?php

namespace App\Http\Controllers;

use App\{Group, Post};
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function create(Group $group)
    {
        return view('posts.create', compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Group $group)
    {
        $post = new Post($request->all());
        $post->group()->associate($group);

        auth()->user()->posts()->save($post);

        return redirect()->route('groups.show', $group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group, Post $post)
    {
        return view('posts.edit', compact('group', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group, Post $post)
    {
        //
    }
}
