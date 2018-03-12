$(document).ready(function(){


    $("#add-user").click(function(){
        
        // var name, email , pwd, role;
        // name = $(".user-add").find('input[name=name]');
        // email = $(".user-add").find('input[name=email]');
        // pwd = $(".user-add").find('input[name=password]');
        // role = $("#role-id").val();
        var data = {
            name     :  $(".user-add").find('input[name=name]').val(),
            email    :  $(".user-add").find('input[name=email]').val(),
            password :  $(".user-add").find('input[name=password]').val(),
            role_id  :  $("#role-id").val()
        };

        var url = SITE_URL + "user/save_user";


        $.ajax({
            type    : "POST",
            cache   : false,
            url     : url,
            data    : data,
            timeout : 8000,

            beforeSend : function(){
                //$('#verify').show();
            },

            success : function(res){
                var respo = JSON.parse(res);

                if(respo.status == 'true'){
                    location.reload();
                    
                }else{
                    // Do Necessary thing
                }
            },

            error   : function(res, status, error){

                if(status === "timeout"){
                    alert("Request timeout, Please try after sometime.");
                }
            }
        });
    });


    $(".edit-user").click(function(){
        
        var data = {
            name     :  $(this).closest('.modal').find('table').find('input[name=name]').val(),
            email    :  $(this).closest('.modal').find('table').find('input[name=email]').val(),
            password :  $(this).closest('.modal').find('table').find('input[name=password]').val(),
            role_id  :  $(this).closest('.modal').find('select').val(),
            user_id  :  $(this).closest('.modal').find('table').find('input[name=user_id]').val()

        };

        var url = SITE_URL + "user/update_user";


        $.ajax({
            type    : "POST",
            cache   : false,
            url     : url,
            data    : data,
            timeout : 8000,

            beforeSend : function(){
                //$('#verify').show();
            },

            success : function(res){
                var respo = JSON.parse(res);

                if(respo.status == 'true'){
                    location.reload();
                    
                }else{
                    // Do Necessary thing
                }
            },

            error   : function(res, status, error){

                if(status === "timeout"){
                    alert("Request timeout, Please try after sometime.");
                }
            }
        });
        
    });

});
