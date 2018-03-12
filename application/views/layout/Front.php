<html>
    <head>
        <title>
            <?php if(empty($title)) {
                echo "A&amp;S Creations - Home";
            } else {
                echo $title;
            }
            ?>
        </title>
        <meta name="description" content="<?php echo $meta_description; ?>">
        <meta name="keywords" content="<?php echo $meta_keywords; ?>">
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
        <script type="text/javascript" src="<?php echo base_url(); ?>assests/front/js/jquery.autocomplete.js"></script>
        <script>
            $(document).ready(function(){
             $("#tag").autocomplete("http://www.sampleserver.org/ascreation/front/category/search", {
                    selectFirst: true
                });
            });
        </script>        
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
        <div class="wrapper clearfix">
            <div class="clearfix mrgn-topbot8">
            <div class="logo fl">
                <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assests/front/images/logo.png" alt="site logo" height="34px" width="274px"></a>
            </div><!--logo div end-->

            <?php echo $this->load->view('front/element/topmenu'); ?>     
                           
            <div class="fr">
                <form method="post" action="<?php echo base_url();?>front/category/search">
                    <div class="mr-rgt">
                        <input type="text" placeholder="Search entire store here" name="tag" id="tag" class="search">
                        <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div><!--search end-->
            </div>
        </div><!--main-nav end-->

        <?php echo $content; ?>

        <?php echo $this->load->view('front/element/footer'); ?>     

        <script src="<?php echo base_url(); ?>assests/front/js/jquery.quick.pagination.min.js" type="text/javascript"></script>         
        <script type="text/javascript">
            $('.category-pagination').quickPagination({
                pageSize:"3"
            });
        </script>
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
