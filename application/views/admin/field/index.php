<div class="contentWrapper">			
		<div class="container-fluid">
		
		<!-- Breadcrumb -->
<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li>Dashboard</a></li>
			<li><span class="divider"></span>Attributes</li>
			<li><span class="divider"></span>Manage Attributes</li>
		</ul>
	</div>
</div>
		
<div class="clearfix separator bottom"></div>
<!--  End Heading -->

<div class="row-fluid">
	<div class="span6">
		<p class="lead">Manage Attributes</p>
	</div>
	<div class="span6"  align="right">
		<a href="<?php echo base_url();?>field/add" class="btn btn-primary"><icon class="icon-plus-sign icon-white"></icon> Add Attribute</a>
		<a href="<?php echo base_url();?>field/export" class="btn btn-primary"><icon class="icon-plus-sign icon-white"></icon> Export Attribute</a>		
	</div>
	<div class="clearfix"></div>
	<div class="separator"></div>
</div>
<?php echo $this->load->view("admin/flash.php"); ?>
<div class="row-fluid">
	<div class="span12">
	<form method="post" action="<?php echo base_url();?>field/cancel">
		<table class="table table-striped table-bordered table-responsive block " id="example">
			<thead>
				<tr>
					<th class="center"  width="2%"><input type="checkbox" onchange="checkAll(this)" /></th>
					<th class="center"  width="28%">Name</th>
					<th class="center"  width="50%">Value</th>
					<th  class="center" width="9%">Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i = 0;
					if( array_key_exists(0, $fields) ):
						foreach($fields[0]['data'] as $key=>$val) { ?>
						<tr>
							<td><input name="fieldids[]" value="<?php echo $val['field_id']; ?>" type="checkbox"></td>
							<td><?php echo $val['name']; ?></td>
							<td>
								<?php 
									$attrs = explode(",",$val['content']);
									foreach ($attrs as $key => $value) {
										echo "<span class='label label-info'>".$value."</span> ";
									}  ?>
							</td>
							<td id="pop">
								<a href="<?php echo base_url();?>field/edit/<?php echo $val['field_id']?>" class="btn btn-success btn-phone-block"><icon class="icon-pencil icon-white"></icon> Edit</a>
								</a>
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

	
	


