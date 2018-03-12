<div class="contentWrapper">			
		<div class="container-fluid">
		
		<!-- Breadcrumb -->
		<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li>Dashboard</li>
			<li><span class="divider"></span>Inquiries</li>
			<li><span class="divider"></span>Manage Inquiries</li>
		</ul>
	</div>
</div>
<div class="clearfix separator bottom"></div>
<!--  End Heading -->

<div class="row-fluid">
	<div class="span6">
		<p class="lead">Manage Inquiries</p>
	</div>
</div>
<?php echo $this->load->view("admin/flash.php"); ?>
<div class="row-fluid">
	<div class="span12">
	<form method="post" action="<?php echo base_url();?>inquiry/cancel">
		<table class="table table-striped table-bordered table-responsive block" id="example">
			<thead>
				<tr>
					<th class="center"  width="1%"><input type="checkbox" onchange="checkAll(this)" /></th>
					<th  class="center" width="2%">No.</th>
					<th class="center"  width="15%">Product Name</th>
					<th  class="center" width="15%">Customer Name</th>
					<th  class="center" width="15%">Email</th>
					<th  class="center" width="10%">Mobile</th>
					<th  class="center" width="20%">Created</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i = 0;
					if( array_key_exists(0, $inquiries) ):

						foreach($inquiries[0]['data'] as $key=>$val) { ?>
						<tr>
							<td><input name="inquiryids[]" value="<?php echo $val['inquiry_id']; ?>" type="checkbox"></td>
							<td><?php echo ++$i; ?>.</td>
							<td><?php echo $val['Product Name']; ?></td>
							<td><?php echo $val['Customer Name']; ?></td>
							<td><?php echo $val['email']; ?></td>
							<td><?php echo $val['mobilenumber']; ?></td>
							<td><span class="label"><?php echo $val['created']; ?></span></td>
							<td  class="center" id="pop1">
								<a href="#" class="btn btn-primary btn-phone-block" data-toggle="modal">
									<icon class="icon-plus-sign icon-white"></icon>Details
								</a>
								<?php if($val['is_reply'] == 0) { ?> 
									<a href="<?php echo base_url();?>inquiry/reply/<?php echo $val['inquiry_id'];?>" class="btn btn-success btn-phone-block"><icon class="icon-check icon-white"></icon> Reply</a>
								<?php } ?>
							</td>
						</tr>
				<?php }
					endif;
				?> 
			</tbody>
			<tfoot>
				<tr><td colspan="9"><input type="submit" id="delete-me" value="Delete"  class="btn btn-danger"/></td></tr>	
			</tfoot>			
		</table>
	</div>
</div>
	<!-- Categories Table -->

	</div>
</dvi>
</div>

	
	

