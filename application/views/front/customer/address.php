<div class="wrapper grey-bg container clearfix forgot-btm-pad">
    <div class="breadcrumb  font-segoe mrgn-bot1">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><i class="fa fa-chevron-right"></i></li>
            <li>My Account</li>
        </ul>
    </div><!--breadcrumb end-->
    <div class="garmin-banner">
        <img src="<?php echo base_url();?>assests/front/images/dashboard-banner.jpg" alt="banner image" height="192" width="1000">
        <h1 class="uppercase">My account</h1>
    </div><!--garmin-banner end-->
    <div class="mrgn-top2">
    <?php echo $this->load->view("front/element/flash.php"); ?>
        <?php echo $this->load->view('front/element/customer_sidebar'); ?>
        <div class="right-bar fl no-border">
            <div>
                <span class="blue uppercase font18 mrgn-bot1 font-segoe">Add / edit address</span>
                <form action="<?php echo base_url();?>front/customer/address" method="post" class="black" data-validate="parsley">
                    <?php if($editaddress) { ?>
                        <input type="hidden" value="<?php echo $editaddress[0]['shipping_id'];?>" name="shipping_id">
                    <?php } ?>
                    <input type="hidden" value="<?php echo (int) $this->session->userdata("customer")['customer_id'];?>" name="customer_id">
                    <div class="pad-right1">
                        <div class="mrgn-bot5 clearfix">
                            <div class="fl">
                                <div class="uppercase black font13 mrgn-bot2">Address 01</div>
                                <input type="text" name="address1" id="address1" class="uppercase login-feild" value="<?php echo $editaddress[0]['address1'];?>"
                                       data-required="true" data-error-message="Please enter address01">
                            </div>
                            <div class="fr">
                                <div class="uppercase black font13 mrgn-bot2">Address 02</div>
                                <input type="text" name="address2" id="address2" number class="uppercase login-feild fr" value="<?php echo $editaddress[0]['address2'];?>"
                                       data-required="true" data-error-message="Please enter address02">
                            </div>
                        </div>
                        <div class="mrgn-bot5 clearfix">
                            <div class="fl">
                                <div class="uppercase black font13 mrgn-bot2">City</div>
                                <input type="text" name="city" id="city" class="uppercase login-feild" value="<?php echo $editaddress[0]['city'];?>"
                                       data-required="true" data-error-message="Please enter your city">
                            </div>
                            <div class="fr">
                                <div class="uppercase black font13 mrgn-bot2">pin code</div>
                                <input type="number" name="zipcode" id="pincode"  class="uppercase login-feild fr" value="<?php echo $editaddress[0]['zipcode'];?>"
                                       data-required="true" data-error-message="Please enter your pincode">
                            </div>
                        </div>
                        <div class="mrgn-bot5 clearfix">
                            <div class="fl">
                                <div class="uppercase black font13 mrgn-bot2">State</div>
                                <select name="state" id="state" class="uppercase login-feild"
                                        data-required="true" data-error-message="Please enter your state">
                                    <option value="<?php echo $editaddress[0]['state'];?>" selected><?php echo $editaddress[0]['state'];?></option>
                                    <option value="Guajrat">Gujarat</option>
                                    <option value="Maharashtra">Maharashtra</option>
                                </select>
                            </div>
                            <div class="fr">
                                <div class="uppercase black font13 mrgn-bot2">Country</div>
                                <select name="country" id="country" class="uppercase login-feild" data-required="true" data-error-message="Please enter your country">
                                    <option value="<?php echo $editaddress[0]['country'];?>" selected><?php echo $editaddress[0]['country'];?></option>
                                    <option value="India">India</option>
                                    <option value="U.S.">U.s.</option>
                                </select>
                            </div>
                        </div>
                        <div class="mrgn-bot5 clearfix">
                            <input type="submit" class="yellow-btn uppercase fr" value="add">
                        </div>
                    </div><!--padd-right1 end-->
                </form>
            </div>
            <div class="border-top clearfix">
            <?php
                foreach($addresses as $address) { ?>
                <div class="line-height font16 fl width5">
                    <div><?php echo $address['address1'];?></div>
                    <div><?php echo $address['address2'];?></div>
                    <div><?php echo $address['city']." ".$address['zipcode'];?></div>
                    <div><?php echo $address['state'].",".$address['country'];?></div>
                    <div><a href="<?php echo base_url();?>front/customer/address/<?php echo $address['shipping_id'];?>" class="yellow-btn fc">Edit</a></div>
                </div>
            <?php } ?>
            </div>
        </div><!--right-bar end-->

    </div>
</div><!--wrapper grey-bg container end-->