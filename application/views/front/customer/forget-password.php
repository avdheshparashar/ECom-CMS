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
        <h1 class="uppercase">Forgot password</h1>
    </div><!--garmin-banner end-->
    <div class="mrgn-top2 grey-bg clearfix">
<?php echo $this->load->view("front/element/flash.php"); ?>
        <div class="clearfix border-top mrgn-topbot7">
                    <span class="blue uppercase font18 mrgn-bot1">PLEASE WRITE YOUR E-MAIL ADDRESS WE WILL SEND RESET PASSWORD LINK.
</span>
            <div class="fl redeem-coupon">

                <form method="post" action="<?php echo base_url();?>front/customer/forget_password">
                    <div class="mrgn-bot3">
                        <input type="email" name="email" id="email" placeholder="EMAIL ADDRESS"class="login-feild uppercase" data-required="true" data-error-message="Please enter your email">
                    </div>
                    <div class="mrgn-bot3 clearfix">
                        <div class="fr"><input type="submit" value="SEND" class="yellow-btn uppercase login font-segoe"></button></div>
                    </div>
                </form>
            </div><!--redeem-coupon end-->

        </div><!--redeem-coupon end-->

    </div>
</div><!--wrapper grey-bg container end-->