$(document).ready(function(){

	$(".save-role").on('click', function(){
		var url = SITE_URL + '/role/add';
		var dataToSend = {};
		dataToSend.name = $("#input-role").val();
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
                    	/*
						for (var index in respo.data)
						{
							var opt = $('<option>');
							opt.value= respo.data[index].id;
							opt.innerHTML = respo.data[index].role_name;

							// then append it to the select element
							$("#role-table").appendChild(opt);
						}
						*/
                    }else{
                        alert(respo.message);
                    }
                },

                error   : function(res, status, error){

                    if(status === "timeout"){
                        alert("Request timeout, Please try after sometime.");
                    }
                }
		});

	});
	


	$('.edit-role').on('click', function(){
			var className = $(this).parent().prev().find('input[name=role_name]').attr('class');
			var tdElement = 'td[class='+ className + ']';
			tdElement = $(tdElement);
			var id = className.replace('modalEdit-', "");

			

			var url = SITE_URL + '/role/edit';
			var dataToSend = {};
			dataToSend.name = $(this).parent().prev().find('input[name=role_name]').val();
			dataToSend.id = id;

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
							$(tdElement).html(respo.data);
							// Close Modal
							var modal = 'div[id=' + className + ']';
							$(modal).find('.modal-header').find('.close').trigger('click');

		                }
	                    alert(respo.message);
		            },

		            error   : function(res, status, error){

		                if(status === "timeout"){
							var modal = 'div[id=' + className + ']';
							$(modal).find('.modal-header').find('.close').trigger('click');
		                    alert("Request timeout, Please try after sometime.");
		                }
		            }
			});


	});


});



