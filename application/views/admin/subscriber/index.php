<div class="contentWrapper">			
		<div class="container-fluid">
		
		<!-- Breadcrumb -->
		<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li>Dashboard</a></li>
			<li><span class="divider"></span>Subscribers</li>
			<li><span class="divider"></span>Manage Subscribers</li>
		</ul>
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
                <div class="span6">
                    <p class="lead">Manage Subscribers</p>
                </div>
                <div class="span6"  align="right">
                    <a href="<?php echo base_url();?>subscriber/export" class="btn btn-primary"><icon class="icon-plus-sign icon-white"></icon> Export Subscribers</a>
                </div>
                <div class="clearfix"></div>
                <div class="separator"></div>
            </div>
<div class="row-fluid">
	<div class="span12">

		<table class="table table-striped table-bordered table-responsive block" id="example">
			<thead>
				<tr>
					<th width="20">No.</th>
					<th width="600">Email</th>
					<th width="80"> Created</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i = 0;
					foreach($subscribers[0]['data'] as $key=>$val) { ?>
					<tr>
						<td><?php echo ++$i; ?>.</td>
						<td><?php echo $val['email']; ?></td>
						<td><span class="label"><?php echo $val['created']; ?></span></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
	<!-- Categories Table -->
	</div>
</dvi>
</div>

	
	

