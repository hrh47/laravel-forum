@extends('layout')

@section('content')
	<div class="col-md-12">
	  <div class="group">
	    <a href="{{ route('groups.create') }}" class="btn btn-primary pull-right">新增群組</a>
	  </div>
	  <table class="table table-hover">
	    <thead>
	      <tr>
	        <td>#</td>
	        <td>Title</td>
	        <td>Description</td>
	      </tr>
	    </thead>
	    <tbody>
	      @foreach($groups as $group)
	        <tr>
	          <td>#</td>
	          <td><a href="#">{{ $group->title }}</a></td>
	          <td>{{ $group->description }}</td>
	          <td>
	            <a href="#" class="btn btn-sm btn-default">編輯</a>
	            <a href="#" class="btn btn-sm btn-default" data-method="delete" data-confirm="確定刪除？">刪除</a>
	          </td>
	        </tr>
	      @endforeach
	    </tbody>
	  </table>
	</div>
@endsection