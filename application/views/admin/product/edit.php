<link href="<?php echo base_url();?>assests/admin/custom/css/select2.min.css" rel="stylesheet">	
</link>
<script type="text/javascript" src="<?php echo base_url();?>assests/admin/custom/js/select2.min.js">	
</script>

<script type="text/javascript" src="<?php echo base_url();?>assests/admin/custom/js/productedit.js">	
</script>

<!-- Start Content -->
<div class="contentWrapper">
	<div class="container-fluid">
		<!-- Breadcrumb -->
		<div class="row-fluid hidden-phone">
			<div class="span12">
				<ul class="breadcrumb">
					<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
					<li>Dashboard</a></li>
					<li><span class="divider"></span>Products</li>
					<li><span class="divider"></span>Edit Products</li>
				</ul>
			</div>
		</div>
		<!-- End Breadcrumb -->
		<!-- Heading  -->
		<div class="row-fluid">
			<div class="span12">
				<p class="lead">Edit Product</p>
				<hr />
			</div>
		</div>

		<?php 
			if ($this->session->flashdata('flash_message')) {
		       $flashdata = $this->session->flashdata('flash_message');
		       echo '<div class="alert ' . $flashdata['class'] . ' fade in"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">Ã—</button>' . $flashdata['message'] . '</div>';
		   	}
		?>

		<div class="clearfix separator bottom"></div>
		<!--  End Heading-->
		<div class="row-fluid">
			<!--  Tabs -->
			<div class="span3">
				<ul class="tabs-arrow">
					<li class="active my-tab-item"><a class="glyphicons pencil" href="#lA" data-toggle="tab"><i></i> 1. Add details</a></li>
					<li class="my-tab-item"><a class="glyphicons list" href="#lB" data-toggle="tab"><i></i> 2. Attributes</a></li>
					<li class="my-tab-item"><a class="glyphicons pencil" href="#lC" data-toggle="tab"><i></i> 3. For SEO</a></li>
					<li class="my-tab-item"><a class="glyphicons list" href="#lD" data-toggle="tab"><i></i> 4. Other Details</a></li>
				</ul>
				<button type="submit" class="btn btn-primary save-product">
					Save product 
					<icon class="icon-ok icon-white-t"></icon>
				</button>
				<a href="<?php echo base_url()."index.php/product/index";?>" class="btn btn-primary">
					Cancel
					<icon class="icon-remove icon-white-t"></icon>
				</a>
				<div class="clearfix"></div>
				<br/>
			</div>
			<!-- End Tabs -->

			<form method="POST" class="span9" id="product-edit" action="<?php echo base_url();?>index.php/product/update">

				<!--  Tab Content -->
				<div class="span12">
					<div class="tab-content">
						<!--  Tab Content Block -->

						<?php echo $tabdetails; ?>

						<!--  End Tab Content Block -->
					</div>
				</div>
			</form>
			<!-- End Tab Content  -->
		</div>
	</div>
</div>
<!-- End Content  -->