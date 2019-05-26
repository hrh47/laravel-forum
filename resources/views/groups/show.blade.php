@extends('layout')

@section('content')
	<div class="col-md-12">
	  <div>
	  	<a href="{{ route('groups.posts.create', compact('group')) }}" class="btn btn-default pull-right">
	  		Write a Post
	  	</a>
	  	@can('update', $group)
	    	<a href="{{ route('groups.edit', compact('group')) }}" class="btn btn-primary pull-right">Edit</a>
	    @endcan
	  </div>
	  <h2>{{ $group->title }}</h2>
	  <p>{{ $group->description }}</p>

	  <table class="table">
	  	<thead>
	  		<tr>
	  			<th>文章內容</th>
	  			<th>發表者</th>
	  			<th>發表時間</th>
	  		</tr>
	  	</thead>
	  	<tbody>
	  		@foreach ($posts as $post)
	  			<tr>
	  				<td>{{ $post->content }}</td>
	  				<td>{{ $post->user->email }}</td>
	  				<td>{{ $post->created_at }}</td>
	  				<td>
	  					<a href="{{ route('groups.posts.edit', compact('group', 'post')) }}" class="btn btn-sm btn-default">編輯</a>
	  				</td>
	  			</tr>
	  		@endforeach
	  	</tbody>
	  </table>
	</div>
@endsection