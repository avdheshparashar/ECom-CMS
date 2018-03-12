$(document).ready(function(){

	$(".fetch-image").click(function(){

		var data = "";

		if( $(this).attr('data-target') == "#modalAlbumMain" ){
			data = "album_id="+ $("#album-id-main").val() + "&main=true";

		}else{
			data = "album_id="+ $("#album-id-other").val();
		}

		$.ajax({

			type 	: 	"POST",
			url 	: 	SITE_URL + 'product/fetch_image',
			data 	: 	data,
			cache   : 	false,
			timeout : 	8000,

			beforeSend: 	function(){

			},

			success: 	function(res){

				$(".view-image").html(res);

			},

		});

	});


	$(".save-image").click(function(){

		var images = "";

		$(".view-image").find('input:checked').each(function(){

			images = images + ", " + $(this).attr('image-name');
			var element = "<input type='hidden' value=" +  $(this).attr('image-name')  + " class='image-to-save' name=images[]>";
			$(".fetch-image").closest('.active').append(element);


		}).promise().done(function(){

			images = images.slice(2);

			$(".multiple").closest('.active').append(images);


		});

	});

	$(".product-tags").select2({
	  tags: true
	});

	$(".product-fields").select2();
	$("#category_id").select2();

	$(".save-main-image").click(function(){

		var image = $(".view-image").find("input:checked").attr('image-name');
		// var element = "<input type='hidden' value=" + $(".view-image").find("input:checked").val() + " class='image-to-save' name=main_image>";
		var element = "<input type='hidden' value=" + image + " class='image-to-save' name=main_image>";
		$(".single").closest('.active').append(element);
		$(".single").closest('.active').append(image);


	});


	$(".save-product").click(function(){

		$("#product-add").submit();

	});

	/*
	$("#size-color").click(function(){
		
		if( $(this).is(":checked") ){

			$(".no-stock").attr('disabled', true);

			$("#size-free").attr('disabled', true);

			$(".size").attr('disabled', true);

			$(".stock-value").attr('disabled', true);

			$("#add-more-stock").attr('disabled', true);

			$(".delete-stock-row").attr('disabled', true);

		}else{

			$(".no-stock").attr('disabled', false);

			$(".size").attr('disabled', false);
			
			$(".stock-value").attr('disabled', false);

			$("#add-more-stock").attr('disabled', false);

			$("#size-free").attr('disabled', false);

			$(".delete-stock-row").attr('disabled', false);

		}
	});
	*/

	$("#size-present").click(function(){

		if( $(this).is(":checked") ){
			$(".size").attr('disabled', false);
		}else{
			$(".size").attr('disabled', true);
		}

	});

	$("#color-present").click(function(){

		if( $(this).is(":checked") ){
			$(".color").attr('disabled', false);
		}else{
			$(".color").attr('disabled', true);
		}

	});

	$("#add-more-stock").click(function(){

		var $row = $(".stock-table tr:eq( 1 )").clone();

		$row.find('input').each(function(){

			if( $(this).attr('type') !== "button" ){

				$(this).val("");

			}

		});

		$row.appendTo(".stock-table");

	});


	$("#more-description").click(function(){

		if( $("#spec-name").val() === "" || $("#spec-value").val() === "" ){

			alert("You can not leave specifications blank");
			return;

		}

		row = $("<tr>");
		var specInput = "<input class='form-control' name='specification[]' value='"+ $("#spec-name").val() +"'' />";
		var valueInput = "<input class='form-control' name='specvalue[]' value='"+ $("#spec-value").val() +"'' />";
		row.append($("<td>").append(specInput) );
		row.append($("<td>").append(valueInput) );
		row.append($("<td>").append('<input type="button" value="Delete" class="btn btn-danger" onclick="DeleteMe(jQuery(this))" >') );

		if( $(".spec-tbl").length === 0){
			var $table = $("<table>");
			$table.attr('border', 1);
			$table.attr('class', 'table spec-tbl')
			$table.append("<thead>");
			var tHead = $("<tr>");

			tHead.append($("<td>").text("Specification") );
			tHead.append($("<td>").text("Description") );
			tHead.append($("<td>").text("Delete") );
			$table.children('thead').append(tHead);

			$table.append(row);

			$table.appendTo('#spec-div');

		}else{

			$(".spec-tbl").append(row);			

		}

	});

	function deleteme(self){
		self.closest('tr').remove();
	}


	$("#size-free").click(function(){

		if( $(this).is(":checked") ){

			$("#single-stock").attr('disabled', false);

			//$(".no-stock").attr('disabled', true);
			//$("#size-color").attr('disabled', true);


			$(".size").attr('disabled', true);

			$(".stock-value").attr('disabled', true);

			$("#add-more-stock").attr('disabled', true);

			$(".delete-stock-row").attr('disabled', true);


		}else{

			$("#single-stock").attr('disabled', true);

			$(".size").attr('disabled', false);

			$(".stock-value").attr('disabled', false);

			$("#add-more-stock").attr('disabled', false);

			//$("#size-color").attr('disabled', false);

			$(".delete-stock-row").attr('disabled', false);

		}

	});

	$(".next-tab").click(function(){

		var nextTarget = $(this).attr('next-target');
		$(".my-tab-item.active").attr('class', 'my-tab-item').next().attr('class', 'my-tab-item active');


	});



});


function DeleteRow( self ){

	if( $(".stock-table tbody tr").length === 1 ){

		return;
	}

	self.closest('tr').remove();

}

function DeleteMe( self ){

	self.closest('tr').remove();

}