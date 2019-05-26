<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\GroupRequest;

class GroupsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::all();

        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        $group = new Group($request->all());

        auth()->user()->groups()->save($group);
        auth()->user()->join($group);

        return redirect()->route('groups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        $posts = $group->posts()->recent()->paginate(5);

        return view('groups.show', compact('group', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        $this->authorize('update', $group);

        return view('groups.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, Group $group)
    {
        $this->authorize('update', $group);

        $group->update($request->all());

        return redirect()->route('groups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $this->authorize('update', $group);
        
        $group->delete();

        return redirect()->route('groups.index');
    }

    public function join(Group $group)
    {
        if(! auth()->user()->isMemberOf($group)) {
            auth()->user()->join($group);
            flash('加入本討論版成功！')->success()->important();
        } else {
            flash('你已經是本討論版的成員了！')->warning()->important();
        }        

        return redirect()->route('groups.show', compact('group'));
    }

    public function quit(Group $group)
    {
        if (auth()->user()->isMemberOf($group)) {
            auth()->user()->quit($group);
            flash('已退出本討論版！')->error()->important();
        } else {
            flash('你不是本討論版的成員，怎麼退出 XD')->warning()->important();
        }

        return redirect()->route('groups.show', compact('group'));
    }
}
