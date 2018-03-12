<div class="wrapper grey-bg container clearfix forgot-btm-pad">
    <div class="breadcrumb  font-segoe mrgn-bot1">
        <ul>
            <li><a href="">Home</a></li>
            <li><i class="fa fa-chevron-right"></i></li>
            <li><a href="#">Dashboard</a></li>

        </ul>
    </div><!--breadcrumb end-->
    <div class="garmin-banner">
        <img src="<?php echo base_url(); ?>assests/front/images/dashboard-banner.jpg" alt="banner image" height="192" width="1000">
        <h1 class="uppercase">Dashboard</h1>
    </div><!--garmin-banner end-->
    <div class="mrgn-top2">
    <?php echo $this->load->view("front/element/flash.php"); ?>
        <?php echo $this->load->view('front/element/customer_sidebar'); ?>
        <div class="right-bar fl no-border">
            <div>
                        <span class="blue uppercase font18 mrgn-bot1">Welcome!</span>

            </div>
        </div><!--right-bar end-->

    </div>
</div><!--wrapper grey-bg container end-->