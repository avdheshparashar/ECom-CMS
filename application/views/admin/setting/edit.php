<div class="contentWrapper">			<div class="container-fluid">
		
		<!--  Breadcrumb -->
<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li class="active">You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li><a href="dashboard.html?lang=en">Dashboard</a></li>
			<li class="active"><span class="divider"></span><a href="site-pages.html?lang=en">Site Pages</a></li>
			<li class="active"><span class="divider"></span>Add page</li>
		</ul>
	</div>
</div>
<!-- End Breadcrumb -->

<!-- Heading  -->
<div class="row-fluid">
	<div class="span12">
		<h1>Update page</h1>
		<p class="lead">Update page in your website</p>
	</div>
</div>
<!--  End Heading-->

<!-- Form  -->
<form action="<?php echo base_url();?>setting/save" method="post">
	
	<!--  Block -->
	<div class="row-fluid">
	<div class="span12">

		<div class="form-horizontal well">
			<legend>Settings options</legend>
			<input type="hidden" value="<?php echo $settingdetails[0]['data'][0]['settings_id']; ?>" name="settings_id">
			<div class="control-group">
				<label class="control-label" for="inputEmail">Setting Name</label>
				<div class="controls">
					<input type="text" id="" value="<?php echo $settingdetails[0]['data'][0]['setting_name']; ?>" class="input-block" 
						placeholder="short & sweet" name="setting_name">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Setting Value</label>
				<div class="controls">
					<input type="text" id="" value="<?php echo $settingdetails[0]['data'][0]['setting_value']; ?>" class="input-block" 
						placeholder="short & sweet" name="setting_value">
				</div>
			</div>

			

		</div>

	</div>
	</div>
	<!-- End Block -->

	<div class="row-fluid">
	<div class="span12">
	

		<!--  Save Button -->
		<button type="submit" class="btn btn-success pull-right">Save Setting <icon class="icon-check icon-white-t"></icon></button>
		<!-- End Save Button  -->

	</div>
	</div>
</form>
<!-- End Form  -->	
		
	</div>
	</div>	<!-- End Content  -->


