$(document).ready(function(){

    $('#select-role').on('change', function() {
        //$('#loader').show();
        $('#permission-table').empty()
        var cm_item = [];
        var permission_item = [];
        var tbl_data = [];
        var sub_tbl_data = '';

		var url = SITE_URL + '/permission/getSelectedRoleData';

		var dataToSend = {};
		dataToSend.role_id = $(this).val();

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
	                var tbl_data = [];
	                var sub_tbl_data = '';
	                if(respo.status == 'true'){

	                	$(".permission-table tbody").empty();

	                	$.each(respo.data, function(item, resDataObj) {
		                    if (item == 'permission') permission_item = resDataObj;
		                    if (item == 'cm') cm_item = resDataObj;
		                });

		                /*console.log('-----permission------------')
						console.log(permission_item)
						console.log('-----cm------------')
						console.log(cm_item)*/

		                var i = 1,
		                    p_flag = 0,
		                    p_id = 0,
		                    permission_flag = 1;
		                $.each(cm_item, function(cm_key, cm_val) {
		                    //var cm_id = cm_val.cm_id;
		                    var cm_id = cm_val.id;
		                    $.each(permission_item, function(pm_key, pm_val) {
		                        // if (pm_val.cm_id == cm_val.cm_id) {
		                        // if (pm_val.cm_id == cm_id) {
		                        if (pm_val.controller_method_id == cm_id) {
		                            if (pm_val.permission == 1) {
		                                p_flag = 1;
		                            } else {
		                                permission_flag = 0;
		                            }
		                            p_id = pm_val.permission_id;

		                        }
		                    })

		                    if (permission_flag == 0) {
		                        // sub_tbl_data = "<a href='javascript:;' data-cm_id='" + cm_id + "' data-p_id='" + p_id + "' data-flag='false' class='check'><span class='glyphicon glyphicon-remove'></span></a>";
		                        sub_tbl_data = "<a href='javascript:;' data-cm_id='" + cm_id + "' data-p_id='" + p_id + "' data-flag='false' class='check'>Grant Access</a>";
		                    } else {
		                        // if (p_flag == 1) sub_tbl_data = "<a href='javascript:;' data-cm_id='" + cm_id + "' data-p_id='" + p_id + "' data-flag='true' class='check'><span class='glyphicon glyphicon-ok'></span></a>";
		                        // else sub_tbl_data = "<a href='javascript:;' data-p_id='0' data-cm_id='" + cm_id + "' data-flag='false' class='check'><span class='glyphicon glyphicon-remove'></span></a>";

		                        if (p_flag == 1) sub_tbl_data = "<a href='javascript:;' data-cm_id='" + cm_id + "' data-p_id='" + p_id + "' data-flag='true' class='check'>Revoke Access</a>";
		                        else sub_tbl_data = "<a href='javascript:;' data-p_id='0' data-cm_id='" + cm_id + "' data-flag='false' class='check'>Grant Access</a>";

		                    }

		                    // if(p_flag == 1) sub_tbl_data = "<a href='javascript:;' data-cm_id='"+cm_id+"' data-p_id='"+p_id+"' data-flag='true' class='check'><span class='glyphicon glyphicon-ok'></span></a>";
		                    // else sub_tbl_data = "<a href='javascript:;' data-p_id='0' data-cm_id='"+cm_id+"' data-flag='false' class='check'><span class='glyphicon glyphicon-remove'></span></a>";
		                    tbl_data.push('<tr><td>' + i + '</td><td>' + cm_val.controller + '</td><td>' + cm_val.method + '</td><td>' + sub_tbl_data + '</td></tr>');
		                    i++;
		                    p_flag = 0;
		                    permission_flag = 1;
		                });

						if (tbl_data.length === 0) tbl_data.push('There is no Data & Insert Atleast one in CM Management')
		                $('#permission-table-body').append(tbl_data);
		                console.log(tbl_data);


	                }else{
	                    alert(respo.message);
					}

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



    $('#permission-table-body').on('click', '.check', function() {
            $me = $(this)
            //var role_id = $('input[name=role_id]:checked').val();
            var role_id = $("#select-role").val();
            if (typeof role_id !== 'undefined') {
                var cm_id = $me.data('cm_id');
                var flag = $me.data('flag');
                var p_id = $me.data('p_id');
                console.log(role_id, cm_id, flag, p_id)
                var url = SITE_URL + '/permission/updataPermissionAction';
                var flag_val;

                if (!flag) {

                	$me.html("Revoke Access");
                    $me.data('flag', true)
                    flag_val = 1
                    console.log('flag is true now')
                } else {
                    $me.html("Grant Access");
                    $me.data('flag', false)
                    flag_val = 0
                    console.log('flag is false now')
                }
                var p_id;
                var data = JSON.stringify({
                    p_id: p_id,
                    cm_id: cm_id,
                    role_id: role_id,
                    flag: flag_val
                });
                $.post(url, {
                    data: data
                }, function(result) {
                    var p_id = parseInt($.trim(result))
                    if (p_id == 0) {
                        // console.log('updated permission');
                    } else {

                        // $me.data('p_id', p_id)
                        $me.attr('data-p_id', p_id)
                    }
                });
            } else {
                alert('Must Select Role');
            }
        })




});
