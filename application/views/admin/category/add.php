<div class="contentWrapper">			<div class="container-fluid">
		
		<!--  Breadcrumb -->
<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li>Dashboard</a></li>
			<li><span class="divider"></span>Categories</li>
			<li><span class="divider"></span>Add Categories</li>
		</ul>
	</div>
</div>
<!-- End Breadcrumb -->
<br/>
<!-- Heading  -->
<?php echo $this->load->view("admin/flash.php"); ?>
<div class="row-fluid">
	<div class="span6">
		<p class="lead">Create Category</p>
	</div>
	<!-- <div class="span6" align="right">
		<button type="submit" class="btn btn-success pull-right">Save Category <icon class="icon-check icon-white-t"></icon></button>
	</div> -->
</div>
<!--  End Heading-->

<!-- Form  -->
<form action="<?php echo base_url();?>index.php/category/save" method="post" enctype="multipart/form-data" data-parsley-trigger="change"
		data-parsley-ui-enabled="true" data-parsley-validate>
	
	<!--  Block -->
	<div class="row-fluid">
	<div class="span12">

		<div class="form-horizontal well">
			<legend>Category options</legend>
			<div class="control-group">
				<label class="control-label" for="inputEmail">Parent Category</label>
				<div class="controls">
					<select name="parent_id" data-parsley-required="true">
						<option value="null" selected>Root</option>
						<?php foreach($list as $key=>$value) { ?>
    						<option value="<?php echo $key;?>"><?php echo $value;?></option>
    					<?php } ?>
					</select>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Category Name</label>
				<div class="controls">
					<input type="text" id="" placeholder="Category Name" name="name" data-parsley-required="true">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Description</label>
				<div class="controls">
					<textarea class=" span5" rows="4" placeholder="description" name="description"></textarea>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Main Image</label>
				<div class="controls">
					<input id="" type="file" placeholder="keyword1 keyword2 other" name="image_name" data-parsley-required="true">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Banner Image</label>
				<div class="controls">
					<input id="" type="file" placeholder="keyword1 keyword2 other" name="banner_image" data-parsley-required="true">
				</div>
			</div>


			<div class="control-group">
				<label class="control-label" for="inputEmail">Page Title</label>
				<div class="controls">
					<input type="text" id="" placeholder="Page Name" name="page_title" data-parsley-required="true">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Meta Description</label>
				<div class="controls">
					<textarea class=" span5" rows="4" placeholder="Meta Description" name="meta_description"
						data-parsley-required="true"></textarea>
				</div>
			</div>


			<div class="control-group">
				<label class="control-label" for="inputEmail">Meta Keywords</label>
				<div class="controls">
					<textarea class=" span5" rows="4" placeholder="Meta Keywords" name="meta_keywords"
					data-parsley-required="true"></textarea>
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