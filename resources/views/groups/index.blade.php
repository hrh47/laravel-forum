@extends('layout')

@section('content')
	<div class="col-md-12">
	  <div class="group">
	    <a href="{{ route('groups.create') }}" class="btn btn-primary pull-right">新增群組</a>
	  </div>
	  <table class="table table-hover">
	    <thead>
	      <tr>
	        <td>#</td>
	        <td>Title</td>
	        <td>Description</td>
	        <td>Creator</td>
	      </tr>
	    </thead>
	    <tbody>
	      @foreach($groups as $group)
	        <tr>
	          <td>#</td>
	          <td><a href="{{ route('groups.show', compact('group')) }}">{{ $group->title }}</a></td>
	          <td>{{ $group->description }}</td>
	          <td>{{ $group->user->email }}</td>
	          <td>
	          	@can('update', $group)
			          <a href="{{ route('groups.edit', compact('group')) }}" class="btn btn-sm btn-default">編輯</a>
			          <a href="{{ route('groups.destroy', compact('group')) }}" class="btn btn-sm btn-default" data-method="delete" data-confirm="Are you sure?" data-token="{{csrf_token()}}">刪除</a>
		          @endcan
	          </td>
	        </tr>
	      @endforeach
	    </tbody>
	  </table>
	</div>
@endsection