<footer>
    <div class="wrapper clearfix">
        <div class="fl pad-right">
            <h4 class="uppercase yellow font16 mrgn-bot2">My account</h4>
            <ul class="">
                <li>
                    <?php if($this->session->userdata('customer')) { ?>
                        <a href="<?php echo base_url();?>myaccount/dashboard">My Dashboard</a>
                    <?php } else { ?>
                        <a href="<?php echo base_url();?>myaccount/">My Dashboard</a>
                    <?php } ?>
                </li>
                <li>
                    <?php if($this->session->userdata('customer')) { ?>
                        <a href="#">My Favourite</a>
                    <?php } else { ?>
                        <a href="<?php echo base_url();?>myaccount">My Favourite</a>
                    <?php } ?>
                </li>
                <li>
                    <?php if($this->session->userdata('customer')) { ?>
                        <a href="<?php echo base_url();?>cart/">My Shopping Cart</a>
                    <?php } else { ?>
                        <a href="<?php echo base_url();?>myaccount">My Shopping Cart</a>
                    <?php } ?>
                </li>
                <li>
                    <?php if($this->session->userdata('customer')) { ?>
                        <a href="<?php echo base_url();?>myaccount/myorder">My Orders</a>
                    <?php } else { ?>
                        <a href="<?php echo base_url();?>myaccount">My Orders</a>
                    <?php } ?>
                </li>
            </ul>
        </div>
        <div class="fl pad-right border-right">
            <h4 class="uppercase yellow font16 mrgn-bot2">COMPANY</h4>
            <ul class="">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Contact Details</a></li>
                <li><a href="<?php echo base_url();?>news">In the Press</a></li>
                <li><a href="#">Business Enquiry</a></li>
            </ul>
        </div>
        <div class="fl pad-right">
            <h4 class="uppercase yellow font16 mrgn-bot2">Customer SERVICE</h4>
            <ul class="border-btm ftr-mrgn">
                <li><a href="#">Shipping & Return Policy</a></li>
            </ul>
            <ul>
                <li>Have a questions? please call us on -</li>
                <li class="font19">+91 11 45789911-18 (8 Lines)</li>
            </ul>
        </div>
        <div class="fl">
            <h4 class="uppercase yellow font16 mrgn-bot2">NEVER MISS AN OPPORTUNITY!</h4>
            <ul class="">
                <li>Be the first to hear about exciting offers & deals. </li>
                <li>Just 8.51 seconds to subscribe our newsletter.</li>
            </ul>
            <div>
                <form method="post" action="<?php echo base_url();?>front/home/subscribeme">
                    <div class="email-main">
                        <i class="fa fa-envelope"></i>
                        <input type="email" name="email" id="email" placeholder="Your email address" class="email-adrs font14">
                        <button type="submit" class="email-btn"><img src="<?php echo base_url(); ?>assests/front/images/email-btn.png"></button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div><!--wrapper end-->
</footer>
<div class="botm-ftr">
    <div class="wrapper clearfix">
        <ul class="fl width33 mrgn-top4">
            <li><a href="#">Terms of use</a></li>
            <li><a href="#">Disclaimer</a></li>
        </ul>
        <div class="fl width33 center"><a href="<?php echo base_url();?>"><img src="<?php echo base_url(); ?>assests/front/images/footer-logo.png" alt="footer lofo" height="22" width="182" class="center"></a></div>
        <div class="fr width33 right mrgn-top4">Website redesigned by <a href="http://centronicssupport.in/" target="_blank">Centronics</a></div>
    </div>
    <div class="center copy-right">&copy; 2015 A&amp;S Creations</div>
</div><!--botm-ftr end-->