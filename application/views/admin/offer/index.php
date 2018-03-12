<div class="contentWrapper">			
		<div class="container-fluid">
		
		<!-- Breadcrumb -->
		<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li>Dashboard</a></li>
			<li><span class="divider"></span>Offers</li>
			<li><span class="divider"></span>Manage Offers</li>
		</ul>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
		<p class="lead">Manage Offers</p>
	</div>
	<div class="span6" align="right">
		<a href="<?php echo base_url().'offer/add';?>" class="btn btn-primary btn-phone-block" ><icon class="icon-plus-sign icon-white"></icon> Add Offer</a>
	</div>
	<div class="clearfix"></div>
	<div class="separator"></div>
</div>
<div class="clearfix separator bottom"></div>

<?php echo $this->load->view("admin/flash.php"); ?>
<div class="row-fluid">
	<div class="span12">
	<form method="post" action="<?php echo base_url();?>offer/cancel">
		<table class="table table-striped table-bordered table-responsive block" id="example">
			<thead>
				<tr>
					<th class="center"  width="2%"><input type="checkbox" onchange="checkAll(this)" /></th>
					<th width="2%">No.</th>
					<th width="20%">Name</th>
					<th width="20%">Discount</th>
					<th width="11%">Start Date</th>
					<th width="11%">End Date</th>
					<th width="20%">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i = 0;
					if( array_key_exists(0, $offers) ):
						foreach($offers[0]['data'] as $key=>$val): ?>	
						<tr>
							<td><input name="offerids[]" value="<?php echo $val['offer_id']; ?>" type="checkbox"></td>
							<td><?php echo ++$i; ?>.</td>
							<td><?php echo $val['offer_name']; ?></td>
							<td><?php echo $val['discount_amount']."% Off"; ?></td>
							<td><span class="label"><?php echo $val['start']; ?></span></td>
							<td><span class="label"><?php echo $val['end']; ?></span></td>
							<td><span class="label"><?php echo $val['created']; ?></span></td>
							<td class="center" id="pop">						
								<a href="<?php echo base_url();?>offer/edit/<?php echo $val['offer_id']?>" class="btn btn-success btn-phone-block"><icon class="icon-pencil icon-white"></icon> Edit</a>
							</td>
						</tr>
				<?php 	endforeach;
					endif;
				 ?>
			</tbody>
			<tfoot>
				<tr><td colspan="10"><input type="submit" id="delete-me" value="Delete"  class="btn btn-danger"/></td></tr>	
			</tfoot>
		</table>
	</div>
</div>
	<!-- Categories Table -->			
	</div>
</dvi>
</div>

	
	

