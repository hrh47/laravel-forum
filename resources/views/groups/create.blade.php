@extends('layout')

@section('content')
	<div class="col-md-4 col-md-offset-4">
		<h2>新增討論版</h2>
		<hr />
		{!! Form::open(['route' => 'groups.store']) !!}
			<div class="form-group{{ $errors->hasAny('title') ? ' has-error' : '' }}">
				{!! Form::label('title', 'Title') !!}
				{!! Form::text('title', null, ['class' => 'form-control']) !!}
				@if ($errors->hasAny('title'))
					<div class="help-block">
						@foreach ($errors->get('title') as $error)
							<li class="list-unstyled">{{ $error }}</li>
						@endforeach
					</div>	
				@endif
			</div>
			<div class="form-group">
				{!! Form::label('description', 'Description') !!}
				{!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2']) !!}			
			</div>
			{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
		{!! Form::close() !!}
	</div>
@endsection