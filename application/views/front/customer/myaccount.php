<div class="wrapper grey-bg container clearfix login-btm-pad">
    <div class="breadcrumb  font-segoe mrgn-bot1">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><i class="fa fa-chevron-right"></i></li>
            <li><a href="#">User Login</a></li>
        </ul>
    </div><!--breadcrumb end-->
    <div class="garmin-banner">
        <img src="<?php echo base_url(); ?>assests/front/images/login-banner.jpg" alt="banner image" height="192" width="1000">
        <h1 class="uppercase">login / register</h1>
    </div><!--garmin-banner end-->
    <div class="mrgn-top2 grey-bg clearfix">
        <?php echo $this->load->view("front/element/flash.php"); ?>
        <div class="clearfix border-top mrgn-topbot7">

            <div class="fl redeem-coupon">
                <span class="blue uppercase font18 mrgn-bot1">Please login to your account</span>
                <form action="<?php echo base_url();?>front/customer/login" method="post" data-parsley-trigger="change"
                      data-parsley-ui-enabled="true" data-parsley-validate>
                    <div class="mrgn-bot3">
                        <input type="email" name="email" id="email" placeholder="EMAIL ADDRESS"class="login-feild uppercase"
                               data-parsley-required="true"
                               data-parsley-error-message="Please enter your email">
                    </div>
                    <div class="mrgn-bot3">
                        <input type="password" name="password" id="password" placeholder="PASSWORD"
                               class="login-feild uppercase" data-parsley-required="true"
                               data-parsley-error-message="Please enter your password">
                    </div>
                    <div class="mrgn-bot3 clearfix">
                        <div class=""><a href="<?php echo base_url();?>forget-password" class="underline black font13 fl fgt-pw">Forgot Your Password?</a></div>
                        <div class="fr"><input type="submit" value="login" class="yellow-btn uppercase login font-segoe"></button></div>
                    </div>
                </form>
            </div><!--redeem-coupon end-->
            <div class="cart-total fl">
                <span class="blue uppercase font18 mrgn-bot1 block">Don't HAVE ACCOUNT YET, PLEASE REGISTER</span>
                <div class="">
                    <form action="<?php echo base_url();?>front/customer/register" method="post" data-parsley-trigger="change"
                          data-parsley-ui-enabled="true" data-parsley-validate>
                        <div class="mrgn-bot3">
                            <input type="text" name="fname" id="fname" placeholder="FIRST NAME"class="login-feild uppercase"
                                   data-parsley-required="true" data-parsley-error-message="Please enter your first name">
                        </div>
                        <div class="mrgn-bot3">
                            <input type="text" name="lname" id="fname" placeholder="LAST NAME"class="login-feild uppercase"
                                   data-parsley-required="true" data-parsley-error-message="Please enter your last name">
                        </div>
                        <div class="mrgn-bot3">
                            <input type="email" name="email" id="email" placeholder="EMAIL ADDRESS"
                                   class="login-feild uppercase"
                                   data-parsley-required="true" data-parsley-error-message="Please enter your email">
                        </div>
                        <div class="mrgn-bot3">
                            <input type="number" name="mobilenumber" id="number" placeholder="MOBILE NUMBER"
                                   class="login-feild uppercase" data-parsley-required="true"
                                   data-parsley-error-message="Please enter mobile number">
                        </div>
                        <div class="mrgn-bot3">
                            <input type="password" name="password" id="passcheck" placeholder="PASSWORD" data-parsley-equalto="#passcheck"
                                   class="login-feild uppercase" data-parsley-required="true" data-parsley-error-message="Please enter your password">
                        </div>
                        <div class="mrgn-bot3">
                            <input type="password" name="conf-password" id="passcheck1" placeholder="CONFIRM PASSWORD"
                                   class="login-feild uppercase" data-parsley-required="true" data-parsley-equalto="#passcheck"
                                   data-parsley-error-message="Your password does not match">
                        </div>
                        <div class="mrgn-bot3 clearfix">
                            <div class="fr"><input type="submit" value="register" class="yellow-btn uppercase font-segoe regiser"></div>
                        </div>
                    </form>
                </div>

            </div><!--cart-total end-->
        </div><!--redeem-coupon end-->

    </div>
</div><!--wrapper grey-bg container end-->