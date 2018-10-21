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
	              <h3 class="box-title">Voucher List</h3>
	              <a href="{{ route('voucher.create') }}">Add</a>
	              <div class="box-tools">
	                <div class="input-group input-group-sm" style="width: 150px;">
	                 <!--  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search"> -->

	                  <div class="input-group-btn">
	                    <a href="{{ route('voucher.create') }}">Add</a>
	                  </div>
	                </div>
	              </div>
	            </div>
	            <div class="box-body table-responsive no-padding">
	              <table class="table table-hover">
	                <tbody><tr>
	                  <th>ID</th>
	                  <th>Voucher Name</th>
	                  <th>Amount</th>
	                 <!--  <th>Status</th> -->
	                  <th>Action</th>
	                </tr>

	                @if($vouchers)
	                	@foreach($vouchers as $voucher)
	                	<tr>
		                  <td>{{ $voucher->id }}</td>
		                  <td>{{ $voucher->name }}</td>
		                  <td>{{ $voucher->amount }}</td>
		                  <!-- <td><span class="label label-success">Approved</span></td> -->
		                  <td>
		                  	<form action="{{ route('voucher.destroy', $voucher->id) }}" method="post">
		                  	{{ csrf_field() }}
		                  	<input name="_method" type="hidden" value="DELETE">
		                  	<a href="{{ route('voucher.edit', $voucher->id) }}">
		                  	<!-- <a href="{{ action('VoucherController@edit', $voucher->id) }}"> -->
		                  		<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
		                  	</a>
		                  		<!-- <i class="fa fa-trash" aria-hidden="true"></i> -->
		                  		<button type="submit">Delete</button>
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
