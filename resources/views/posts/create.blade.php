@extends('layout')

@section('content')
<h2 class="text-center">新增文章</h2>

<div class="col-md-4 col-md-offset-4">
  {!! Form::open(['route' => ['groups.posts.store', $group]]) !!}
  	@include('posts.form')
  {!! Form::close() !!}
</div>
@endsection