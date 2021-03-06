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
	              <h3 class="box-title">User Management Add</h3>
	              <a href="{{ url('user_management') }}">All User Management</a>
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
      		              <form role="form" action="{{ route('user_management.store') }}" method="post">

      		              {{csrf_field()}}
      		                <div class="form-group">
      		                  <label>Level Name</label>

                            <select class="form-control m-bot15" name="level_name" id="level_name">
                               <option value="" >Select Option</option>
                                @if ($levels->count())
                                    @foreach($levels as $level)
                                        <option value="{{ $level->id }}" >{{ $level->level_name }}</option> 
                                    @endforeach   
                                @endif
                            </select>
      		                </div>

      		                <div class="form-group">
      		                  <label>Number of User</label>
      		                  <input type="number" name="no_of_user" class="form-control" placeholder="Enter ...">
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
  <script>
    $(document).ready(function(){
        $("#level_name").change(function(e){
            var level_id = $(this).val();
            e.preventDefault();
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.ajax({
                url:'{{ url('user_management/CheckLevel') }}',
                method:"POST",
                dataType: 'json',
                data:{level_id:level_id},
                success:function(data){
                   if(data == 1){
                        alert("Record already exist for This Level");
                        $("#level_name option[value='']").attr('selected', true)
                        return;
                    }
                }
            });
        })
    });
  </script>
@endsection
