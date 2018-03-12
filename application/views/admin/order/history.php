<div class="contentWrapper">			
		<div class="container-fluid">
		
		<!-- Breadcrumb -->
		<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li class="active">You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li><a href="dashboard.html?lang=en">Dashboard</a></li>
			<li class="active"><span class="divider"></span>Sales <span class="divider"></span>Orders</li>
		</ul>
	</div>
</div>
		<div class="row-fluid">
	<div class="span12">
		<h1>Orders</h1>
		<p class="lead">Manage orders</p>
		<hr />
	</div>
</div>
<div class="clearfix separator bottom"></div>
<!--  End Heading -->
<div class="row-fluid">
	<div class="span12">
		<table class="table table-striped table-bordered table-responsive block">
			<thead>
				<tr>
					<th width="20">No.</th>
					<th width="250">Product Name </th>
					<th width="200"> Product Info</th>
					<th class="center" width="20">Qty</th>
					<th class="center" width="20"> Price</th>
					
				</tr>
			</thead>
			<tbody>
				<?php 
					$i = 0;
					foreach($orderdetails[0]['data'] as $key=>$val) { ?>
					<tr>
						<td><?php echo ++$i; ?>.</td>
						<td>
							<span class="thumbnail product hidden-phone">
								<img src="http://www.placehold.it/50x50/FFE097/763D00&text=product" />
							</span>
							<?php echo $val['name']; ?>
						</td>
						<?php print_r(json_decode($val['parameter'],true)); ?>
						<td><?php echo $val['parameter']; ?></td>
						<td><?php echo $val['qty']; ?></td>
						<td><?php echo $val['price']; ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
	<!-- Categories Table -->


<!--  Modal Product -->
<div class="hide modal" id="modalCategory">
	<div class="modal-header">
		<p>
			Add inquiry			<button type="button" class="close " data-dismiss="modal" aria-hidden="true">&times;</button>
		</p>
	</div>
	<div class="modal-body">
		<form class="form-horizontal">
				<div class="control-group">
				<label class="control-label">Category name:</label>
				<div class="controls">
					<input type="text" class="input-xx" placeholder="Category name .." />
				</div>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<a href="products-add.html?lang=en" class="btn btn-primary">Save & Continue <icon class="icon-share-alt icon-white"></icon></a>
	</div>
</div>
<!--  End Modal Product -->

<!--  Modal Category -->
<div class="hide modal" id="details">
	<div class="modal-header">
		<p>
			Details		<button type="button" class="close " data-dismiss="modal" aria-hidden="true">&times;</button>
		</p>
	</div>
	<div class="modal-body">
		<form class="form-horizontal">
			<div class="control-group">
				<label class="control-label">Category name:</label>
				<div class="controls">
					<input type="text" class="input-xx" placeholder="Category name .." />
				</div>
			</div>
			
			<div class="control-group">
				<label class="control-label" for="inputEmail">Visible</label>
				<div class="controls">
					<input type="checkbox" checked="checked" />
				</div>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<a href="categories.html?lang=en" class="btn btn-primary">Save & Continue <icon class="icon-share-alt icon-white"></icon></a>
	</div>
	
</div>
<!--  End Modal Category -->	
			
<!--  Pagination -->
		<div class="pagination">
			<ul>
				<?php if($active == 1) { ?>
					<li class="disabled">
						<a href="#">Prev</a>
					</li>
				<?php } else { ?>
					<li>
						<a href="<?php echo base_url();?>index.php/order/history/<?php echo $orderid; ?>?page=<?php echo $active-1;?>">Prev</a>
					</li>
				<?php } ?>
				<?php for($i=1;$i<=$orderdetails[0]['count'];$i++) { 
						if($i ==(int) $active) {
				?>
					<li class="active hidden-phone">
				<?php } else { ?>
					<li class="hidden-phone">
				<?php } ?>		
						<a href="<?php echo base_url();?>index.php/order/history/<?php echo $orderid; ?>?page=<?php echo $i;?>">
							<?php echo $i;?>
						</a>
					</li>
				<?php } ?>
				<?php if($orderdetails[0]['count'] == $active) { ?>
					<li class ="disabled">
						<a href="#">Next &raquo;</a>
					</li>
				<?php } else { ?>
					<li>
						<a href="<?php echo base_url();?>index.php/order/history/<?php echo $orderid; ?>?page=<?php echo $active+1;?>">Next &raquo;</a>
					</li>
				<?php } ?>		
			</ul>
		</div>
		<!-- End  Pagination -->
	</div>
</dvi>
</div>

	
	

