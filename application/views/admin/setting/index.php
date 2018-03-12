<div class="contentWrapper">			
		<div class="container-fluid">
		
		<!-- Breadcrumb -->
		<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li class="active">You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li><a href="dashboard.html?lang=en">Dashboard</a></li>
			<li class="active"><span class="divider"></span>System <span class="divider"></span>settings</li>
		</ul>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<h1>Settings</h1>
		<p class="lead">Manage settings</p>
		<hr />
	</div>
</div>
<div class="clearfix separator bottom"></div>
<!--  End Heading -->

<div class="row-fluid">

	<!--  Buttons -->
	<div class="clearfix"></div>
	<div class="separator"></div>
	<!-- End Buttons -->
</div>

<div class="row-fluid">
	<div class="span12">
		<form method="post" action="<?php echo base_url();?>setting/delete">
		<table class="table table-striped table-bordered table-responsive block">
			<thead>
				<tr>
					<th width="20"></th>
					<th width="20">No.</th>
					<th width="885">Setting Name</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i = 0;
					if( array_key_exists(0, $settings) ):
						foreach($settings[0]['data'] as $key=>$val) { ?>
						<tr>
							<td><input name="settingids[]" value="<?php echo $val['settings_id']; ?>" type="checkbox"></td>
							<td><?php echo ++$i; ?>.</td>
							<td><?php echo $val['setting_name']; ?></td>
							<td>
								<a href="<?php echo base_url();?>setting/edit/<?php echo $val['settings_id']; ?>" class="btn btn-success btn-phone-block"><icon class="icon-pencil icon-white"></icon> Edit</a>
	<!-- 							<a href="#details" class="btn btn-primary btn-phone-block" data-toggle="modal"><icon class="icon-plus-sign icon-white"></icon>Details</a> -->
							</td>
						</tr>
				<?php }
					endif;
				?>				
			</tbody>
			<tfoot>
				<tr><td colspan="8"><input type="submit" id="delete-me" value="Delete"  class="btn btn-danger"/></td></tr>	
			</tfoot>			
		</table>
		</form>
	</div>
</div>

			
<!--  Pagination -->
		<div class="pagination">
			<ul>
				<?php if($active == 1) { ?>
					<li class="disabled">
						<a href="#">Prev</a>
					</li>
				<?php } else { ?>
					<li>
						<a href="<?php echo base_url();?>setting?page=<?php echo $active-1;?>">Prev</a>
					</li>
				<?php } ?>
				<?php for($i=1;$i<=$settings[0]['count'];$i++) { 
						if($i ==(int) $active) {
				?>
					<li class="active hidden-phone">
				<?php } else { ?>
					<li class="hidden-phone">
				<?php } ?>		
						<a href="<?php echo base_url();?>setting?page=<?php echo $i;?>">
							<?php echo $i;?>
						</a>
					</li>
				<?php } ?>
				<?php if($settings[0]['count'] == $active) { ?>
					<li class ="disabled">
						<a href="#">Next &raquo;</a>
					</li>
				<?php } else { ?>
					<li>
						<a href="<?php echo base_url();?>setting?page=<?php echo $active+1;?>">Next &raquo;</a>
					</li>
				<?php } ?>		
			</ul>
		</div>
		<!-- End  Pagination -->
	</div>
</dvi>
</div>

	
	

