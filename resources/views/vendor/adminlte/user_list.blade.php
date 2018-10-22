@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
	        <div class="col-xs-12">
	          <div class="box">
	            <div class="box-header">
	              <h3 class="box-title">User List</h3>
	              <a href="{{ route('user_management.create') }}">Add</a>
	              <div class="box-tools">
	                <div class="input-group input-group-sm" style="width: 150px;">
	                 <!--  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search"> -->

	                  <div class="input-group-btn">
	                    <a href="{{ route('user_management.create') }}">Add</a>
	                  </div>
	                </div>
	              </div>
	            </div>
	            <div class="box-body table-responsive no-padding">
	            <table class="table table-hover">
		            <tbody>
		                <tr>
		                  <th>ID</th>
		                  <th>Level Name</th>
		                  <th>No. of User</th>
		                  <th>Status</th>
		                  <th>Action</th>
		                </tr>
		                @if($users)
		                	@foreach($users as $value)
		                	<tr>
			                  <td>{{ $value->id }}</td>
			                  <td>{{ $value->level_name }}</td>
			                  <td>{{ $value->no_of_user }}</td>
			                  <td>{{ $value->status == 1 ? 'Active' : 'Inactive' }}</td>
			                  <td>
			                  	<form action="{{ route('user_management.destroy', $value->id) }}" method="post">
			                  	{{ csrf_field() }}
			                  	<input name="_method" type="hidden" value="DELETE">
			                  	<a href="{{ route('user_management.edit', $value->id) }}">
			                  		<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
			                  	</a>
			                  		<button type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
			                  	</form>
			                  </td>
		                	</tr>
		                	@endforeach
		                @endif
		              </tbody>
	              </table>
	            </div>
	          </div>
	        </div>
	    </div>
	</div>
@endsection
