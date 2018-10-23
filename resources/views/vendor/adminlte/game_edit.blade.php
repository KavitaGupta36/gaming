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
                <h3 class="box-title">Game Management Edit</h3>
                <a href="{{ url('game') }}">All Game Management</a>
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
                        <form role="form" action="{{ route('game.update', $details->id) }}" method="post">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="PATCH">
                        <input type="hidden" name="check_url" id="check_url" value="{{ url('game/checkLevelExit') }}">
                        <input type="hidden" name="level_url" id="level_url" value="{{ url('game/getLevel') }}">
                          <div class="form-group">
                            <label>Level Name</label>
                            <select class="form-control m-bot15" name="level_id" id="level_id">
                              <option value="" >Select Option</option>
                                @if ($levels->count())
                                    @foreach($levels as $level)
                                        <option value="{{ $level->id }}" {{ $details->level_id == $level->id ? 'selected="selected"' : '' }}>{{ $level->level_name }}</option> 
                                    @endforeach   
                                @endif
                            </select>
                          </div>

                          <div class="form-group">
                            <label>Number of Voucher</label>
                            <input type="number" name="no_voucher" class="form-control" placeholder="Enter ..." value="{{ $details->no_voucher }}">
                          </div>

                          <div class="form-group">
                            <label>Voucher Price</label>
                            <input type="number" name="voucher_price" class="form-control" placeholder="Enter ..." value="{{ $details->voucher_price }}">
                          </div>

                          <div class="form-group">
                            <label>No. of user point</label>
                            <input type="number" name="no_user_point" class="form-control" placeholder="Enter ..." value="{{ $details->no_user_point }}">
                          </div>

                          <div class="form-group">
                            <label>No. of user</label>
                            <input type="number" name="no_of_user" class="form-control" placeholder="Enter ..." value="{{ $details->no_of_user }}" id="no_of_user">
                          </div>

                          <div class="form-group">
                            <label>Remaining No. of user point</label>

                            <input type="hidden" name="default_value" value="", id="default_value">

                            <input type="hidden" name="remaining_no_user" id="remaining_no_user" value="">

                            <input type="number" name="remaining_user" class="form-control" placeholder="Enter ..." value="{{ $details->remaining_user }}" id="remaining_user">
                          </div>

                          <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                              <option value="1" {{ $details->status == 1 ? 'selected="selected"' : '' }} >Active</option>
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
<script type="text/javascript">
    $( document ).ready(function() {
          $("#level_id").change(function(e){
              var level_id = $(this).val();
              e.preventDefault();
              $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              $.ajax({
                  url:'{{ url('game/checkLevelExit') }}',
                  method:"POST",
                  dataType: 'json',
                  data:{level_id:level_id},
                  success:function(data){
                     if(data == 1){
                          alert("Record already exist for This Level");
                          $("#level_id option[value='']").attr('selected', true)
                          return;
                      }
                      done();
                  }
              });
              function done(){
                  $.ajax({
                      url:'{{ url('game/getLevel') }}',
                      method:"POST",
                      dataType: 'json',
                      data:{level_id:level_id},
                      success:function(data){
                         if($.isEmptyObject(data)){
                              alert("Level have no user");
                              $("#remaining_no_user").val("");
                              $("#default_value").val("");
                         }else{
                              $("#remaining_no_user").val(data[0].no_of_user);
                              $("#default_value").val(data[0].no_of_user);
                         }
                      }
                  });
              }
          });

          $("#no_of_user").keyup(function(){
              var no_of_user = $(this).val();
              var default_hidden_value = $("#default_value").val();
              if(Number(default_hidden_value) > Number(no_of_user)){
                  $("#remaining_no_user").val(Number(default_hidden_value) - Number(no_of_user));
              }else{
                  alert("please enter less than remaining user.");
                  $(this).val('');
                  $("#remaining_no_user").val(Number(default_hidden_value));
              }
              if(no_of_user == ''){
                  $("#remaining_no_user").val(Number(default_hidden_value));
              }
          });

          
      });
</script>
@endsection
