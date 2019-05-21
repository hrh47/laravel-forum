@extends('layout')

@section('content')
	<div class="col-md-12">
	  <div class="group">
	    <!-- <%= link_to("New group", new_group_path, class: "btn btn-primary pull-right") %> -->
	    <a href="#" class="btn btn-primary pull-right">新增群組</a>
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
	      <!-- <% @groups.each do |group| %> -->
	      @foreach($groups as $group)
	        <tr>
	          <td>#</td>
	          <!-- <td><%= link_to(group.title, group_path(group)) %></td> -->
	          <td><a href="#">{{ $group->title }}</a></td>
	          <!-- <td><%= group.description %></td> -->
	          <td>{{ $group->description }}</td>
	          <td>
	            <!-- <%= link_to('Edit', edit_group_path(group), class: "btn btn-sm btn-default") %> -->
	            <a href="#" class="btn btn-sm btn-default">編輯</a>
	            <a href="#" class="btn btn-sm btn-default" data-method="delete" data-confirm="確定刪除？">刪除</a>
	            <!-- <%= link_to('Delete', group_path(group), class: "btn btn-sm btn-default",
	              method: :delete, data: { confirm: "Are you sure?" }) %> -->
	          </td>
	        </tr>
	      <!-- <% end %> -->
	      @endforeach
	    </tbody>
	  </table>
	</div>
@endsection