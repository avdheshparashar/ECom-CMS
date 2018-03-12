<link href="<?php echo base_url();?>assests/admin/custom/css/select2.min.css" rel="stylesheet">	</link>
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assests/admin/custom/js/select2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assests/ckeditor/ckeditor.js"></script>
<div class="contentWrapper">			<div class="container-fluid">
		
		<!--  Breadcrumb -->
<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li>Dashboard</a></li>
			<li><span class="divider"></span>Publications</li>
			<li><span class="divider"></span>Add Publications</li>
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
<form action="<?php echo base_url();?>publication/save" method="post" enctype="multipart/form-data" >
	
	<!--  Block -->
	<div class="row-fluid">
	<div class="span12">

		<div class="form-horizontal well">
			
<!-- 			<div class="control-group">
				<label class="control-label" for="inputEmail">Publication Name</label>
				<div class="controls">
					<input type="text" id="" class="input-block" placeholder="Publication Name" name="publication_name"
					>
				</div>
			</div>

		    <div class="control-group">
		        <label class="col-xs-3 control-label">Publication Date</label>
		        <div class="controls date">
		            <div class="input-group input-append date" id="datePicker">
		                <input type="text" class="form-control" placeholder="Publication date" name="publish_date" />
		                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
		            </div>
		        </div>
		    </div>
 -->

			<div class="control-group">
				<label class="control-label" for="inputEmail">Title</label>
				<div class="controls">
					<input type="text" id="" class="input-block" placeholder="Title" name="title">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Link</label>
				<div class="controls">
					<input type="text" id="" class="input-block" placeholder="Link" name="link" data-parsley-type="url">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Main Image</label>
				<div class="controls">
					<input type="file" id="" class="input-block" placeholder="publication Name" name="main_image" >
				</div>
			</div>			


            <div class="control-group">
                <label class="control-label" for="inputEmail">Description</label>
                <div class="controls">
                    <?php echo $this->ckeditor->editor("description","description"); ?>
                </div>
            </div>

<!-- 			<div class="control-group">
				<label class="control-label" for="inputEmail">More Image</label>
				<div class="controls">
					<input type="file" id="" class="input-block" placeholder="short & sweet" name="more_image[]" 
						multiple="multiple">
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
		<button type="submit" class="btn btn-success pull-right">Save publication <icon class="icon-check icon-white-t"></icon></button>
		<!-- End Save Button  -->

	</div>
	</div>

</form>
<!-- End Form  -->	
		
	</div>
	</div>	<!-- End Content  -->
<script type="text/javascript">
	$("#publications").select2({
 		tags: true
	});
</script>
<script>
$(document).ready(function() {
    $('#datePicker')
        .datepicker({
            format: 'mm/dd/yyyy',
      
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#eventForm').formValidation('revalidateField', 'date');
        });
});
</script>