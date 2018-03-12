<div class="contentWrapper">			<div class="container-fluid">
		
		<!--  Breadcrumb -->
<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li>Dashboard</a></li>
			<li><span class="divider"></span>Slideshows</li>
			<li><span class="divider"></span>Manage Slideshows</li>
		</ul>
	</div>
</div>
<!-- End Breadcrumb -->

<!-- Heading  -->
<div class="row-fluid">
	<div class="span12">
		<p class="lead">Update Slideshow Image in your website</p>
	</div>
</div>
<!--  End Heading-->
<?php echo $this->load->view("admin/flash.php"); ?>
<!-- Form  -->
<form action="<?php echo base_url();?>gallery/save" method="post" enctype="multipart/form-data" multiple>
	
	<!--  Block -->
	<div class="row-fluid">
	<div class="span12">
	
		<div class="form-horizontal well">
			<input type="hidden" value="<?php echo $slideshowdetail[0]['data'][0]['slideshow_id']; ?>" name="slideshow_id">			

			<div class="control-group">
				<label class="control-label" for="inputEmail">Main Image</label>
				<img style="margin-left:20px" height="120px" width="120px" src="<?php echo base_url();?>assests/images/slideshows/<?php echo $slideshowdetail[0]['data'][0]['image_name']; ?>">				
				<div class="controls">
					<input type="file" class="input-block" name="image_name">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">link</label>
				<div class="controls">
					<input type="text" id="" class="input-block" placeholder="short & sweet" 
							value="<?php echo $slideshowdetail[0]['data'][0]['link']; ?>" name="link">
				</div>
			</div>

		</div>

	</div>
	</div>

		<!-- End Block -->

	<div class="row-fluid">
	<div class="span12">
		<!--  Block -->
		
		<!--  Save Button -->
		<a href="<?php echo base_url().'gallery';?>" class="btn btn-primary pull-right">
			Cancel
			<icon class="icon-remove icon-white-t"></icon>
		</a>
		<button type="submit" class="btn btn-success pull-right">Save Slidehshow <icon class="icon-check icon-white-t"></icon></button>
		<!-- End Save Button  -->

	</div>
	</div>

</form>
<!-- End Form  -->	
		
	</div>
	</div>	<!-- End Content  -->