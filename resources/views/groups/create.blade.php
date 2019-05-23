@extends('layout')

@section('content')
	<div class="col-md-4 col-md-offset-4">
		<h2>新增討論版</h2>
		<hr />
		{!! Form::open(['route' => 'groups.store']) !!}
			@include('common.form')
		{!! Form::close() !!}
	</div>
@endsection