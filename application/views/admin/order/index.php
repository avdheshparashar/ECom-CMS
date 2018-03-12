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
		<h1>Order</h1>
		<p class="lead">Manage orders</p>
		<hr />
	</div>
</div>
<div class="clearfix separator bottom"></div>

<div class="row-fluid">
	<div class="span12">
		<table class="table table-striped table-bordered table-responsive block">
			<thead>
				<tr>
					<th width="20">No.</th>
					<th   class="center" width="150">Customer Name</th>
					<th  class="center" width="20">Subtotal</th>
					<th class="center" width="10">Discount</th>
					<th class="center" width="45">Gift card</th>
					<th class="center" width="10">Total</th>
					<th class="center" width="10">Current Status</th>
					<th class="center" width="10">Change Status</th>
					<th class="center" width="20">Created</th>
					<th  class="center">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i = 0;
					if( array_key_exists(0, $orders) ):
						foreach($orders[0]['data'] as $key=>$val) { ?>
						<tr>
							<td><?php echo ++$i; ?>.</td>
							<td><?php echo $val['customer_name']; ?></td>
							<td><?php echo $val['sub_total']; ?></td>
							<td><?php echo $val['discount']; ?></td>
							<td><?php echo $val['giftcard']; ?></td>
							<td><?php echo $val['final_total']; ?></td>
							<td>
								<?php if((int) $val['order_status'] == 0) { ?>
									<label class="label label-info"> Pending</label>
								<?php } else if((int) $val['order_status'] == 1) {  ?>
									<label class="label label-info"> Cancel</label>
								<?php } else if((int) $val['order_status'] == 2) {  ?>
									<label class="label label-info"> Completed</label>
								<?php } else if((int) $val['order_status'] == 3) {  ?>
									<label class="label label-info"> Under Process</label>
								<?php } ?>
							</td>						
							<td>
									<div class="btn-group">
										<a href="#" class="btn btn-success">Change</button>
										<a class="btn btn-success dropdown-toggle" data-toggle="dropdown" href="#">
											<span class="caret"></span>
										</a>
										<ul class="dropdown-menu">
											<li><a href="<?php echo base_url();?>order/changestatus?order_id=<?php echo $val['Order_ID'];?>&status=0">
												Pending</a>
											</li>
											<li><a href="<?php echo base_url();?>order/changestatus?order_id=<?php echo $val['Order_ID'];?>&status=1">
												Cancel</a>
											</li>
											<li><a href="<?php echo base_url();?>order/changestatus?order_id=<?php echo $val['Order_ID'];?>&status=2">
												Completed</a>
											</li>
											<li><a href="<?php echo base_url();?>order/changestatus?order_id=<?php echo $val['Order_ID'];?>&status=3">
												Under Process</a>
											</li>
										</ul>
									</div>
							</td>
							<td><span class="label"><?php echo $val['created']; ?></span></td>
							<td id="pop">
								<a href="account.html?lang=en" class="btn btn-my btn-phone-block" id="my">
									<icon class="icon-pencil icon-white"></icon> Edit
								</a>
								<a href="<?php echo base_url();?>order/history/<?php echo $val['Order_ID'];?>" class="btn btn-primary btn-phone-block" data-toggle="modal">
									<icon class="icon-plus-sign icon-white"></icon>Details
								</a>
							</td>
						</tr>
				<?php }
					endif;
				?> 
			</tbody>
		</table>
	</div>
</div>

			
	</div>
</dvi>
</div>

	
	

