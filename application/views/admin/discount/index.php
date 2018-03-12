<div class="contentWrapper">			
		<div class="container-fluid">
		
		<!-- Breadcrumb -->
		<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li>Dashboard</a></li>
			<li><span class="divider"></span>Discounts</li>
			<li><span class="divider"></span>Manage Discounts</li>
		</ul>
	</div>
</div>
		
<div class="clearfix separator bottom"></div>
<!--  End Heading -->

<div class="row-fluid">
	<div class="span6">
		<p class="lead">Manage Discounts</p>
	</div>
	<div class="span6"  align="right">
		<a href="<?php echo base_url();?>discount/add" class="btn btn-primary"><icon class="icon-plus-sign icon-white"></icon> Add Discount</a>
	</div>
	<div class="clearfix"></div>
	<div class="separator"></div>
</div>
<?php echo $this->load->view("admin/flash.php"); ?>

<div class="row-fluid">
	<div class="span12">
		<form method="post" action="<?php echo base_url();?>discount/cancel">
		<table class="table table-striped table-bordered table-responsive block" id="example">
			<thead>
				<tr>
					<th width="1%"><input type="checkbox" onchange="checkAll(this)" /></th>
					<th width="1%">No.</th>
					<th width="5%">Name</th>
					<th width="5%">Code</th>
					<th width="2%">User Limit</th>
					<th width="20%">Categories</th>
					<th width="3%">Discount</th>
					<th width="3%"> Min Order</th>
					<th width="5%">Start Date</th>
					<th width="5%">End Date</th>
					<th width="5%">Status</th>
					<th width="5%">Date</th>
					
				</tr>
			</thead>
			<tbody>
				<?php 
					$i = 0;
					if( array_key_exists(0, $discounts) ):
						foreach($discounts[0]['data'] as $key=>$val) { ?>	
						<tr>
							<td><input name="discountids[]" value="<?php echo $val['discount_id']; ?>" type="checkbox"></td>
							<td><?php echo ++$i; ?>.</td>
							<td><?php echo $val['name']; ?></td>
							<td><?php echo $val['code']; ?></td>
							<td>
								<?php if($val['is_limit'] == 0) {
									echo "No Limit";
								} else {
									echo $val['is_limit'];
								}
								?>
							</td>
							<td><?php echo $val['category_name'];?></td>
							<td>
								<?php if($val['discount_type'] == 1) {
									echo $val['discount_amount']."% Off"; 
								} else {
									echo "RS. ".$val['discount_amount']." Off"; 
								}
								?>							
							</td>
							<td>
								<?php if($val['min_order'] == 0) {
									echo "No Min Order Required";
								} else {
									echo $val['min_order'];
								}
								?>
							</td>
							<td><span class="label"><?php echo $val['discount_begin']; ?></span></td>
							<td><span class="label"><?php echo $val['discount_ends']; ?></span></td>
							<td>
								<?php if($val['status'] == 0) { ?>
									<label class="label label-info"> Pending</label>
								<?php } else { ?>
									<label class="label label-info"> Approved</label>
								<?php } ?>
							</td>
							<td><span class="label"><?php echo $val['created']; ?></span></td>
						</tr>
				<?php }
					endif;
				 ?>	
			</tbody>
			<tfoot>
				<tr><td colspan="12"><input type="submit" id="delete-me" value="Change Status"  class="btn btn-danger"/></td></tr>	
			</tfoot>			
		</table>
	</div>
</div>
	<!-- Categories Table -->
			
	</div>
</dvi>
</div>

	
	

