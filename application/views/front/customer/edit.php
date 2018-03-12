<div class="wrapper grey-bg container clearfix forgot-btm-pad">
    <div class="breadcrumb  font-segoe mrgn-bot1">
        <ul>
            <li><a href="">Home</a></li>
            <li><i class="fa fa-chevron-right"></i></li>
            <li><a href="#">Edit Profile</a></li>

        </ul>
    </div><!--breadcrumb end-->
    <div class="garmin-banner">
        <img src="<?php echo base_url(); ?>assests/front/images/dashboard-banner.jpg" alt="banner image" height="192" width="1000">
        <h1 class="uppercase">Edit Profile</h1>
    </div><!--garmin-banner end-->
    <div class="mrgn-top2">
    <?php echo $this->load->view("front/element/flash.php"); ?>
        <?php echo $this->load->view('front/element/customer_sidebar'); ?>

        <div class="right-bar fl no-border">
            <div>
                        <span class="blue uppercase font18 mrgn-bot1">Edit profile
</span>
                <form action="<?php echo base_url();?>front/customer/edit" method="post" data-validate="parsley">
                    <div class="pad-right1">
                        <input type="hidden" value="<?php echo $customer[0]['data'][0]['customer_id'];?>" name="customer_id">
                        <div class="mrgn-bot1 clearfix">
                            <div class="fl"><input type="text" name="fname" id="fullnm" placeholder="Fist Name"
                                   class="uppercase login-feild" data-parsley-required="true" value="<?php echo $customer[0]['data'][0]['fname'];?>"
                                   data-parsley-error-message="Please enter your first name"></div>
                            <div class="fr"><input type="text" name="lname" id="mobnm" placeholder="Last Name"
                                   class="uppercase login-feild fr" value="<?php echo $customer[0]['data'][0]['lname'];?>"
                                   data-parsley-required="true" data-parsley-error-message="Please enter your last name"></div>
                        </div>
                        <div class="mrgn-bot1 clearfix">
                            <div class="fl"><input type="text" name="mobilenumber" id="reset-pswd" placeholder="Mobile Numer"
                                  class="uppercase login-feild" value="<?php echo $customer[0]['data'][0]['mobilenumber'];?>"
                                  data-parsley-required="true" data-parsley-error-message="Please enter your mobilenumber"></div>
                        </div>
                        <div>
                            <input type="submit" value="UPDATE" class="yellow-btn fr">
                        </div>
                    </div>
                </form>
            </div>
        </div><!--right-bar end-->

    </div>
</div><!--wrapper grey-bg container end-->