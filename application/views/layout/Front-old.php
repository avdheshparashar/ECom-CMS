<html>
    <head>
        <title>A&amp;S Creations - Home</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:700italic,400,700' rel='stylesheet' type='text/css'>
        <link href="<?php echo base_url(); ?>assests/front/css/jquery.bxslider.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assests/front/css/style.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assests/front/css/font-awesome.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assests/front/css/form.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assests/front/css/jquery.autocomplete.css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assests/front/js/parsley.js"></script>
        <script src="<?php echo base_url(); ?>assests/front/js/jquery.bxslider.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>assests/admin/custom/js/parsley.min.js"></script>
        <script src="<?php echo base_url(); ?>assests/front/js/uikit.min.js" type="text/javascript"></script>
        
    </head>
    <body class="home-page">
        <div class="top-menu">
            <div class="wrapper clearfix">
                <div class="top-menu-width fr">
                    <ul class="fl">
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Ask an expert</a></li>
                    </ul>
                    <ul class="fl">
                        <?php if($this->session->userdata('customer')) { ?>
                            <li class=""><a href="<?php echo base_url(); ?>myaccount/dashboard">My account</a></li>
                        <?php } else { ?>
                            <li class=""><a href="<?php echo base_url(); ?>myaccount">Login/Register</a></li>
                        <?php }?>
                        <li class="cart"><a href="<?php echo base_url();?>cart">My<i class="fa fa-shopping-cart"></i>
                                <span class="cart-item"><?php echo count($this->session->userdata('products')); ?></span></a></li>
                        <?php if($this->session->userdata('customer')) { ?>
                            <li><a href="<?php echo base_url(); ?>logout">Logout</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="wrapper clearfix pad-topbot1">
            <div class="logo fl">
                <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assests/front/images/logo.png" alt="site logo" height="34px" width="274px"></a>
            </div><!--logo div end-->
            <div class="logo-right fr font-segoe">
                <div class="free-shipping uppercase fl">
                    <div class="fl"><img src="<?php echo base_url(); ?>assests/front/images/shipping-img.jpg" alt="shipping image" height="34" width="51"></div>
                    <div>
                        <p class="blue bold pad-rgt">Free shipping</p>
                        <span class="small-font">Across india</span>
                    </div>
                </div><!--free-shipping div end-->
                <div class="best-qty uppercase fr">
                    <div class="fl"><img src="<?php echo base_url(); ?>assests/front/images/best-quality-img.png" alt="shipping image" height="34" width="32"></div>
                    <div class="fr">
                        <p class="blue bold">Best Quality</p>
                        <span class="small-font">guaranteed</span>
                    </div>
                </div><!--free-shipping div end-->
            </div><!--free-shipping end-->
        </div><!--wrapper end-->
        <div class="wrapper main-nav clearfix">
            <div class="nav-left fl">
                <?php echo menu($this->results); ?>
            </div>
            <div class="fr">
                <form method="post" action="<?php echo base_url();?>front/category/search">
                    <div class="mr-rgt">
                        <input type="text" placeholder="Search entire store here" name="tag" id="tag" class="search">
                        <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
                    </div>
               </form>
            </div><!--search end-->
        </div><!--main-nav end-->

        <?php echo $content; ?>

        <?php echo $this->load->view('front/element/footer'); ?>     
         
        <script src="<?php echo base_url(); ?>assests/front/js/menu.js" type="text/javascript"></script>
        <script>
              $('#slider1').bxSlider({
                auto: true,
                autoControls: true
            });
            </script>
        <script>
            $('#slider2').bxSlider({
                minSlides: 3,
                maxSlides: 3,
                slideWidth: 336
                
            });
        </script>
    </body>
</html>