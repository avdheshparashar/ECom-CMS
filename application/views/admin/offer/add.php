<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

<link href="<?php echo base_url();?>assests/admin/custom/css/select2.min.css" rel="stylesheet">	
</link>
<script type="text/javascript" src="<?php echo base_url();?>assests/admin/custom/js/select2.min.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>/assests/admin/custom/js/offer.js"></script>

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
		<h1>Add Offer</h1>
		<p class="lead">Add Offer in your website</p>
	</div>
</div>
<!--  End Heading-->
<?php echo $this->load->view("admin/flash.php"); ?>
<!-- Form  -->
<form action="<?php echo base_url();?>offer/save" method="post" data-parsley-trigger="change" data-parsley-ui-enabled="true" data-parsley-validate>
	
	<!--  Block -->
	<div class="row-fluid">
	<div class="span12">

		<div class="form-horizontal well">
			<legend>Offer options</legend>
			<div class="control-group">
				<label class="control-label" for="inputEmail">Name</label>
				<div class="controls">
					<input type="text" id="" class="input-block" placeholder="Offer Name" name="name" data-parsley-required="true">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" >Offer Start</label>
				<div class="controls">
					<div class="input-group input-append date" id="offer-start">
		                <input type="text" class="form-control" name="offer_start" data-parsley-required="true"/>
		                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
		            </div>
					
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" >Offer ends</label>
				<div class="controls">
					<div class="input-group input-append date" id="offer-end">
		                <input type="text" class="form-control" name="offer_end" data-parsley-required="true" />
		                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
		            </div>

				</div>
			</div>

			<input name="discount_type" value="2" type="hidden">

			<div class="control-group">
				<label class="control-label" for="inputEmail">Discount Value(%)</label>
				<div class="controls">
					<input type="text" id="" class="input-block" placeholder="Enter Discount" name="discount_amount" data-parsley-required="true"
						data-parsley-range="[1,100]">
				</div>
			</div>

			<input type="hidden" name="discount_on" value=1 />

			<div class="control-group" id="discount-select-div">
				<label class="control-label" for="inputEmail">Applicable To</label>
				<div class="controls">
					<select id="discount-type" name="discount_on" data-parsley-required="true">
						<option> -- Select Type -- </option>
						<option value="1">Category</option>
						<option value="2">Product</option>
					</select>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Products Name</label>
				<div class="controls">
					<select name="product_ids[]" multiple id="select-products" data-parsley-required="true"></select>
				</div>
			</div>

		</div>

	</div>
	</div>
	<!-- End Block -->

	<div class="row-fluid">
	<div class="span12">

		<!--  Save Button -->
		<button type="submit" class="btn btn-success pull-right">Save Offer <icon class="icon-check icon-white-t"></icon></button>
		<!-- End Save Button  -->

	</div>
	</div>
</form>
<!-- End Form  -->	
		
	</div>
	</div>	<!-- End Content  -->
<script>
$(document).ready(function() {


	var d = new Date();

	var month = d.getMonth() + 1
	var day = d.getDate();

	var output = d.getFullYear() + '-' + (('' + month).length < 2 ? '0' : '') + month
	       + '-' + (('' + day).length < 2 ? '0' : '') + day;

	var dateToday = new Date(); 



    $('#offer-start')
        .datepicker({
            format: "yyyy-mm-dd",
			startDate: output,
			clearBtn: true,
			daysOfWeekDisabled: "0",
			orientation: "top auto",
			todayHighlight: true
        });

	$('#offer-end')
	    .datepicker({
	        format: "yyyy-mm-dd",
			startDate: output,
			clearBtn: true,
			daysOfWeekDisabled: "0",
			orientation: "top auto",
			todayHighlight: true
	    });

});
</script>