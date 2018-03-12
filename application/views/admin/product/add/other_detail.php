<script type="text/javascript" src="<?php echo base_url(); ?>assests/ckeditor/ckeditor.js"></script>
<div class="tab-pane" id="lF">
	<div class="form-horizontal well">
		<div class="form-horizontal well">
			<legend>Product Specification and Description</legend>

			<div id="spec-div">
				<div class="control-group">
					<label class="control-label" for="inputEmail">Specification</label>
					<div class="controls">
						<input type="text" id="spec-name" class="input" placeholder="Enter Specification">
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="inputEmail">Description</label>
					<div class="controls">
						<input type="text" class="input" placeholder="Enter Specification's Description" id="spec-value">
					</div>
				</div>
			</div>

			<div class="clearfix"></div>
			<div class="pull-right">
				<button type="button" class="btn btn-success pull-right" id="more-description">
					Add
					<icon class="icon-share-alt icon-white-t"></icon>
				</button>
			</div>
			<div class="clearfix"></div>
		</div>

		<div class="form-horizontal well">
			<legend>Additional Information</legend>
			<div class="control-group">
				<label class="control-label" for="inputEmail">Additional Information</label>
				<div class="controls">
                    <?php echo $this->ckeditor->editor("additional_info","additional info"); ?>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="inputEmail">Video Link</label>
				<div class="controls">
					<textarea class="span12 wysihtml5" rows="5" placeholder="Add Video Link" name="video"></textarea>
				</div>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>
	<div class="pull-right">
		<button type="submit" class="btn btn-primary pull-right save-product">
			Save product 
			<icon class="icon-ok icon-white-t"></icon>
		</button>
	</div>
	<div class="clearfix"></div>
	<br/>
</div>