@extends('layout')

@section('content')
<h2 class="text-center">編輯文章</h2>

<div class="col-md-4 col-md-offset-4">
  {!! Form::model($post, ['route' => ['groups.posts.store', $group]]) !!}
  	<div class="form-group">
	  	{!! Form::label('content', 'Content') !!}
	  	{!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '2']) !!}
	  </div>
	  {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
  {!! Form::close() !!}
</div>
@endsection