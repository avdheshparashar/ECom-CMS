<link href="<?php echo base_url();?>assests/admin/custom/css/select2.min.css" rel="stylesheet">	
</link>
<script type="text/javascript" src="<?php echo base_url();?>assests/admin/custom/js/select2.min.js">	
</script>

<script type="text/javascript" src="<?php echo base_url();?>assests/admin/custom/js/productedit.js">	
</script>


<div class="contentWrapper">
	<div class="container-fluid">
		
		<!--  Breadcrumb -->
		<div class="row-fluid hidden-phone">
			<div class="span12">
				<ul class="breadcrumb">
					<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
					<li>Dashboard</a></li>
					<li><span class="divider"></span>Products</li>
					<li><span class="divider"></span>Edit Product Stock</li>
				</ul>
			</div>
		</div>
		<!-- End Breadcrumb -->

		<!-- Heading  -->
		<div class="row-fluid">
			<div class="span12">
				<h1>Edit Stock Details</h1>
				<p class="lead">Manage Stock</p>
			</div>
		</div>

		<div class="tab-pane" id="lE">
			<h3>Manage Stocks</h3>

			<form method="post" action="<?php echo base_url().'index.php/product/update_inventory'?>">

				<div class="form-horizontal well">
					<legend>Stock</legend>
					<div class="control-group">
						<label class="control-label" for="inputEmail">Product is Not For Online Sale</label>
						<div class="controls">

							<?php if( (int)$info['is_purchasable'] ): ?>

								<input type="checkbox" id="size-color" name="is_purchasable" >

							<?php else: ?>

								<input type="checkbox" id="size-color" name="is_purchasable" checked/>

							<?php endif; ?>

						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="inputEmail">This Product Does not have size</label>
						<div class="controls">

							<?php if( $inventory && $product[0]['size'] == "0" ): ?>

								<input type="checkbox" name="size_free" id="size-free" checked />

							<?php else: ?>

								<input type="checkbox" name="size_free" id="size-free"/>

							<?php endif; ?>

						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="inputEmail">Price</label>
						<div class="controls">
							
								<input type="text" placeholder="Enter Price" name="price" class="no-stock" value="<?php echo $info['price'];?>"/>
							
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" for="inputEmail">Stock</label>
						<div class="controls">
							<?php if( $inventory && $product[0]['size'] == "0" ): ?>
								<input type="text" placeholder="Available Stock" name="stock" id="single-stock" value="<?php echo $product[0]['stock']; ?>"/>
							<?php else: ?>
								<input type="text" placeholder="Available Stock" name="stock" id="single-stock" value="0" disabled/>
							<?php endif; ?>
						</div>
					</div>

					<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

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

								<!-- 
									Need to check if product has some size in the stocj table or not-0////////////////////////////////////
							-->
							<?php 
								// echo "<pre>";
								// print_r( $product);
								// die();
							?>


								<?php if( $inventory && $product[0]['size'] != "0"): ?>

										<?php foreach( $product as $product_stock ): ?>

											<tr>
												<td>
													<select name="size[]" class="stock size">
														<?php foreach($sizes as $size): ?>
															<?php if( in_array($product_stock['size'], $size )): ?>
																<option value="<?php echo $size['value']; ?>" selected> <?php echo $size['value']; ?> </option>
															<?php else: ?>
																<option value="<?php echo $size['value']; ?>"> <?php echo $size['value']; ?> </option>
															<?php endif; ?>
														<?php endforeach; ?>
													</select>
												</td>
												<td>
													<input name="stock[]" class="stock stock-value" value="<?php echo $product_stock['stock']; ?>">
												</td>
												<td>
													<input type="button" value="Delete" class="btn btn-danger delete-stock-row" onclick="DeleteRow(jQuery(this));" />
												</td>
											</tr>

										<?php endforeach; ?>

								<?php else: ?>

										<tr>
											<td>
												<select name="size[]" class="stock size" disabled>
													<?php foreach($sizes as $size): ?>
														<option value="<?php echo $size['value'];; ?>"> <?php echo $size['value']; ?> </option>
													<?php endforeach; ?>
												</select>
											</td>
											<td>
												<input name="stock[]" class="stock stock-value" disabled>
											</td>
											<td>
												<input type="button" value="Delete" class="btn btn-danger delete-stock-row" onclick="DeleteRow(jQuery(this));" />
											</td>
										</tr>

								<?php endif; ?>
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
					<button type="submit" class="btn btn-success pull-right">
						Update Stock Details
						<icon class="icon-share-alt icon-white-t"></icon>
					</button>
					<a href="<?php echo base_url()."index.php/product/index";?>" class="btn btn-primary">
					Cancel
					<icon class="icon-remove icon-white-t"></icon>
				</a>
				</div>
				<div class="clearfix"></div>
				<br/>
			</form>
		</div>
	</div>
</div>