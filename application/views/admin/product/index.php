<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<div class="contentWrapper">			
		<div class="container-fluid">
		
		<!-- Breadcrumb -->
		<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li>Dashboard</a></li>
			<li><span class="divider"></span>Products</li>
			<li><span class="divider"></span>Manage Products</li>
		</ul>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
		<p class="lead">Manage Products</p>
	</div>
	<div class="span6" align="right">
		<a href="<?php echo base_url().'index.php/product/add';?>" class="btn btn-primary btn-phone-block" ><icon class="icon-plus-sign icon-white"></icon> Add Product</a>
		<a href="<?php echo base_url().'index.php/product/upload';?>" class="btn btn-primary btn-phone-block" ><icon class="icon-plus-sign icon-white"></icon> Upload Product</a>
	</div>
	<div class="clearfix"></div>
	<div class="separator"></div>
</div>
<div class="clearfix separator bottom"></div>
<!--  End Heading -->

<?php 
	if ($this->session->flashdata('flash_message')) {
       $flashdata = $this->session->flashdata('flash_message');
       echo '<div class="alert ' . $flashdata['class'] . ' fade in"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' . $flashdata['message'] . '</div>';
   	}
?>

<div class="row-fluid">
	<div class="span12">
		<form method="post" action="<?php echo base_url();?>index.php/product/delete">
		<table class="table table-striped table-bordered table-responsive block" id="example">
			<thead>
				<tr>
					<th width="1%"><input type="checkbox" onchange="checkAll(this)" /></th>
					<th width="1%">No.</th>
					<th width="8%">Image</th>
					<th width="15%">Name</th>
					<th width="15%">Ref. No.</th>
					<th width="20%">Category</th>
					<th width="5%">Price</th>
					<th width="20%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i = 0;
					if( array_key_exists(0, $products) ):
						foreach($products[0]['data'] as $key=>$val) { ?>	
						<tr>
							<td><input name="products[]" value="<?php echo $val['product_id']; ?>" type="checkbox"></td>
							<td><?php echo ++$i; ?>.</td>
							<td>
								<img src="<?php echo base_url(); ?>assests/uploads/images/<?php echo $val['main_image'];?>">
							</td>
							<td><?php echo $val['product_name'];?></td>
							<td><?php echo $val['reference_number']; ?></td>
							<td>
								<?php echo $val['category_name']; ?>
							</td>
							<td><?php echo $val['price']; ?></td>
							<td>
								<a data-toggle="tooltip" class="tooltipLink" data-original-title="Product Edit" href="<?php echo base_url();?>product/edit/<?php echo $val['product_id']?>"><span title="onf" class="glyphicon glyphicon-edit"></span></a>
								<a data-toggle="tooltip" class="tooltipLink" data-original-title="Images Edit" href="<?php echo base_url();?>productimage/edit/<?php echo $val['product_id']?>"><span class="glyphicon glyphicon-film"></span></a>
								<a data-toggle="tooltip" class="tooltipLink" data-original-title="Inventory Edit" href="<?php echo base_url();?>product/edit_inventory/<?php echo $val['product_id']?>"><span class="glyphicon glyphicon-list-alt"></span></a>
<!-- 	                            <a href="<?php echo base_url();?>product/makefeatured/<?php echo $val['product_id']?>" class="btn btn-success btn-phone-block"><icon class="icon-pencil icon-white"></icon>
	                                <?php
	                                    if($val['is_featured']==0) {
	                                        echo "Make Featured";
	                                    } else {
	                                        echo "Unfeatured";
	                                    }
	                                ?>
	                            </a>
 -->							</td>						
						</tr>
				<?php }
					endif;
				?>	
			</tbody>
			<tfoot>
				<tr><td colspan="12"><input type="submit" id="delete-me" value="Delete"  class="btn btn-danger" onclick="return confirm('Are You Sure You Want To Delete Selected Product')" /></td></tr>
			</tfoot>			
		</table>
	</div>
</div>

	</div>
</dvi>
</div>
<script type="text/javascript">$("a.tooltipLink").tooltip();</script>
	
	

