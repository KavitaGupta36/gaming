$( document ).ready(function() {
    $("#level_id").change(function(e){
        var level_id = $(this).val();
        var check_url = $("#check_url").val();
        var level_url = $("#level_url").val();
        e.preventDefault();
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
            url:"check_url",
            method:"POST",
            dataType: 'json',
            data:{level_id:level_id},
            success:function(data){
               if(data == 1){
                    $(this).val('');
                    alert("Record already exist for This Level");
                    return;
                }
                level_user();
            }
        });
        function level_user(){
            $.ajax({
                url:"level_url",
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
            url:"{{ url('user_management/CheckLevel') }}",
            method:"POST",
            dataType: 'json',
            data:{level_id:level_id},
            success:function(data){
               if(data == 1){
                    $(this).val('');
                    alert("Record already exist for This Level");
                    return;
                }
            }
        });
    })
});