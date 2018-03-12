<div class="contentWrapper">			<div class="container-fluid">
		
		<!--  Breadcrumb -->
<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li>Dashboard</a></li>
			<li><span class="divider"></span>Categories</li>
			<li><span class="divider"></span>Edit Categories</li>
		</ul>
	</div>
</div>
<!-- End Breadcrumb -->
<?php echo $this->load->view("admin/flash.php"); ?>

<!-- Heading  -->
<div class="row-fluid">
	<div class="span12">
		<h1>Update page</h1>
		<p class="lead">Update page in your website</p>
	</div>
</div>
<!--  End Heading-->

<!-- Form  -->
<form action="<?php echo base_url();?>category/update" method="post" enctype="multipart/form-data" data-parsley-trigger="change"
		data-parsley-ui-enabled="true" data-parsley-validate> 
	
	<!--  Block -->
	<div class="row-fluid">
	<div class="span12">
		<div class="form-horizontal well">
			<legend>Category options</legend>

			<input type="hidden" value="<?php echo $categorydetails[0]['data'][0]['category_id']; ?>" name="category_id">

			<div class="control-group">
				<label class="control-label" for="inputEmail">Parent Category</label>
				<div class="controls">
					<select name="parent_id">
						<option value="<?php echo $categorydetails[0]['data'][0]['parent_id']; ?>" selected>
							<?php 
								if($categorydetails[0]['data'][0]['parent_name']!='') {
									echo $categorydetails[0]['data'][0]['parent_name']; 
								} else {
									echo "Root";
								}
							?>
						</option>
						<?php foreach($list as $key=>$value) { ?>
							<?php if($categorydetails[0]['data'][0]['category_id'] != $key) { ?>
    						<option value="<?php echo $key;?>"><?php echo $value;?></option>
    					<?php } } ?>
					</select>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Category Name</label>
				<div class="controls">
					<input type="text" id="" placeholder="keyword1 keyword2 other" data-parsley-required="true" 
						value="<?php echo $categorydetails[0]['data'][0]['category_name']; ?>"  name="name" >
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Description</label>
				<div class="controls">
					<textarea class=" span5" rows="4" placeholder="keep it under 170 characters" data-parsley-required="true" 
						name="description"><?php echo $categorydetails[0]['data'][0]['description']; ?></textarea>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Main Image</label>
				<img style="margin-left:20px" height="120px" width="120px" src="<?php echo base_url();?>assests/images/categories/<?php echo $categorydetails[0]['data'][0]['image_name']; ?>">
				<br/>
				<div class="controls">
					<input type="file" id="" placeholder="Image Name" name="image_name">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Banner Image</label>
				<img style="margin-left:20px" height="120px" width="120px" src="<?php echo base_url();?>assests/images/categories/<?php echo $categorydetails[0]['data'][0]['banner_image']; ?>">
				<br/>
				<div class="controls">
					<input type="file" id="" placeholder="Image Name" name="banner_image">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Page Title</label>
				<div class="controls">
					<input type="text" data-parsley-required="true" value="<?php echo $categorydetails[0]['data'][0]['page_title']; ?>"  
						placeholder="Page Title" name="page_title">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Meta Description</label>
				<div class="controls">
					<textarea class=" span5" rows="4" placeholder="Meta Description" data-parsley-required="true"
						name="meta_description"><?php echo $categorydetails[0]['data'][0]['meta_description']; ?></textarea>
				</div>
			</div>


			<div class="control-group">
				<label class="control-label" for="inputEmail">Meta Keywords</label>
				<div class="controls">
					<textarea class=" span5" rows="4" placeholder="Meta Keywords" 
						name="meta_keywords"><?php echo $categorydetails[0]['data'][0]['meta_keywords']; ?></textarea>
				</div>
			</div>


		</div>

	</div>
	</div>
	<!-- End Block -->

	<div class="row-fluid">
	<div class="span12">
		<!--  Save Button -->
		<a href="<?php echo base_url().'category';?>" class="btn btn-primary pull-right">
			Cancel
			<icon class="icon-remove icon-white-t"></icon>
		</a>
		<button type="submit" class="btn btn-success pull-right">Save Category <icon class="icon-check icon-white-t"></icon></button>
		<!-- End Save Button  -->

	</div>
	</div>
</form>
<!-- End Form  -->	
		
	</div>
	</div>	<!-- End Content  -->