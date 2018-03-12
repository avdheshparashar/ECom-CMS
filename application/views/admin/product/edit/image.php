<div class="contentWrapper">
	<div class="container-fluid">
		
		<!--  Breadcrumb -->
		<div class="row-fluid hidden-phone">
			<div class="span12">
				<ul class="breadcrumb">
					<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
					<li>Dashboard</a></li>
					<li><span class="divider"></span>Products</li>
					<li><span class="divider"></span>Edit Product Images</li>
				</ul>
			</div>
		</div>
		<!-- End Breadcrumb -->

		<!-- Heading  -->
		<div class="row-fluid">
			<div class="span12">
				<h1>Edit Images for Product</h1>
				<p class="lead">Manage Images</p>
			</div>
		</div>


		<div class="tab-pane span12" id="lC">

			<form method="post" enctype="multipart/form-data" action="<?php echo base_url().'index.php/productimage/save'; ?>"
			 		data-parsley-trigger="change" data-parsley-ui-enabled="true" data-parsley-validate>

				<h3>Product Images</h3>
				<div class="form-horizontal well">
					<legend>Images for Product</legend>
					<div class="control-group">

						<label class="control-label" >Main Image</label>
						<div class="controls">
							<input name="main_image" type="file">
							<img src="<?php echo base_url().'assests/uploads/images/'.$main_image['main_image'];?>" data-parsley-required="true"
								height="100px" width="100px" style="margin-left:10px;">
						</div>
					</div>

					<input name="product_id" value="<?php echo $main_image['product_id']; ?>" type="hidden">

					<div class="control-group">
						<label class="control-label" for="inputEmail">Other Images</label>
						<div class="controls">
							<input name="other_image[]" type="file" multiple="multiple">
						</div>

						<div>

							<?php foreach($other_image as $image): ?>

								<img style="margin-left:20px" height="120px" width="120px" src="<?php echo base_url();?>assests/uploads/images/<?php echo $image['image']; ?>" style="margin-left:10px;">
									<a href="<?php echo base_url();?>productimage/delete/<?php echo $image['product_image_id'];?>" onclick="return confirm('Are you sure you want to delete this image?');">
										<span style="font-family: wingdings; font-size: 200%;">&#10006;</span>
									</a>
							<?php endforeach; ?>
						</div>

					</div>
				</div>

				<div class="pull-right">
					<button type="submit" class="btn btn-success pull-right">
						Save Chages 
						<icon class="icon-share-alt icon-white-t"></icon>
					</button>
					<a href="<?php echo base_url()."index.php/product/index";?>" class="btn btn-primary">
					Cancel
					<icon class="icon-remove icon-white-t"></icon>
				</a>
				</div>
				<div class="clearfix"></div>
				<br/>
			</form>

			<!-- End Upload Plugin -->
		</div>
	</div>
</div>