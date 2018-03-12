<?php 
	if ($this->session->flashdata('feedback')) { 
       $flashdata = $this->session->flashdata('feedback'); ?>
			<div class="uk-alert <?php echo $flashdata['class'];?>-msg font16" data-uk-alert>
			    <a href="" class="uk-alert-close uk-close"></a>
				<p><?php echo $flashdata['message']; ?></p>
			</div>
   	<?php }
?>