<div class="form-group">
 	{!! Form::label('content', 'Content') !!}
 	{!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '2']) !!}
</div>
{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}