@extends('layout')

@section('content')
	<div class="col-md-12">
	  <div>
	    <a href="{{ route('groups.edit', compact('group')) }}" class="btn btn-primary pull-right">Edit</a>
	  </div>
	  <h2>{{ $group->title }}</h2>
	  <p>{{ $group->description }}</p>
	</div>
@endsection