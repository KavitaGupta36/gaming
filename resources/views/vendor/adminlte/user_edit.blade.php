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
                <h3 class="box-title">User Management Edit</h3>
                <a href="{{ url('user_management') }}">All User Management</a>
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
                      @if(Session::has('flash_message'))
                          <div class="alert alert-success">
                              {{ Session::get('flash_message') }}
                          </div>
                      @endif
                      <div class="box-body">
                        <form role="form" action="{{ route('user_management.update', $details->id) }}" method="post">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="PATCH">
                          <div class="form-group">
                            <label>Level Name</label>
                            <select class="form-control m-bot15" name="level_name" id="level_name">
                             <option value="" >Select Option</option>
                                @if ($levels->count())
                                    @foreach($levels as $level)
                                        <option value="{{ $level->id }}" {{ $details->level_name == $level->id ? 'selected="selected"' : '' }} >{{ $level->level_name }}</option> 
                                    @endforeach   
                                @endif
                            </select>
                          </div>

                          <div class="form-group">
                            <label>Number of User</label>
                            <input type="number" name="no_of_user" value = "{{ $details->no_of_user }}" class="form-control" placeholder="Enter ...">
                          </div>

                         <div class="form-group">
                             <label>Status</label>
                             <select class="form-control" name="status">
                               <option value="1" {{ $details->status == 1 ? 'selected="selected"' : '' }}>Active</option>
                               <option value="0" {{ $details->status == 0 ? 'selected="selected"' : '' }}>Inactive</option>
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
