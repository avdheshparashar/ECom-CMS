$(document).ready(function(){

	$(".circle_remove").click(function(){

		var data = "";


		if( $(this).attr('data-send') == 'main' ){
			data = "main=true&product_id=" + $("#product-id").val();
		}else{
			data = "main=false&product_image_id=" + $("#product-id").val();
		}




		$.ajax({
			url:	SITE_URL + '/product/deleteimage',
			type: 'POST',
			data: data,
			cache: false,
			headers: {
				// this prevents iOS6's Safari from caching the response 
				// Safari will cache the response even if cache is set to false above
				"Cache-Control": "no-cache"
			},
			success: function(rd){
				console.log(rd);
			},
			error:	function(){
				alert("There seem to be some problem, please try after sometime");
			}
		});
	});


	$(".flip-image").click(function(){

		var data = "";

		if( $(this).attr('id') == 'main-image' ){
			data = "product_id=27&main=true";
		}else{
			data = "product_id=27&main=false";
		}

		$.ajax({

			url: SITE_URL + '/product/product_image/',
			type: 'POST',
			data: data,
			cache: false,
			headers: {
				// this prevents iOS6's Safari from caching the response 
				// Safari will cache the response even if cache is set to false above
				"Cache-Control": "no-cache"
			},
			success: function(rd)
			{
				// toggle off currently active album
				$('.albums .active').removeClass('active');

				// make this album active
				button.addClass('pencil').parent().addClass('active');

				$('.media .ajax-loader').slideUp();


				if( parseInt(rd) == 0){
					alert("There are no images in this album");
					return;
				}
			
				$('.media .ajax-loaded').html(rd).show(function()
				{
					// clear previous timeouts, if any
					$.each(circleRemoveTimeouts, function(k,v){
						clearTimeout(v);
					});
					circleRemoveTimeouts = [];
				
					// interval in ms for showing delete icons
					var circleRemoveInt = 100;
				
					// showing delete icons delayed
					$('.media .galleryItems li .circle_remove').each(function(k,v)
					{
						var timeout = setTimeout(function(){
							$(v).fadeIn();
						}, circleRemoveInt*k);

						circleRemoveTimeouts.push(timeout);
					});
				
					// set all gallery items to equal height (tallest item + 15px)
					equalHeight($('.media .galleryItems li'), 15);
				
					// preload images
					var pim = [];
					$('.media .galleryItems li').each(function(k,v)
					{
						pim.push($(v).find('a').attr('href'));
					});
					preloadImages(pim);
				});
			}
		});

	});
});
