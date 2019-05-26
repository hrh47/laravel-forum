<div class="form-group{{ $errors->any('content') ? ' has-error' : '' }}">
 	{!! Form::label('content', 'Content') !!}
 	{!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '2']) !!}
 	@if ($errors->any('content'))
 		<div class="help-block">
 			@foreach ($errors->get('content') as $error)
 				<li class="list-unstyled">{{ $error }}</li>
 			@endforeach
 		</div>
 	@endif
</div>
{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}