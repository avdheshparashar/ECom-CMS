<div class="contentWrapper">			<div class="container-fluid">
		
		<!--  Breadcrumb -->
<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li>Dashboard</li>
			<li><span class="divider"></span>Products</li>
			<li><span class="divider"></span>Upload</li>
		</ul>
	</div>
</div>
<!-- End Breadcrumb -->
<br/>
<!-- Heading  -->
<div class="row-fluid">
	<div class="span6">
		<p class="lead">Upload Products</p>
	</div>
	<!-- <div class="span6" align="right">
		<button type="submit" class="btn btn-success pull-right">Save Category <icon class="icon-check icon-white-t"></icon></button>
	</div> -->
</div>
<!--  End Heading-->

<!-- Form  -->
<form action="<?php echo base_url();?>product/upload" method="post" enctype="multipart/form-data" data-parsley-trigger="change"
		data-parsley-ui-enabled="true" data-parsley-validate>
	
	<!--  Block -->
	<div class="row-fluid">
	<div class="span12">

		<div class="form-horizontal well">
			<legend>Upload options</legend>
			<div class="control-group">
				<label class="control-label" for="inputEmail">Upload CSV</label>
				<div class="controls">
					<input id="" type="file" name="uploadcsv" data-parsley-required="true">
				</div>		
			</div>
		</div>

	</div>
	</div>
	<!-- End Block -->

	<div class="row-fluid">
	<div class="span12">
		<!--  Save Button -->
		<button type="submit" class="btn btn-success pull-right">Upload <icon class="icon-check icon-white-t"></icon></button>
		<!-- End Save Button  -->

	</div>
	</div>
</form>
<!-- End Form  -->	
		
	</div>
	</div>	<!-- End Content  -->
