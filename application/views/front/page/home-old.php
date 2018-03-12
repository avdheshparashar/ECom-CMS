<?php echo $this->load->view("front/element/flash.php"); ?>
<div class="home-slider wrapper">
            <ul id="slider1">
            <?php foreach ($data['slideshows'] as $key=>$value) { ?>
                <li><img src="<?php echo base_url(); ?>assests/images/slideshows/<?php echo $value['image_name']; ?>">
                <?php
                    if($value['link']!='0') { ?>
                    <div class="banner-text">
                       <a href="<?php echo $value['link'];?>" class="yellow-btn uppercase">shop now<i class="fa fa-angle-right"></i></a>
                    </div>
                    <?php } ?>
                </li>
            <?php } ?>
            </ul>
        </div><!--home-slider end-->
        <?php if(!empty($data['products'])) { ?>
        <div class="wrapper grey-bg container clearfix mrgn-bot4 pad-bot1">
            <h6 class="blue uppercase font18 center mrgn-topbot5">featured products</h6>
            <div class="three-box-main border clearfix white-bg">
            <div id="slider2" class="home-sec-slider">
            <?php foreach ($data['products'] as $key=>$value) { ?>
                <?php echo $value; ?>
                <div class="home-box fl">
                    <a href="<?php echo base_url();?>product/<?php echo $value['slug'];?>">
                    <div>
                        <span><img src="<?php echo base_url(); ?>assests/uploads/images/home/<?php echo $value['main_image'];?>" alt="salomon product" height="357" width="332"></span>
                    </div><!--home-box end-->
                    </a>
                    <a href="<?php echo base_url();?>product/<?php echo $value['slug'];?>";?><p class="prod-nm uppercase font18 center"><?php echo $value['name']; ?> </p></a>
                    <p class="prod-nm uppercase font16 center blue p-mrgn"><?php echo $value['category_name']; ?></p>
                    <p class="price center">
                        <?php
                            if($value['discount_price']!=0) {
                                echo "<strike><i class='fa fa-inr'></i>".number_format($value['discount_price'])."</strike> ";
                            }
                            echo "<i class='fa fa-inr'></i>".number_format($value['price']); ?>
                    </p>
                </div><!--home box end-->
            <?php } ?>
            </div>
                </div>
        </div><!--wrapper end-->
        <?php } ?>
        <div class="need-help wrapper clearfix">
            <div class="need-help-inner font-segoe clearfix">
                <span class="uppercase white">Ask an <strong class="bold">expert</strong></span>
                <div class="white font16 line-height">Need help choosing a best gear that suits your need? <br>
                    Let our Experts help you with valuable suggestions & recommendation.</div>
                <div class="btn-reltv"><a href="#" class="yellow-btn uppercase fr">send your question</a></div>
            </div><!--need-help-inner end-->
            <div class="brand-logo center clearfix">
                <img src="<?php echo base_url(); ?>assests/front/images/brand-top.png" alt="brand top image" width="240" height="15" class="mrgn-topbot6">
                <h6 class="blue uppercase font18 center mrgn-topbot5 no-mrgn-top">featured products</h6>
                <ul class="">
                    <li><a href="#"><img src="<?php echo base_url(); ?>assests/front/images/suunto-logo.png" alt="suunto logo"></a></li>
                    <li><a href="#"><img src="<?php echo base_url(); ?>assests/front/images/salomon-logo.png" alt="salmon logo"></a></li>
                    <li><a href="#"><img src="<?php echo base_url(); ?>assests/front/images/hawke-logo.jpg" alt="hawke logo"></a></li>
                    <li><a href="#"><img src="<?php echo base_url(); ?>assests/front/images/garmin-logo.jpg" alt="garmin logo"></a></li>
                    <li><a href="#"><img src="<?php echo base_url(); ?>assests/front/images/cuddeback-logo.jpg" alt="cuddeback logo"></a></li>
                    <li><a href="#"><img src="<?php echo base_url(); ?>assests/front/images/holux-logo.jpg" alt="holux logo"></a></li>
                    <li><a href="#"><img src="<?php echo base_url(); ?>assests/front/images/marmot-logo.jpg" alt="marmot logo"></a></li>
                    <li><a href="#"><img src="<?php echo base_url(); ?>assests/front/images/reconyx-logo.jpg" alt="reconyx logo"></a></li>
                    <li><a href="#"><img src="<?php echo base_url(); ?>assests/front/images/sontek-logo.jpg" alt="sontek logo"></a></li>
                    <li><a href="#"><img src="<?php echo base_url(); ?>assests/front/images/regatta-logo.jpg" alt="regatta logo"></a></li>
                    <li><a href="#"><img src="<?php echo base_url(); ?>assests/front/images/estwing-logo.jpg" alt="estwing logo"></a></li>
                    <li><a href="#"><img src="<?php echo base_url(); ?>assests/front/images/koizumi-logo.jpg" alt="koizumi logo"></a></li>
                            
                </ul>
            </div><!--brand-logo end-->
        </div><!--need-help end-->
        