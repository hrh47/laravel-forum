@extends('layout')

@section('content')
	<div class="col-md-4 col-md-offset-4">
		<h2>新增討論版</h2>
		<hr />
		{!! Form::open() !!}
			<div class="form-group">
				{!! Form::label('title', 'Title') !!}
				{!! Form::text('title', null, ['class' => 'form-control']) !!}			
			</div>
			<div class="form-group">
				{!! Form::label('description', 'Description') !!}
				{!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2']) !!}			
			</div>
			{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
		{!! Form::close() !!}
	</div>
@endsection