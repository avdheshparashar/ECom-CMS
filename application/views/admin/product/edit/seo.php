<div class="tab-pane" id="lC">
	<h3>For SEO</h3>
	<div class="form-horizontal well">
		<legend>For SEO Purpose</legend>

		<div class="control-group">
			<label class="control-label" >Page Title</label>
			<div class="controls">
				<input type="text" name="page_title" class="input" placeholder="Title for Page"
					value="<?php echo $product['page_title']; ?>">
			</div>
		</div>
			
		<div class="control-group">
			<label class="control-label" for="inputEmail">Meta Description</label>
			<div class="controls">
				<textarea class="span12 wysihtml5" id="page_content" rows="5" placeholder="Add More details"
					 name="meta_description"><?php echo trim($product['meta_description']); ?></textarea>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputEmail">Meta keywords</label>
			<div class="controls">
				<textarea class="span12 wysihtml5" id="page_content" rows="5" placeholder="Add More details"
					name="meta_keywords"><?php echo trim($product['meta_keywords']); ?></textarea>
			</div>
		</div>

	</div>
	<div class="pull-right">
		<a href="#lD" data-toggle="tab" next-target="#lD" class="next-tab">
			<button type="button" class="btn btn-success pull-right">
				Continue 
				<icon class="icon-share-alt icon-white-t"></icon>
			</button>
		</a>
	</div>
	<div class="clearfix"></div>
	<br/>

</div>
