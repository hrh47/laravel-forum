@extends('layout')

@section('content')
<h2 class="text-center">編輯文章</h2>

<div class="col-md-4 col-md-offset-4">
  {!! Form::model($post, ['route' => ['groups.posts.update', $group, $post], 'method' => 'PUT']) !!}
  	@include('posts.form')
  {!! Form::close() !!}
</div>
@endsection