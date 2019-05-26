@extends('layout')

@section('content')
	<div class="col-md-12">
	  <h2 class="text-center">我加入的討論版</h2>
	  <table class="table">
	    <thead>
	      <tr>
	        <th>#</th>
	        <th>Title</th>
	        <th>Description</th>
	        <th>Post Count</th>
	        <th>Last Update</th>
	      </tr>
	    </thead>
	    <tbody>
	      @foreach ($groups as $group)
	        <tr>
	          <td>#</td>
	          <td><a href="{{ route('groups.show', compact('group')) }}">{{ $group->title }}</a></td>
	          <td>{{ $group->description }}</td>
	          <td>{{ $group->posts->count() }}</td>
	          <td>{{ $group->updated_at }}</td>
	        </tr>
	      @endforeach
	    </tbody>
	  </table>
	</div>
@endsection