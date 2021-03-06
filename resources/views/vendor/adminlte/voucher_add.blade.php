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
	              <h3 class="box-title">Voucher Add</h3>
	              <a href="{{ url('voucher') }}">All Voucher</a>
	              <div class="box-tools">
	                <div class="input-group input-group-sm" style="width: 150px;">
	                </div>
	              </div>
	            </div>
	            <div class="box-body table-responsive no-padding">
	              <div class="col-md-12">
	              		<div class="box box-warning">
      		            
                      @include('adminlte::layouts.partials.alertmessage')

      		            <div class="box-body">
      		              <form role="form" action="{{ route('voucher.store') }}" method="post">

      		              {{csrf_field()}}
      		                <div class="form-group">
      		                  <label>Name</label>
      		                  <input type="text" name="name" class="form-control" placeholder="Enter ...">
      		                </div>

                          <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="desc" rows="3" placeholder="Enter ..." ></textarea>
                          </div>

      		                <div class="form-group">
      		                  <label>Amount</label>
      		                  <input type="number" name="amount" class="form-control" placeholder="Enter ...">
      		                </div>

                          <div class="form-group">
                            <label>Link Code</label>
                            <input type="url" name="link_code" class="form-control" placeholder="Enter ...">
                          </div>

      		                <div class="form-group">
                              <label>Status</label>
                              <select class="form-control" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                              </select>
                            </div>

                            <button class="btn btn-primary">Submit</button>
      		              </form>
      		            </div>
          		      </div>
	              </div>
	            </div>
	          </div>
	        </div>
	    </div>
	</div>

@endsection
