$(document).ready(function(){
    $('body').on('change', '#controller', function() {
        $('#method').empty();
        var controller = $(this).val();
        var url = SITE_URL + '/controllermethod/getMethodList/';
        var data = JSON.stringify({
            cm: controller
        });
        var html_data = [];
        $.get(url, {
            data: data
        }, function(resData) {

			var response = JSON.parse(resData);
			if( response.status == "false" ){
				alert("There are no functionality for this module");
				return false;
			}
			if( response.status == "true" ){
				for (index in response.data){
					console.log(response.data[index]);
					html_data.push('<input type="checkbox" name="method[]" value="' + 
										response.data[index] + '">&nbsp;&nbsp;' + response.data[index] + '<br/>');
				}
                $('#method').append(html_data);
			}
        });
    });


	$(".grant-access").on('click', function(){
		var accessMethods = [];
		$("#method").find('input:checked').each(function(){
			accessMethods.push($(this).val());
		}).promise().done(function(){
			//var url = SITE_URL + '/controllermethod/getMethodList/';
			var dataToSend = {};
			dataToSend.controller = $("#controller").val();
			dataToSend.method = accessMethods;
			var url = SITE_URL + '/controllermethod/savemethods';

			$.ajax({
                    type    : "POST",
                    cache   : false,
                    url     : url,
                    data    : dataToSend,
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

});



