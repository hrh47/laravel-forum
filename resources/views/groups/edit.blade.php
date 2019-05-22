@extends('layout')

@section('content')
	<div class="col-md-4 col-md-offset-4">
		<h2>新增討論版</h2>
		<hr />
		{!! Form::open(['route' => ['groups.update', $group], 'method' => 'PUT']) !!}
			<div class="form-group">
				{!! Form::label('title', 'Title') !!}
				{!! Form::text('title', $group->title, ['class' => 'form-control']) !!}			
			</div>
			<div class="form-group">
				{!! Form::label('description', 'Description') !!}
				{!! Form::textarea('description', $group->description, ['class' => 'form-control', 'rows' => '2']) !!}			
			</div>
			{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
		{!! Form::close() !!}
	</div>
@endsection