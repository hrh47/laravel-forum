@extends('layout')

@section('content')
	<div class="col-md-12">
	  <div>
	  	<span class="pull-right">
	  		@if (auth()->user() && auth()->user()->isMemberOf($group))
	  			<label class="label label-success">群組成員</label>
	  		@else
	  			<label class="label label-warning">不是群組成員</label>
	  		@endif
	  	</span>	  	

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
	  					<a href="{{ route('groups.posts.destroy', compact('group', 'post')) }}" class="btn btn-sm btn-default" data-method="delete" data-confirm="Are you sure?" data-token="{{csrf_token()}}">刪除</a>
	  				</td>
	  			</tr>
	  		@endforeach
	  	</tbody>
	  </table>
	  <div class="text-center">
	  	{{ $posts->links() }}
	  </div>
	</div>
@endsection