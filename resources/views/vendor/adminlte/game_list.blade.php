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
	              <h3 class="box-title">Game Management List</h3>
	              <a href="{{ route('game.create') }}">Add</a>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body table-responsive no-padding">
	              <table class="table table-hover">
	                <tbody><tr>
	                  <th>ID</th>
	                  <th>Level</th>
	                  <th>No. of voucher</th>
	                  <th>Price of voucher</th>
	                  <th>No. of user point</th>
	                  <th>No. of usre</th>
	                  <th>Remaining No. of user point</th>
	                  <th>Status</th>
	                  <th>Action</th>
	                </tr>
	                @if($games)
	                	@foreach($games as $game)
	                	<tr>
		                  <td>{{ $game->id }}</td>
		                  <td>{{ (isset($game->levelName->level_name) ? $game->levelName->level_name : '') }}</td>
		                  <td>{{ $game->no_voucher }}</td>
		                  <td>{{ $game->voucher_price }}</td>
		                  <td>{{ $game->no_user_point }}</td>
		                  <td>{{ $game->no_of_user }}</td>
		                  <td>{{ $game->remaining_user }}</td>
		                  <td>{{ $game->status == 1 ? 'Active' : 'Inactive' }}</td>
		                  <td>
		                  	<form action="{{ route('game.destroy', $game->id) }}" method="post">
		                  	{{ csrf_field() }}
		                  	<input name="_method" type="hidden" value="DELETE">
		                  	<a href="{{ route('game.edit', $game->id) }}">
		                  		<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
		                  	</a>
		                  		<button type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
		                  	</form>
		                  </td>
	                	</tr>
	                	@endforeach
	                @endif
	              </tbody></table>
	            </div>
	          </div>
	        </div>
	    </div>
	</div>
@endsection
