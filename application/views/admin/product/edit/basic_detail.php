<script type="text/javascript" src="<?php echo base_url(); ?>assests/ckeditor/ckeditor.js"></script>
<div class="tab-pane active" id="lA">
	<h3>Product details</h3>
	<div class="form-horizontal well">
		<div class="form-horizontal well">
			<legend>Basic Details</legend>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Product name</label>
				<div class="controls">
					<input type="text" id="" class="input" placeholder="Enter Name" name="name" data-parsley-required="true"
						value="<?php echo $product['name']; ?>">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Product Code</label>
				<div class="controls">
					<input type="text" name="reference_number" class="input" placeholder="Enter Unique Code" data-parsley-required="true"
						value="<?php echo $product['reference_number']; ?>">
				</div>
			</div>

			<input name="product_id" value="<?php echo $product['product_id']; ?>" type="hidden" />

			<div class="control-group">
				<label class="control-label" >Category</label>
				<div class="controls">
					<?php $selected_categories = explode(',', $product['category'] ); ?>
					<select name="category_ids[]" id="category_id" data-parsley-required="true" multiple>
						<?php foreach($categories as $category ): ?>
							<?php if( in_array( $category['category_id'], $selected_categories ) ): ?>
								<option value="<?php echo $category['category_id']; ?>" selected><?php echo $category['name']; ?></option>
							<?php else: ?>
								<option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
							<?php endif; ?>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" >Brand</label>
				<div class="controls">
					<select name="brand_id" id="brand_id" data-parsley-required="true">
						<?php foreach($brands as  $brand): ?>
							<?php if( $brand['brand_id'] == $product['brand_id'] ): ?>
								<option value="<?php echo $brand['brand_id']; ?>" selected><?php echo $brand['name']; ?></option>
							<?php else: ?>
								<option value="<?php echo $brand['brand_id']; ?>"><?php echo $brand['name']; ?></option>
							<?php endif; ?>

						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Tags</label>
				<div class="controls">

					<select name="tags[]"  class="product-tags" data-parsley-required="true" multiple>
						<?php $tags = explode(',', $product['tag']); ?>
						<?php foreach($tags as $tag ): ?>
							<option value="<?php echo $tag; ?>" selected><?php echo $tag; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
		</div>
	
		<div class="form-horizontal well">
            <div class="control-group">
                <label class="control-label" for="inputEmail">Short Description</label>
                <div class="controls">
                    <textarea class="span12" rows="4" placeholder="short description" name="short_description"><?php echo $product['short_description']; ?></textarea>
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