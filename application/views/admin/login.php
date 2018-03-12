<!DOCTYPE html>
<html>
<head>
	<title>AS Creation - E-Commerce Admin Area</title>
	
	<!-- Bootstrap -->
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="http://104.236.210.247/buglecms/assests/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="http://104.236.210.247/buglecms/assests/admin/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	
	<!-- Bootstrap Extended -->
	<link href="http://104.236.210.247/buglecms/assests/admin/bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
	<link href="http://104.236.210.247/buglecms/assests/admin/bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap-responsive.min.css" rel="stylesheet">
	<!-- wysihtml5 -->
	<link href="http://104.236.210.247/buglecms/assests/admin/bootstrap/extend/bootstrap-wysihtml5/css/bootstrap-wysihtml5-0.0.2.css" rel="stylesheet">
	
	
	<!-- Theme :: Beauty Admin  -->
	<link href="http://104.236.210.247/buglecms/assests/admin/theme/css/beautyadmin.css?1359456143" rel="stylesheet">
	
	<!--  Google Open Sans Font -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	
	<!-- Jquery Latest -->
	<script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
	
	<!-- Glyphicons -->
	<link rel="stylesheet" href="theme/css/glyphicons.css" />
	
</head>
<body class="login top-menu sticky_footer">

	<!--  Header -->
	
	<!-- Top Gray Line -->
	<div class="navbar navbar-fixed-top top-line">
		<div class="container-fluid">
			<!-- Logo -->
			<div class="pull-left">
				<a href="<?php echo base_url();?>" class="brand">AS<strong>Creation</strong><span class="label label-inverse"></span></a>
			</div>
			<!-- End Logo -->

		</div>
	</div>
	<!-- End Top Gray Line -->

		
	<!-- End Header -->

	<!-- Start Content -->
				<div class="container-fluid">
		
		<!-- Login Box -->
	<div align="center">
		<p><img src="<?php echo base_url();?>/assests/images/logo.png" class="img-rounded" /></p>
		
	</div>
<form action="<?php echo site_url('login/loginme'); ?>" class="well login-form" id="form" method="post">
	<legend>
		<icon class="icon-circles"></icon>Restricted Area<icon class="icon-circles-reverse"></icon>
	</legend>
	<div class="control-group">
		<label class="control-label" for="inputPassword">Username</label>
		<div class="controls">
			<div class="input-prepend">
				<span class="add-on"><icon class="icon-user icon-cream"></icon> </span>
				<input class="input" type="text" id="username" placeholder="Username" name="email"/>
			</div>
		</div>
	</div>
	<div class="control-group">
		<label class="control-label" for="inputPassword">Password</label>
		<div class="controls">
			<div class="input-prepend">
				<span class="add-on"><icon class="icon-password icon-cream"></icon>
				</span> <input class="input" type="password" id="password" value="" placeholder="Password" name="password"/>
			</div>
		</div>
	</div>
	<div class="control-group signin">
		<div class="controls ">
			<button type="submit" class="btn btn-block" id="" >Login</button>

		</div>
	</div>
</form>
<!--  End Login Box-->
	
		
	</div>
		<!-- End Content  -->

	<!-- Footer Login  -->

	<!--  End Footer Login -->
	

	<!-- Bootstrap JS -->
	<script src="http://104.236.210.247/buglecms/assests/admin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	
	<!-- Resize Script -->
	<script src="http://104.236.210.247/buglecms/assests/admin/theme/scripts/jquery.ba-resize.js"></script>
	
	<!-- Cookies -->
	<script src="http://104.236.210.247/buglecms/assests/admin/theme/scripts/jquery.cookie.js"></script>
	
	<!-- Bootstrap Extended -->
	<!-- jasny plugins -->
	<script src="http://104.236.210.247/buglecms/assests/admin/bootstrap/extend/jasny-bootstrap/js/jasny-bootstrap.min.js" type="text/javascript"></script>
	<script src="http://104.236.210.247/buglecms/assests/admin/bootstrap/extend/jasny-bootstrap/js/bootstrap-fileupload.js" type="text/javascript"></script>
	<!-- bootbox -->
	<script src="http://104.236.210.247/buglecms/assests/admin/bootstrap/extend/bootbox.js" type="text/javascript"></script>
	<!-- wysihtml5 -->
	<script src="http://104.236.210.247/buglecms/assests/admin/bootstrap/extend/bootstrap-wysihtml5/js/wysihtml5-0.3.0_rc2.min.js" type="text/javascript"></script>
	<script src="http://104.236.210.247/buglecms/assests/admin/bootstrap/extend/bootstrap-wysihtml5/js/bootstrap-wysihtml5-0.0.2.min.js" type="text/javascript"></script>
	
	<!-- General script -->
	<script src="http://104.236.210.247/buglecms/assests/admin/theme/scripts/load.js?1359456143"></script>
	
	
</body>
</html>
