<div class="wrapper grey-bg container clearfix forgot-btm-pad">
    <div class="breadcrumb  font-segoe mrgn-bot1">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><i class="fa fa-chevron-right"></i></li>
            <li><a href="#">User Login</a></li>
        </ul>
    </div><!--breadcrumb end-->
    <div class="garmin-banner">
        <img src="<?php echo base_url();?>assests/front/images/login-banner.jpg" alt="banner image" height="192" width="1000">
        <h1 class="uppercase">Reset password</h1>
    </div><!--garmin-banner end-->
    <div class="mrgn-top2 grey-bg clearfix">
<?php echo $this->load->view("front/element/flash.php"); ?>
        <div class="clearfix border-top mrgn-topbot7">
                    <span class="blue uppercase font18 mrgn-bot1">PLEASE WRITE YOUR PASSWORD
</span>
            <div class="fl redeem-coupon">

                <form method="post" action="<?php echo base_url();?>front/customer/reset">
                    <input type="hidden" name="email" value="<?php echo $email; ?>" />
                    <input type="hidden" name="forgetlink" value="<?php echo $forgetlink;?>">
                    <div class="mrgn-bot3">
                        <input type="password" name="password" id="email" placeholder="Password"class="login-feild uppercase" data-required="true" data-error-message="Please enter your email">
                    </div>
                    <div class="mrgn-bot3 clearfix">
                        <div class="fr"><input type="submit" value="SEND" class="yellow-btn uppercase login font-segoe"></button></div>
                    </div>
                </form>
            </div><!--redeem-coupon end-->

        </div><!--redeem-coupon end-->

    </div>
</div><!--wrapper grey-bg container end-->