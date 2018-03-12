<script type="text/javascript" src="<?php echo base_url(); ?>assests/ckeditor/ckeditor.js"></script>
<div class="contentWrapper">			<div class="container-fluid">
		
		<!--  Breadcrumb -->
<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li>Dashboard</a></li>
			<li><span class="divider"></span>Publications</li>
			<li><span class="divider"></span>Update Publications</li>
		</ul>
	</div>
</div>
<!-- End Breadcrumb -->

<!-- Heading  -->
<div class="row-fluid">
	<div class="span12">
		<p class="lead">Update publications in your website</p>
	</div>
</div>
<!--  End Heading-->
<?php echo $this->load->view("admin/flash.php"); ?>
<!-- Form  -->
<form action="<?php echo base_url();?>publication/save" method="post" enctype="multipart/form-data" data-parsley-trigger="change"
		data-parsley-ui-enabled="true" data-parsley-validate>
	
	<!--  Block -->
	<div class="row-fluid">
	<div class="span12">
	
		<div class="form-horizontal well">
			<input type="hidden" value="<?php echo $publicationdetail[0]['data'][0]['publication_id']; ?>" name="publication_id">			
<!-- 			<div class="control-group">
				<label class="control-label" for="inputEmail">publication Name</label>
				<div class="controls">
					<input type="text" id="" class="input-block" placeholder="Publication Name" data-parsley-required="true"
							value="<?php echo $publicationdetail[0]['data'][0]['publication_name']; ?>" name="publication_name">
				</div>
			</div> -->


			<div class="control-group">
				<label class="control-label" for="inputEmail">Title</label>
				<div class="controls">
					<input type="text" id="" class="input-block" placeholder="title Name" data-parsley-required="true"
							value="<?php echo $publicationdetail[0]['data'][0]['title']; ?>" name="title">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">link</label>
				<div class="controls">
					<input type="text" id="" class="input-block" placeholder="short & sweet" data-parsley-required="true"
							data-parsley-type="url" value="<?php echo $publicationdetail[0]['data'][0]['link']; ?>" name="link">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Main Image</label>
				<img style="margin-left:20px" height="120px" width="120px" src="<?php echo base_url();?>assests/images/publications/<?php echo $publicationdetail[0]['data'][0]['main_image']; ?>">				
				<div class="controls">
					<input type="file" id="" class="input-block" placeholder="short & sweet" name="main_image">
				</div>
			</div>

            <div class="control-group">
                <label class="control-label" for="inputEmail">Description</label>
                <div class="controls">
                    <?php echo $this->ckeditor->editor("description",$publicationdetail[0]['data'][0]['description']); ?>
                </div>
            </div>



<!-- 			<div class="control-group">
				<label class="control-label" for="inputEmail">publication date</label>
				<div class="controls">
					<input type="text" id="" class="input-block" placeholder="Publish Date" data-parsley-required="true"
							value="<?php echo $publicationdetail[0]['data'][0]['publish_date']; ?>" name="publish_date">
				</div>
			</div>
 -->


<!-- 			<div class="control-group">
				<label class="control-label" for="inputEmail">More Image</label>
				<?php foreach($more_images as $key=>$value) { ?>
					<img style="margin-left:20px" height="120px" width="120px" src="<?php echo base_url();?>assests/images/publications/<?php echo $value['image_name']; ?>">
						<a href="<?php echo base_url();?>publication/imagedelete/<?php echo $value['publicationimage_id'];?>">
							<span style="font-family: wingdings; font-size: 200%;">&#10006;</span>
						</a>
						<a href="<?php echo base_url();?>publication/changeposition/<?php echo $value['publication_id']."/".$value['publicationimage_id'];?>">
							<span style="font-family: wingdings; font-size: 200%;">&#8658;</span>
						</a>
				<?php } ?>
				<div class="controls">
					<input type="file" id="" class="input-block" placeholder="short & sweet" name="more_image[]" multiple>
				</div>
			</div>			
 -->


		</div>

	</div>
	</div>

		<!-- End Block -->

	<div class="row-fluid">
	<div class="span12">
		<!--  Block -->
		
		<!--  Save Button -->
		<a href="<?php echo base_url().'publication';?>" class="btn btn-primary pull-right">
			Cancel
			<icon class="icon-remove icon-white-t"></icon>
		</a>
		<button type="submit" class="btn btn-success pull-right">Save Publication <icon class="icon-check icon-white-t"></icon></button>
		<!-- End Save Button  -->

	</div>
	</div>

</form>
<!-- End Form  -->	
		
	</div>
	</div>	<!-- End Content  -->