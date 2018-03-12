<div class="contentWrapper">			
		<div class="container-fluid">
		
		<!-- Breadcrumb -->
		<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li>Dashboard</a></li>
			<li><span class="divider"></span>Sizes</li>
			<li><span class="divider"></span>Manage Brands</li>
		</ul>
	</div>
</div>
<?php echo $this->load->view("admin/flash.php"); ?>
</div>
<div class="clearfix separator bottom"></div>
<!--  End Heading -->
<div class="row-fluid">	
	<div class="span6">
		<p class="lead">Manage Brands</p>
	</div>
	<div class="span6" align="right">
		<p class="lead">Add Brands</p>
	</div>
	
	<div class="clearfix"></div>
	<div class="separator"></div>
</div>
<div class="row-fluid">
	<div class="span6">
	<form method="post" action="<?php echo base_url();?>brand/cancel">
		<table class="table table-striped table-bordered table-responsive block" id="example">
			<thead>
				<tr>
					<th width="1%"><input type="checkbox" onchange="checkAll(this)" /></th>
					<th class="center"  width="89%">Name</th>
					<th class="center"  width="10%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i = 0;
					foreach($brands[0]['data'] as $key=>$val) { ?>
					<tr>
						<td><input name="brandids[]" value="<?php echo $val['brand_id']; ?>" type="checkbox"></td>
						<td><?php echo $val['name']; ?></td>
						<td id="pop">
							<a href="<?php echo base_url();?>brand/index/<?php echo $val['brand_id']?>" class="btn btn-success btn-phone-block">
								<icon class="icon-pencil icon-white"></icon> Edit
							</a>
						</td>	
					</tr>
				<?php } ?> 
			</tbody>
			<tfoot>
				<tr><td colspan="9"><input type="submit" id="delete-me" value="Delete"  class="btn btn-danger"/></td></tr>	
			</tfoot>			
		</table>
	</div>
	</form>
	<div class="span6">
		<form action="<?php echo base_url();?>brand/save" method="post" enctype="multipart/form-data">
		<div class="form-horizontal well">
			<?php 
				if($branddetail[0]['banner_image']) {?>
					<input type="hidden" value="<?php echo $branddetail[0]['brand_id']; ?>" name="brand_id">
			<?php } ?>	
			<div class="control-group">
				<label class="control-label" for="inputEmail">Brand Name</label>
				<div class="controls">
					<input type="text" id="" class="input-block" placeholder="Brand Name" name="name" data-parsley-required="true" value="<?php echo $branddetail[0]['name'];?>">
				</div>
			</div>
			<div class="control-group">
			<div class="controls">
			<?php 
				if($branddetail[0]['banner_image']) {?>
					<img src="<?php echo base_url();?>assests/images/brands/<?php echo $branddetail[0]['banner_image']; ?>" width="200px" height="100px">
			<?php } 
			?>
			</div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputEmail">Banner Image</label>
				<div class="controls">
					<input id="" type="file" placeholder="keyword1 keyword2 other" name="banner_image" data-parsley-required="true">
				</div>
			</div>

		</div>
		<?php if($branddetail[0]['brand_id']) {?>
			<a href="<?php echo base_url();?>brand/index" class="btn btn-primary pull-right">
				Cancel<icon class="icon-remove icon-white-t"></icon>
			</a>
		<?php } ?>
		<button type="submit" class="btn btn-success pull-right">Save Brand <icon class="icon-check icon-white-t"></icon></button>
		</form>
	</div>
</div>
	<!-- Categories Table -->


	
	</div>
</dvi>
</div>

	
	


