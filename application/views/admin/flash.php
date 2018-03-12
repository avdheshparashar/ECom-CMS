<?php 
	if ($this->session->flashdata('feedback')) {
       $flashdata = $this->session->flashdata('feedback');
       echo '<div class="alert ' . $flashdata['class'] . ' fade in"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' . $flashdata['message'] . '</div>';
   	}
?>