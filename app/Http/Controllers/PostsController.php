<?php

namespace App\Http\Controllers;

use App\{Group, Post};
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:update,post')->only(['edit', 'update', 'destroy']);
        $this->middleware('can:createPost,group')->only(['store']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function create(Group $group)
    {
        if (! auth()->user()->isMemberOf($group)) {
            flash('請先加入討論版再發文')->warning()->important();
            return back();
        }

        return view('posts.create', compact('group'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, Group $group)
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
    public function update(PostRequest $request, Group $group, Post $post)
    {
        $post->update($request->all());

        return redirect()->route('groups.show', compact('group'));
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
        $post->delete();
        flash('文章已經刪除')->error()->important();

        return back();
    }
}
