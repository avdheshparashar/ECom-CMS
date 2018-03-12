<div class="contentWrapper">			<div class="container-fluid">
		
		<!--  Breadcrumb -->
<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li>Dashboard</a></li>
			<li><span class="divider"></span>Attributes</li>
			<li><span class="divider"></span>Edit Attribute</li>
		</ul>
	</div>
</div>
<!-- End Breadcrumb -->

<!-- Heading  -->
<div class="row-fluid">
	<div class="span12">
		<p class="lead">Update fields in your website</p>
	</div>
</div>
<!--  End Heading-->
<?php echo $this->load->view("admin/flash.php"); ?>
<!-- Form  -->
<form action="<?php echo base_url();?>field/save" method="post" data-parsley-trigger="change" data-parsley-ui-enabled="true" data-parsley-validate>
	
	<!--  Block -->
	<div class="row-fluid">
	<div class="span12">
	
		<div class="form-horizontal well">
			<input type="hidden" value="<?php echo $fielddetail[0]['data'][0]['field_id']; ?>" name="field_id">			
			<div class="control-group">
				<label class="control-label" for="inputEmail">Field Name</label>
				<div class="controls">
					<input type="text" id="" class="input-block" placeholder="name" data-parsley-required="true"
							value="<?php echo $fielddetail[0]['data'][0]['name']; ?>" name="name">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Values</label>
				<div class="controls">
					<input type="text" id="" class="input-block" placeholder="values" data-parsley-required="true"
							value="<?php echo $fielddetail[0]['data'][0]['content']; ?>"name="content">
				</div>
			</div>			
		</div>

	</div>
	</div>

		<!-- End Block -->

	<div class="row-fluid">
	<div class="span12 pull-right">
		<!--  Block -->
		
		<!--  Save Button -->
		<a href="<?php echo base_url().'field';?>" class="btn btn-primary pull-right">
			Cancel
			<icon class="icon-remove icon-white-t"></icon>
		</a>
		<button type="submit" class="btn btn-success pull-right">Save Attribute <icon class="icon-check icon-white-t"></icon></button>
		
		<!-- End Save Button  -->

	</div>
	</div>

</form>
<!-- End Form  -->	
		
	</div>
	</div>	<!-- End Content  -->