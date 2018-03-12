$(document).ready(function(){

	$("#select-products").select2();


	$("#discount-type").change(function(){

		var type = "";

		if( $(this).val() == 1 ){

			$.ajax({

				url: SITE_URL + 'api/offer/offercategory',
				type: "POST",
				cache: false,
				data: 'type=category',
				success: function (data) {

					$("#discount-select-div").after(data);

				}	

			});

		}else{

			if( $("#select-category").length !== 0 ){

				$("#category-select-div").remove();

			}

			var product_ids = [];

			$("#select-products option").each(function(){
				product_ids.push($(this).val())

			}).promise().done(function(){

				var data = {};
				data.type= "product";
				data.product = product_ids;


				$.ajax({

					url: SITE_URL + 'api/offer/offerproduct',
					type: "POST",
					cache: false,
					data: data,
					success: function (data) {

						// $("#select-products").html(data);
						$("#select-products").append(data);

					}	

				});
			});

		}

		

	});
});


function getCategoryProducts(){
	
	var category_id = $("#select-category").val();

	var product_ids = [];

	$("#select-products option").each(function(){
		product_ids.push($(this).val())

	}).promise().done(function(){


		var data = {};
		data.category_id = $("#select-category").val();
		data.type= "category";
		data.product = product_ids;

		$.ajax({

			url: SITE_URL + 'api/offer/offerproduct',
			type: "POST",
			cache: false,
			// data: 'type=category&category_id=' + $("#select-category").val() ,
			data: data  ,
			success: function (data) {

				//$("#select-products").html(data);
				$("#select-products").append(data);

		}	

	});


	});

}


function selectCategory( self ){

	if( self.is(":checked") ){

		if( $("#select-category").val() !== "" && $("#discount-type").val() == 1 ){

		    $('#select-products option').prop('selected', true);

		}

	}

}
