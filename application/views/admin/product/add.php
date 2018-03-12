<link href="<?php echo base_url();?>assests/admin/custom/css/select2.min.css" rel="stylesheet">	
</link>
<script type="text/javascript" src="<?php echo base_url();?>assests/admin/custom/js/select2.min.js">	
</script>

<script type="text/javascript" src="<?php echo base_url();?>assests/admin/custom/js/productadd.js">	
</script>

<!-- Start Content -->
<div class="contentWrapper">
	<div class="container-fluid">
		<!-- Breadcrumb -->
		<div class="row-fluid hidden-phone">
			<div class="span12">
				<ul class="breadcrumb">
					<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
					<li>Dashboard</li>
					<li><span class="divider"></span>Products</li>
					<li><span class="divider"></span>Add Product</li>
				</ul>
			</div>
		</div>
		<!-- End Breadcrumb -->
		<!-- Heading  -->
<div class="row-fluid">
	<div class="span6">
		<p class="lead">Add Product</p>
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
					<li class="my-tab-item"><a class="glyphicons camera" href="#lB" data-toggle="tab"><i></i> 2. Add images</a></li>
					<li class="my-tab-item"><a class="glyphicons list" href="#lC" data-toggle="tab"><i></i> 3. Attributes</a></li>
					<li class="my-tab-item"><a class="glyphicons list" href="#lD" data-toggle="tab"><i></i> 4. Manage Stock</a></li>
					<li class="my-tab-item"><a class="glyphicons pencil" href="#lE" data-toggle="tab"><i></i> 5. For SEO</a></li>
					<li class="my-tab-item"><a class="glyphicons list" href="#lF" data-toggle="tab"><i></i> 6. Other Details</a></li>
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

			<form method="post" class="span9" id="product-add" action="<?php echo base_url();?>index.php/product/add" 
					enctype="multipart/form-data" accept-charset="utf-8" data-parsley-trigger="change" data-parsley-ui-enabled="true" 
					data-parsley-validate>


				<!--  Tab Content -->
				<div class="span12">
					<div class="tab-content">

						<?php echo $this->load->view('admin/product/add/basic_detail.php'); ?>
						<?php echo $this->load->view('admin/product/add/seo.php'); ?>
						<?php echo $this->load->view('admin/product/add/image.php'); ?>
						<?php echo $this->load->view('admin/product/add/attribute.php'); ?>
						<?php echo $this->load->view('admin/product/add/inventory.php'); ?>
						<?php echo $this->load->view('admin/product/add/other_detail.php'); ?>




					</div>
				</div>
			</form>
			<!-- End Tab Content  -->
		</div>
		<!-- modal-gallery is the modal dialog used for the image gallery -->
		<div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd" tabindex="-1">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">&times;</a>
				<h3 class="modal-title"></h3>
			</div>
			<div class="modal-body">
				<div class="modal-image"></div>
			</div>
			<div class="modal-footer">
				<a class="btn modal-download" target="_blank"><i class="icon-download"></i> <span>Download</span></a>
				<a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000"><i class="icon-play icon-white"></i> <span>Slideshow</span></a>
				<a class="btn btn-info modal-prev"><i class="icon-arrow-left icon-white"></i> <span>Previous</span></a>
				<a class="btn btn-primary modal-next"><span>Next</span> <i class="icon-arrow-right icon-white"></i></a>
			</div>
		</div>
	</div>
</div>
<!-- End Content  -->