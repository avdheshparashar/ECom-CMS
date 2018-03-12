<div class="contentWrapper">			
<div class="container-fluid">
		
		<!-- Breadcrumb -->
	<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li>Dashboard</a></li>
			<li><span class="divider"></span>Categories</li>
			<li><span class="divider"></span>Manage Categories</li>
		</ul>
	</div>
</div>
		
<div class="clearfix separator bottom"></div>
<!--  End Heading -->

<?php echo $this->load->view("admin/flash.php"); ?>

<div class="row-fluid">

	<!--  Buttons -->
	<div class="span6">
		<p class="lead">Manage categories</p>
	</div>
	<div class="span6"  align="right">
		<a href="<?php echo base_url();?>category/add" class="btn btn-primary"><icon class="icon-plus-sign icon-white"></icon> Add category</a>
	</div>
	<div class="clearfix"></div>
	<div class="separator"></div>
	<!-- End Buttons -->
</div>

<div class="row-fluid">
	<div class="span12">
		<table class="table table-striped table-bordered table-responsive block " id="example">
			<thead>
				<tr>
					<th width="2%">No.</th>
					<th  class="center" width="18%">Category Name</th>
					<th   class="center" width="18%">Parent Category</th>
					<th class="center" width="5%">Date</th>
					<th  class="center" width="10%">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i = 0;

					if( array_key_exists(0, $categories) ):

					foreach($categories[0]['data'] as $key=>$val): ?>
							<tr>
								<td class="center"><?php echo ++$i; ?>.</td>
								<td><?php echo $val['category_name']; ?></td>
								<td><?php echo $val['parent_name']; ?></td>
								<td><span class="label"><?php echo $val['created']; ?></span></td>
								<td  class="center" id="pop">
									<a href="<?php echo base_url();?>category/edit/<?php echo $val['category_id']?>" class="btn btn-success btn-phone-block"><icon class="icon-pencil icon-white"></icon> Edit</a>
									<a href="<?php echo base_url();?>category/delete/<?php echo $val['category_id']?>" class="btn btn-success btn-phone-block" onclick="return confirm('Are You Sure You Want to Delete This Category and its child category?');"><icon class="icon-pencil icon-white"></icon> Delete</a>
		<!-- 							<button class="btn btn-primary btn-phone-block"><icon class="icon-check icon-white"></icon> Activate</button> -->
								</td>
							</tr>
						<?php 
					endforeach;
					endif;
					 ?>
			</tbody>
		</table>
	</div>
</div>

	</div>
</dvi>
</div>