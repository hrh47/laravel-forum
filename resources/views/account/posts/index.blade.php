@extends('layout')

@section('content')
	<div class="col-md-12">
	  <h2 class="text-center">我發表過的文章</h2>
	  <table class="table">
	    <thead>
	      <tr>
	        <th>Content</th>
	        <th>Group Name</th>
	        <th>Last Update</th>
	        <th colspan="2"></th>
	      </tr>
	    </thead>
	    <tbody>
	      @foreach ($posts as $post)
	        <tr>
	        	<td>{{ $post->content }}</td>
	        	<td>{{ $post->group['title'] }}</td>
	        	<td>{{ $post->updated_at }}</td>
	          <td>
	          	<a href="{{ route('groups.posts.edit', ['group' => $post->group, 'post' => $post]) }}" class="btn btn-default btn-sm">編輯</a>
	          	<a href="{{ route('groups.posts.destroy', ['group' => $post->group, 'post' => $post]) }}" class="btn btn-default btn-sm" data-method="delete" data-confirm="Are you sure?" data-token="{{ csrf_token() }}">刪除</a>
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