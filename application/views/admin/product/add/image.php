<div class="tab-pane" id="lB">
	<div class="form-horizontal well">
		<legend>Images for Product</legend>
		<div class="control-group">
			<label class="control-label" >Main Image</label>
			<div class="controls">
				<input name="main_image" type="file" data-parsley-required="true">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="inputEmail">Other Images</label>
			<div class="controls">
				<input name="other_image[]" type="file" multiple="multiple">
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

	<!-- End Upload Plugin -->
</div>