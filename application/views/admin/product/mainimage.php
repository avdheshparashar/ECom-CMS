<ul class="galleryItems">
	<?php foreach( $images as $image ): ?>

		<li class="span2" data-item-id="<?php echo $image['image_id'];?>" data-album-id="<?php echo $image['album_id'];?>" style="height: 166px;">
			
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
				<input type="radio" name="mainimage" value="<?php echo $image['image_id']; ?>" image-name="<?php echo $image['image_name'];?>" >
				
			
		</li>
	<?php endforeach; ?>
</ul>