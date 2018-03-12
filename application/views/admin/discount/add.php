<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

<style type="text/css">
/**
 * Override feedback icon position
 * See http://formvalidation.io/examples/adjusting-feedback-icon-position/
 */
#eventForm .form-control-feedback {
    top: 0;
    right: -15px;
}
</style>
<div class="contentWrapper">			<div class="container-fluid">
		
		<!--  Breadcrumb -->
<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li>Dashboard</a></li>
			<li><span class="divider"></span>Discounts</li>
			<li><span class="divider"></span>Add Discounts</li>
		</ul>
	</div>
</div>
<!-- End Breadcrumb -->

<!-- Heading  -->
<div class="row-fluid">
	<div class="span12">
		<p class="lead">Create Dicount</p>
	</div>
</div>
<!--  End Heading-->
<?php echo $this->load->view("admin/flash.php"); ?>
<!-- Form  -->
<form action="<?php echo base_url();?>discount/save" method="post" name='randform' data-parsley-trigger="change"
		data-parsley-ui-enabled="true" data-parsley-validate >
	
	<!--  Block -->
	<div class="row-fluid">
	<div class="span12">

		<div class="form-horizontal well">
			<legend>Discount options</legend>
			<div class="control-group">
				<label class="control-label" for="inputEmail">Name</label>
				<div class="controls">
					<input type="text" id="" class="input-block" placeholder="Name" name="name" data-parsley-required="true">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Code</label>
				<div class="controls">
					<input type="text" placeholder="Code" name="code" data-parsley-required="true" data-parsley-type="alphanum">
					<input type="button" class="btn btn-default" value="Generate Code "  onClick="randomString();"> 
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label" for="inputEmail">Is Limit?</label>
				<div class="controls">
					<input type="text" id="" placeholder="Limit?"data-parsley-type="integer"  value=0 name="is_limit">
                    <p>If no user limit then write 0</p>
                </div>
			</div>
			
			<div class="control-group">
				<label class="control-label" >Category</label>
				<div class="controls">
					<select name="category_ids[]" id="category" multiple>
						<?php foreach($list as  $key=>$category): ?>
							<option value="<?php echo $key; ?>"><?php echo $category; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Apply To All</label>
				<div class="controls">
					<input type="checkbox" name="applytoall" placeholder="category" onclick="document.getElementById('category').disabled=(this.checked)?1:0">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Discount Amount (%)</label>
				<div class="controls">
					<input type="text" id="" placeholder="Discount Amount" data-parsley-type="integer" data-parsley-required="true" 
						name="discount_amount" data-parsley-range="[1,100]">
				</div>
			</div>		

			<div class="control-group">
				<label class="control-label" for="inputEmail">Min Order</label>
				<div class="controls">
					<input type="text" id="" placeholder="Min Order" data-parsley-type="integer" value=0 name="min_order">
				    <p>If no min order then write 0</p>
                </div>
			</div>			

		    <div class="form-group">
		        <label class="col-xs-3 control-label">Discount Begin</label>
		        <div class="controls date">
		            <div class="input-group input-append date" id="datePicker">
		                <input type="text" class="form-control" placeholder="Discount Begin" name="discount_begin" 
		                	data-parsley-required="true"/>
		                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
		            </div>
		        </div>
		    </div>
		    <br/>
		    <div class="form-group">
		        <label class="col-xs-3 control-label">Discount Ends</label>
		        <div class="controls date">
		            <div class="input-group input-append date" id="datePicker1">
		                <input type="text" class="form-control" id="expire"  placeholder="Discount End"  name="discount_ends"
		                	 disabled/>
		                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
		            </div>
		        </div>
		    </div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Is Expire?</label>
				<div class="controls">
					<input type="checkbox" id="" placeholder="Expire" onclick="document.getElementById('expire').disabled=(this.checked)?0:1">
				</div>
			</div>
		</div>

	</div>
	</div>
	<!-- End Block -->

	<div class="row-fluid">
	<div class="span12">
	
		<!--  Save Button -->
		<button type="submit" class="btn btn-success pull-right">Save Discount <icon class="icon-check icon-white-t"></icon></button>
		<!-- End Save Button  -->

	</div>
	</div>
</form>
<!-- End Form  -->	
		
	</div>
	</div>	<!-- End Content  -->
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
<script>
$(document).ready(function() {
    $('#datePicker1')
        .datepicker({
            format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#eventForm').formValidation('revalidateField', 'date');
        });
});
</script>
<script language="javascript" type="text/javascript">
function randomString() {
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZ";
	var string_length = 12;
	var randomstring = '';
	for (var i=0; i<string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
	document.randform.code.value = randomstring;
}
</script>