<div class="contentWrapper">			
		<div class="container-fluid">
		
		<!-- Breadcrumb -->
		<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li>Dashboard</a></li>
			<li><span class="divider"></span>Sizes</li>
			<li><span class="divider"></span>Manage Sizes</li>
		</ul>
	</div>
</div>
<?php echo $this->load->view("admin/flash.php"); ?>
</div>
<div class="clearfix separator bottom"></div>
<!--  End Heading -->
<div class="row-fluid">	
	<div class="span6">
		<p class="lead">Manage Sizes</p>
	</div>
	<div class="span6" align="right">
		<p class="lead">Add Sizes</p>
	</div>
	
	<div class="clearfix"></div>
	<div class="separator"></div>
</div>
<div class="row-fluid">
	<div class="span6">
	<form method="post" action="<?php echo base_url();?>size/delete">
		<table class="table table-striped table-bordered table-responsive block" id="example">
			<thead>
				<tr>
					<th width="1%"><input type="checkbox" onchange="checkAll(this)" /></th>
					<th class="center"  width="100">Name</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i = 0;
					foreach($sizes[0]['data'] as $key=>$val) { ?>
					<tr>
						<td><input name="sizeids[]" value="<?php echo $val['size_id']; ?>" type="checkbox"></td>
						<td><?php echo $val['value']; ?></td>
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
		<form action="<?php echo base_url();?>size/save" method="post" >
		<div class="form-horizontal well">
			<div class="control-group">
				<label class="control-label" for="inputEmail">Size Name</label>
				<div class="controls">
					<input type="text" id="" class="input-block" placeholder="Size" name="value" data-parsley-required="true">
				</div>
			</div>
		</div>
		<button type="submit" class="btn btn-success pull-right">Save Size <icon class="icon-check icon-white-t"></icon></button>
		</form>
	</div>
</div>
	<!-- Categories Table -->


	
	</div>
</dvi>
</div>

	
	


