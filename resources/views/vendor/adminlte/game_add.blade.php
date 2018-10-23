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
	              <h3 class="box-title">Game Management Add</h3>
	              <a href="{{ url('user_management') }}">All Game Management</a>
	              <div class="box-tools">
	                <div class="input-group input-group-sm" style="width: 150px;">
	                </div>
	              </div>
	            </div>
	            <div class="box-body table-responsive no-padding">
	              <div class="col-md-12">
	              		<div class="box box-warning">
      		            @if($errors->any())
      		                <div class="alert alert-danger">
      		                    @foreach($errors->all() as $error)
      		                        <p>{{ $error }}</p>
      		                    @endforeach
      		                </div>
      		            @endif
                      @if(Session::has('flash_error'))
                          <div class="alert alert-danger">
                              {{ Session::get('flash_error') }}
                          </div>
                      @endif
      		            @if(Session::has('flash_message'))
      		                <div class="alert alert-success">
      		                    {{ Session::get('flash_message') }}
      		                </div>
      		            @endif
      		            <div class="box-body">
      		              <form role="form" action="{{ route('game.store') }}" method="post">

      		              {{csrf_field()}}
                        
                        <input type="hidden" name="check_url" id="check_url" value="{{ url('game/checkLevelExit') }}">
                        <input type="hidden" name="level_url" id="level_url" value="{{ url('game/getLevel') }}">

      		                <div class="form-group">
      		                  <label>Level Name</label>
                            <select class="form-control m-bot15" name="level_id" id="level_id">
                              <option value="" >Select Option</option>
                                @if ($levels->count())
                                    @foreach($levels as $level)
                                        <option value="{{ $level->id }}" >{{ $level->level_name }}</option> 
                                    @endforeach   
                                @endif
                            </select>
      		                </div>

      		                <div class="form-group">
      		                  <label>Number of Voucher</label>
      		                  <input type="number" name="no_voucher" class="form-control" placeholder="Enter ...">
      		                </div>

                          <div class="form-group">
                            <label>Voucher Price</label>
                            <input type="number" name="voucher_price" class="form-control" placeholder="Enter ...">
                          </div>

                          <div class="form-group">
                            <label>No. of user point</label>
                            <input type="number" name="no_user_point" class="form-control" placeholder="Enter ...">
                          </div>

                          <div class="form-group">
                            <label>No. of user</label>
                            <input type="number" name="no_of_user" class="form-control" placeholder="Enter ..." id="no_of_user">
                          </div>

                          <div class="form-group">
                            <label>Remaining No. of user point</label>
                            <input type="hidden" name="default_value" value="", id="default_value">
                            <input type="number" name="remaining_user" class="form-control" placeholder="Enter ..." id="remaining_user" value="">
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
