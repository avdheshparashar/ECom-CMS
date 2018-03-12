<script type="text/javascript" src="<?php echo base_url(); ?>assests/ckeditor/ckeditor.js"></script>
<div class="tab-pane active" id="lA">
	<div class="form-horizontal well">
		<div class="form-horizontal well">
			<legend>Basic Details</legend>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Product name</label>
				<div class="controls">
					<input type="text" id="f1" class="input" placeholder="Enter Name" name="name" data-parsley-required="true">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Product Code</label>
				<div class="controls">
					<input type="text" name="reference_number" class="input" placeholder="Enter Unique Code" data-parsley-required="true">
				</div>
			</div>


			<div class="control-group">
				<label class="control-label" >Category</label>
				<div class="controls">
					<select name="category_ids[]" id="category_id" data-parsley-required="true" multiple>
						<?php foreach($categories as  $category): ?>

							<option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>

						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" >Brand</label>
				<div class="controls">
					<select name="brand_id" id="brand_id" data-parsley-required="true">
						<?php foreach($brands as  $brand): ?>
							<option onchange="getbrandid(this);" value="<?php echo $brand['brand_id']; ?>"><?php echo $brand['name']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Tags</label>
				<div class="controls">
					<select name="tags[]"  class="product-tags" data-parsley-required="true" multiple></select>
				</div>
			</div>

		</div>
	
		<div class="form-horizontal well">
            <div class="control-group">
                <label class="control-label" for="inputEmail">Short Description</label>
                <div class="controls">
                    <textarea class="span12" rows="4" placeholder="short descritption" name="short_description"></textarea>
                </div>
            </div>


            <div class="control-group">
                <label class="control-label" for="inputEmail">Long Description</label>
                <div class="controls">
                    <?php echo $this->ckeditor->editor("description","description"); ?>
                </div>
            </div>
		</div>
	</div>

	<div class="clearfix"></div>
	<div class="pull-right">
		<a href="#lB" data-toggle="tab" next-target="#lB" class="next-tab">
			<button type="button" class="btn btn-success pull-right">
				Continue 
				<icon class="icon-share-alt icon-white-t"></icon>
			</button>
		</a>
		
	</div>
	<div class="clearfix"></div>
	<br/>
</div>
<script>
    $(document).ready(function () {
        $("#f1").keypress(function (e) {
            var val = $('#f2').val();
            var val = $('#f3').val();
            var val = $('#f4').val();
            var code = e.which || e.keyCode;
            $('#f2').val(val+(String.fromCharCode(code)));
            $('#f3').val(val+(String.fromCharCode(code)));
            $('#f4').val(val+(String.fromCharCode(code)));
        });
    });
</script>