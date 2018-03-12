	
	<div class="contentWrapper">			
		<div class="container-fluid">
		
		<!-- Breadcrumb -->
<div class="row-fluid hidden-phone">
	<div class="span12">
		<ul class="breadcrumb">
			<li class="active">You are here: <icon class="icon-home icon-blue-l"></icon></li>
			<li>Dashboard</li>
		</ul>
	</div>
</div>
<!-- End Breadcrumb -->

<!-- Heading  -->
<div class="row-fluid overview">
	<div class="span12">
		<h1>Dashboard</h1><br/>
	</div>
</div>
<!--  End Heading -->

<div class="row-fluid">

	<!-- Analytics -->
	<div class="span4">
         <div class="col-md-3">
            <div class="tile-stats tile-neon-red">
               	<div class="icon"><i class="entypo-chat"></i></div>
              	<div class="num" data-start="0" data-end="<?php echo $users; ?>" data-postfix="" data-duration="1400" data-delay="0"><?php echo $users; ?></div>
	            <h3>Registered Users</h3>
    	    </div>
        </div>
         <div class="col-md-3">
            <div class="tile-stats tile-neon-red">
                <div class="icon"><i class="entypo-chat"></i></div>
                <div class="num" data-start="0" data-end="124" data-postfix="" data-duration="1400" data-delay="0"><?php echo $brands; ?></div>
              <h3>Brands</h3>
          </div>
        </div>
	</div>
	<div class="span4">
         <div class="col-md-3">
            <div class="tile-stats tile-neon-red">
               	<div class="icon"><i class="entypo-chat"></i></div>
              	<div class="num" data-start="0" data-end="124" data-postfix="" data-duration="1400" data-delay="0"><?php echo $products; ?></div>
	            <h3>Products</h3>
            </div>
        </div>
         <div class="col-md-3">
            <div class="tile-stats tile-neon-red">
                <div class="icon"><i class="entypo-chat"></i></div>
                <div class="num" data-start="0" data-end="124" data-postfix="" data-duration="1400" data-delay="0">0</div>
              <h3>Orders</h3>
            </div>
        </div>
	</div>
	<div class="span4">
         <div class="col-md-3">
            <div class="tile-stats tile-neon-red">
               	<div class="icon"><i class="entypo-chat"></i></div>
              	<div class="num" data-start="0" data-end="124" data-postfix="" data-duration="1400" data-delay="0"><?php echo $categories; ?></div>
	            <h3>Categories</h3>
    	    </div>
        </div>
         <div class="col-md-3">
            <div class="tile-stats tile-neon-red">
               	<div class="icon"><i class="entypo-chat"></i></div>
              	<div class="num" data-start="0" data-end="124" data-postfix="" data-duration="1400" data-delay="0">0</div>
	            <h3>Total Sell</h3>
    	    </div>
        </div>
	</div>		
	<!-- END Analytics -->
</div>
</div>	<!-- End Content  -->

<style type="text/css">
  
  .tile-stats.tile-neon-red {
background: #00BFFF;
}
.tile-stats .icon {
color: rgba(0, 0, 0, 0.1);
position: absolute;
right: 5px;
bottom: 5px;
z-index: 1;
}

.tile-stats .icon i {
font-size: 100px;
line-height: 0;
margin: 0;
padding: 0;
vertical-align: bottom;
}
.tile-stats {
/* position: relative; */
display: block;
background: #303641;
padding: 20px;
margin-bottom: 10px;
overflow: hidden;
-webkit-border-radius: 5px;
-webkit-background-clip: padding-box;
-moz-border-radius: 5px;
-moz-background-clip: padding;
border-radius: 5px;
background-clip: padding-box;
-moz-transition: all 300ms ease-in-out;
-o-transition: all 300ms ease-in-out;
-webkit-transition: all 300ms ease-in-out;
transition: all 300ms ease-in-out;
}

</style>
