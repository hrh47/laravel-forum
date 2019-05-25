@extends('layout')

@section('content')
	<div class="col-md-12">
	  <div>
	  	@can('update', $group)
	    	<a href="{{ route('groups.edit', compact('group')) }}" class="btn btn-primary pull-right">Edit</a>
	    @endcan
	  </div>
	  <h2>{{ $group->title }}</h2>
	  <p>{{ $group->description }}</p>
	</div>
@endsection