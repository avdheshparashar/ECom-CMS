<div class="contentWrapper">			
		<div class="container-fluid">
		
		<!-- Breadcrumb -->
<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li>Dashboard</a></li>
			<li><span class="divider"></span>Publications</li>
			<li><span class="divider"></span>Manage Publications</li>
		</ul>
	</div>
</div>
		
<div class="clearfix separator bottom"></div>
<!--  End Heading -->

<div class="row-fluid">
	<div class="span6">
		<p class="lead">Manage Publications</p>
	</div>
	<div class="span6"  align="right">
		<a href="<?php echo base_url();?>publication/add" class="btn btn-primary"><icon class="icon-plus-sign icon-white"></icon> Add Publication</a>
	</div>
	<div class="clearfix"></div>
	<div class="separator"></div>
</div>
<?php echo $this->load->view("admin/flash.php"); ?>
<div class="row-fluid">
	<div class="span12">
	<form method="post" action="<?php echo base_url();?>publication/cancel">
		<table class="table table-striped table-bordered table-responsive block" id="example">
			<thead>
				<tr>
					<th class="center"  width="2%"><input type="checkbox" onchange="checkAll(this)" /></th>
					<th class="center" width="1%">No.</th>	
					<th class="center" width="10%">Main Image</th>
					<th class="center" width="15%">Title</th>	
					<th class="center" width="15%">Link</th>
					<th class="center" width="4%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$i = 0;
					if( array_key_exists(0, $publications) ):
						foreach($publications[0]['data'] as $key=>$val) { ?>
						<tr>
							<td><input name="publicationids[]" value="<?php echo $val['publication_id']; ?>" type="checkbox"></td>
							<td><?php echo ++$i;?></td>
							<td>
								<img height="50px" width="50px" src="<?php echo base_url();?>assests/images/publications/<?php echo $val['main_image']; ?>" />
							</td>
							<td><?php echo $val['title']; ?></td>						
							<td><a href="<?php echo $val['link']; ?>"><?php echo $val['link']; ?></a></td>
							<td>
								<a href="<?php echo base_url();?>publication/edit/<?php echo $val['publication_id']?>" class="btn btn-success btn-phone-block"><icon class="icon-pencil icon-white"></icon> Edit</a>
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

	
	</div>
</dvi>
</div>

	
	


