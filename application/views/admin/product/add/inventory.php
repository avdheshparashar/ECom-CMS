<div class="tab-pane" id="lD">
	<div class="form-horizontal well">
		<legend>Stock</legend>
		<div class="control-group">
			<label class="control-label" for="inputEmail">Product is Not For Online Sale</label>
			<div class="controls">
				<input type="checkbox" id="size-color" name="not_inventory">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="inputEmail">This Product Does not have size</label>
			<div class="controls">
				<input type="checkbox" name="size_free" id="size-free"/>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="inputEmail">Price</label>
			<div class="controls">
				<input type="text" placeholder="Enter Price" name="price" class="no-stock"/>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="inputEmail">Stock</label>
			<div class="controls">
				<input type="text" placeholder="Available Stock" name="stock" id="single-stock" disabled/>
			</div>
		</div>


		<div class="control-group">

			<table class="table stock-table">
				<thead>
					<tr>
						<td>
							Size
						</td>
						<td>
							Stock
						</td>
						<td>
							Delete
						</td>
					</tr>
				</thead>
				<tbody class="stock-table-body">
					<tr>
						<td>
							<select name="size[]" class="stock size">
								<?php foreach($sizes as $size): ?>
									<option value="<?php echo $size['value'];; ?>"> <?php echo $size['value']; ?> </option>
								<?php endforeach; ?>
							</select>
						</td>
						<td>
							<input name="stock[]" class="stock stock-value">
						</td>
						<td>
							<input type="button" value="Delete" class="btn btn-danger delete-stock-row" onclick="DeleteRow(jQuery(this));" />
						</td>
					</tr>
				</tbody>
			</table>
			
		</div>								

		<div class="control-group">
			<label class="control-label" for="inputEmail"></label>
			<div class="controls">
				<button type="button" class="btn" id="add-more-stock">
					Add more
					<icon class="icon-plus icon-brown"></icon>
				</button>
			</div>
		</div>
	</div>

	<div class="pull-right">
		<a href="#lE" data-toggle="tab" next-target="#lE" class="next-tab">
			<button type="button" class="btn btn-success pull-right">
				Continue 
				<icon class="icon-share-alt icon-white-t"></icon>
			</button>
		</a>
	</div>
	<div class="clearfix"></div>
	<br/>

</div>