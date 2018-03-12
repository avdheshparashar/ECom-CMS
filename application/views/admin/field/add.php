<link href="<?php echo base_url();?>assests/admin/custom/css/select2.min.css" rel="stylesheet">	
</link>
<script type="text/javascript" src="<?php echo base_url();?>assests/admin/custom/js/select2.min.js">	
</script>
<div class="contentWrapper">			<div class="container-fluid">
		
		<!--  Breadcrumb -->
<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li>Dashboard</a></li>
			<li><span class="divider"></span>Attributes</li>
			<li><span class="divider"></span>Create Attribute</li>
		</ul>
	</div>
</div>
<!-- End Breadcrumb -->

<!-- Heading  -->
<div class="row-fluid">
	<div class="span12">
		<p class="lead">Update Attributes in your website</p>
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
			
			<div class="control-group">
				<label class="control-label" for="inputEmail">Attribute Name</label>
				<div class="controls">
					<input type="text" id="" class="input-block" placeholder="Attribute Name" name="name" data-parsley-required="true">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Values</label>
				<div class="controls">
					<input type="text" id="attributes" class="input-block" data-role="tagsinput"  placeholder="Values" name="content"
						data-parsley-required="true">
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
<script type="text/javascript">
	$("#attributes").select2({
 		tags: true
	});
</script>
