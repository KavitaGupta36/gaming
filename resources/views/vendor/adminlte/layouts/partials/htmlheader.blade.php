<head>
    <meta charset="UTF-8">
    <title> AdminLTE 2 with Laravel - @yield('htmlheader_title', 'Your title here') </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('/css/all.css') }}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- <script type="text/javascript" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script> -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <!-- <script type="text/javascript" src="{{ url('/js/custom.js') }}"></script> -->
    <script>
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
                                $("#remaining_user").val("");
                                $("#default_value").val("");
                           }else{
                                $("#remaining_user").val(data[0].no_of_user);
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
                    $("#remaining_user").val(Number(default_hidden_value) - Number(no_of_user));
                }else{
                    alert("please enter less than remaining user.");
                    $(this).val('');
                    $("#remaining_user").val(Number(default_hidden_value));
                }
                if(no_of_user == ''){
                    $("#remaining_user").val(Number(default_hidden_value));
                }
            });

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
</head>
