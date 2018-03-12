<link href="<?php echo base_url();?>assests/admin/custom/css/select2.min.css" rel="stylesheet">	
</link>
<script type="text/javascript" src="<?php echo base_url();?>assests/admin/custom/js/select2.min.js">	
</script>

<script type="text/javascript" src="<?php echo base_url();?>assests/admin/custom/js/productimage.js">	
</script>

<!-- Start Content -->
<div class="contentWrapper">
	<div class="container-fluid">
		<!-- Breadcrumb -->
		<div class="row-fluid hidden-phone">
			<div class="span12">
				<ul class="breadcrumb">
					<li class="active">
						You are here: 
						<icon class="icon-home icon-blue-l"></icon>
					</li>
					<li><a href="index.html?lang=en">Dashboard</a></li>
					<li><span class="divider"></span>eCommerce<span class="divider"></span><a href="products.html?lang=en">Products</a></li>
					<li class="active"><span class="divider"></span>Add product</li>
				</ul>
			</div>
		</div>
		<!-- End Breadcrumb -->
		<!-- Heading  -->
		<div class="row-fluid">
			<div class="span12">
				<h1>Add product</h1>
				<hr />
			</div>
		</div>

		<?php 
			if ($this->session->flashdata('flash_message')) {
		       $flashdata = $this->session->flashdata('flash_message');
		       echo '<div class="alert ' . $flashdata['class'] . ' fade in"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' . $flashdata['message'] . '</div>';
		   	}
		?>

		<div class="clearfix separator bottom"></div>
		<!--  End Heading-->
		<div class="row-fluid">
			<!--  Tabs -->
			<div class="span3">
				<ul class="tabs-arrow">
					<li class="active"><a class="glyphicons pencil" href="#lA" data-toggle="tab"><i></i> 1. Main Image</a></li>
					<li class=""><a class="glyphicons camera" href="#lB" data-toggle="tab"><i></i> 2. Other images</a></li>
				</ul>
				<div class="clearfix"></div>
				<br/>
			</div>
			<!-- End Tabs -->

			<form method="POST" class="span9" id="product-add" action="<?php echo base_url();?>index.php/product/add">
				<!--  Tab Content -->
				<div class="span9">
					<div class="tab-content">
						<!--  Tab Content Block -->
						<input name="product_id" value="<?php echo $this->input->get('product_id');?>" type="hidden" id="product-id"/>
						<div class="tab-pane active" id="lA">

							<div class="span3">
								<h3>Choose Album For Main Image</h3>
								<div class="control-group">
									<label class="control-label" >Albums</label>
										<div class="controls">
											<select style="width: 100%;" name="album_id" id="album-id">
												<?php foreach( $albums as $album ):  ?>
													<option value="<?php echo $album['albums_id']; ?>">
														<?php echo $album['name']; ?>
													</option>
												<?php endforeach; ?>
											</select>
									</div>
								</div>

								<a href="#" class="btn btn-primary btn-block fetch-image single" data-toggle="modal" data-target="#modalAlbumMain"><i class="icon-white icon-plus-sign"></i> View Images</a>
							</div>
							<div class="span3" id="main-image-div">

	

								<li class="span2" data-item-id="<?php echo $main_image['image'];?>" style="height: 166px;">
									<a href="<?php echo base_url();?>assests/uploads/images/<?php echo $main_image['image'];?>" class="thumb" data-target="#modalItem">
										<span class="image">
											<img src="<?php echo base_url();?>assests/uploads/images/<?php echo $main_image['image'];?>" alt="1 (1).jpg">
											<span class="hover" style="height: 98px; display: none;">
												<span class="glyphicons camera">
													<i></i>View
												</span>
											</span>
										</span>
										<span class="name">
											<?php echo $main_image['image']; ?>
										</span>
										<span class="glyphicons circle_remove hide" style="display: inline;" data-send="main"><i></i></span>
									</a>
								</li>
							</div>

							<div class="clearfix"></div>
							<br/>
						</div>
						<!--  End Tab Content Block -->
						<!--  Tab Content Block -->

						<div class="tab-pane" id="lB">
							
							<div class="clearfix"></div>
							<div class="span3">
								<h3>Choose Album</h3>
								<div class="control-group">
									<label class="control-label" >Albums</label>
									<div class="controls">
										<select style="width: 100%;" name="album_id" id="album-id">
											<?php foreach( $albums as $album ):  ?>
												<option value="<?php echo $album['albums_id']; ?>"><?php echo $album['name']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>

								<a href="#" class="btn btn-primary btn-block fetch-image multiple" data-toggle="modal" data-target="#modalAlbum"><i class="icon-white icon-plus-sign"></i> View Images</a>
							</div>
							<div class="span3" id="other-image-div">

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

							</div>
						</div>

							<!-- End Upload Plugin -->
						</div>
						<!--  End Tab Content Block -->
					</div>
				</div>
			</form>
			<!-- End Tab Content  -->
		</div>
		<!-- modal-gallery is the modal dialog used for the image gallery -->
		<div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd" tabindex="-1">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">&times;</a>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body">
				<div class="modal-image"></div>
			</div>
			<div class="modal-footer">
				<a class="btn modal-download" target="_blank"><i class="icon-download"></i> <span>Download</span></a>
				<a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000"><i class="icon-play icon-white"></i> 					<span>Slideshow</span></a>
				<a class="btn btn-info modal-prev"><i class="icon-arrow-left icon-white"></i> <span>Previous</span></a>
				<a class="btn btn-primary modal-next"><span>Next</span> <i class="icon-arrow-right icon-white"></i></a>
			</div>
		</div>
	</div>
</div>
<!-- End Content  -->

<div class="hide modal modalGallery" tabindex="-1" id="modalAlbumMain">
	<div class="modal-header">
		<p>
			Choose Images
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		</p>
	</div>
	<div class="modal-body view-image">
		
	</div>
	<div class="modal-footer">
		<a href="#" class="btn btn-primary btn-submit save-main-image" data-dismiss="modal">
			Save & Continue 
			<icon class="icon-share-alt icon-white"></icon>
		</a>
		<a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</a>
	</div>
</div>

