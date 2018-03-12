<div class="tab-pane" id="lB">
	<h3>Set Attributes</h3>
	<div class="form-horizontal well">
		<div class="form-horizontal well">
			<legend>Assign Attributes to Product</legend>
			
			<?php foreach($fields as $key => $field ): ?>
				<div class="control-group">
					<label class="control-label"><?php echo $field['name']?></label>
					<?php 
						$optns = explode(',', $field['content']);
					?>
					<input name="details[<?php echo $key;?>][field_id]" value="<?php echo $field['field_id']; ?>" type="hidden">

					<div class="controls">
						<select name="details[<?php echo $key;?>][data][]"  class="product-fields" multiple>

							<?php foreach($optns as $optn): ?>
								<?php if( in_array( $optn, $old_details ) ): ?>
									<option value="<?php echo $optn; ?>" selected><?php echo $optn; ?></option>
								<?php else: ?>
									<option value="<?php echo $optn; ?>"><?php echo $optn; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>

						</select>
					</div>
				</div>
			<?php endforeach;  ?>
		</div>
		<div class="form-horizontal well">

			<legend>Add Stamp</legend>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Choose Stamp</label>
				<div class="controls">
					<?php if( $product['stamp'] == "Hot" ): ?>
						<input name="stamp" type="radio" for="stamp" value="Hot" checked>Hot</input>
						<input name="stamp" type="radio" for="stamp" value="Trending">Trending</input>
					<?php else: ?>
						<input name="stamp" type="radio" for="stamp" value="Hot">Hot</input>
						<input name="stamp" type="radio" for="stamp" value="Trending" checked>Trending</input>
					<?php endif ?>

				</div>
			</div>

		</div>

	</div>
	<div class="pull-right">
		<a href="#lC" data-toggle="tab" next-target="#lC" class="next-tab">
			<button type="button" class="btn btn-success pull-right">
				Continue 
				<icon class="icon-share-alt icon-white-t"></icon>
			</button>
		</a>
	</div>
	<div class="clearfix"></div>
	<br/>
</div>