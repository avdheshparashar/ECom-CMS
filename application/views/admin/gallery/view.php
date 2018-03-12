<div class="row-fluid">
	<div class="ajax-loader hide" style="display: none;">
		<img src="theme/img/ajax-loader.gif" alt="Loading">
	</div>
	<div class="ajax-loaded" style="display: block;">

		<ul class="galleryItems">
			<?php foreach( $images as $image ): ?>
				<li class="span2" data-item-id="<?php echo $image['image_id'];?>" data-album-id="<?php echo $image['album_id'];?>" style="height: 166px;">
					<a href="<?php echo base_url();?>assests/uploads/images/<?php echo $image['image_name'];?>" class="thumb" data-target="#modalItem">
						<span class="image">
							<img src="<?php echo base_url();?>assests/uploads/images/<?php echo $image['image_name'];?>" alt="1 (1).jpg">
							<span class="hover" style="height: 98px; display: none;">
								<span class="glyphicons camera">
									<i></i>View
								</span>
							</span>
						</span>
						<span class="name">
							<?php echo $image['image_name']; ?>
						</span>
						<span class="glyphicons circle_remove hide" style="display: inline;"><i></i></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	<div class="clearfix"></div>

	<div class = "upload-image-messages"></div>

	    <div class = "col-md-6">
	        <!-- Generate the form using form helper function: form_open_multipart(); -->
	        <?php echo form_open_multipart('gallery/upload', array('class' => 'upload-image-form'));?>
	            <input type="file" multiple = "multiple" accept = "image/*" class = "form-control" name="uploadfile[]" size="20" /><br />
	            <input type="hidden" name="album_id" value="<?php echo $image['album_id']; ?>" />
	            <input type="submit" name = "submit" value="Upload" class = "btn btn-primary" />
	        </form>

	        <script>                    
	        jQuery(document).ready(function($) {

	            var options = {
	                beforeSend: function(){
	                    // Replace this with your loading gif image
	                    $(".upload-image-messages").html('<p><img src = "<?php echo base_url() ?>images/loading.gif" class = "loader" /></p>');
	                },
	                complete: function(response){
	                    // Output AJAX response to the div container
	                    $(".upload-image-messages").html(response.responseText);
	                    $('html, body').animate({scrollTop: $(".upload-image-messages").offset().top-100}, 150);
	                    location.reload();
	                    
	                }
	            };  
	            // Submit the form
	            $(".upload-image-form").ajaxForm(options);  

	            return false;
	            
	        });
	        </script>
	    </div>
	</div>
	
</div>