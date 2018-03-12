<link href="<?php echo base_url().'assests/front/css/jquery.fancybox.css'?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url().'assests/front/css/tab.css'?>" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url().'assests/front/js/jquery.fancybox.js'; ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assests/front/js/jquery.fancybox.pack.js'; ?>"></script>

<div class="wrapper grey-bg container clearfix pad-bot1">
    <div class="breadcrumb  font-segoe mrgn-bot1">
        <ul>
            <li><a href="index.php">Home</a></li>

            <?php foreach($product['bredcrum'] as $category): ?>

                <li><i class="fa fa-chevron-right"></i></li>
                <li><a href="#"><?php echo $category['name']; ?></a></li>

            <?php endforeach; ?>
            <li><i class="fa fa-chevron-right"></i></li>
            <li><?php echo $product['brand']; ?></li>
        </ul>
    </div><!--breadcrumb end-->

    <div class="mrgn-top2 clearfix">
        <div class="fl slider">
            <!-- <ul class="bxslider">
                <?php $product['other_image'] = $product['main_image'] .','.$product['other_image']; ?>
                <?php if( $product['other_image'] != "" ): ?>
                    <?php $images = explode(',', $product['other_image']); ?>
                    <?php foreach($images as $image ): ?>

                        <li><a class="big_picture fancybox" href="<?php echo base_url().'assests/uploads/images/'.$image; ?>" data-fancybox-group="gallery" title="">
                                <img src="<?php echo base_url().'assests/uploads/images/'.$image; ?>" />
                            </a>
                        </li>


                    <?php endforeach; ?>
                <?php endif; ?>

            </ul>
            <div id="bx-pager">
                <?php if( $product['other_image'] != "" ): ?>
                    <?php foreach($images as $key => $image ): ?>

                        <a data-slide-index="<?php echo $key;?>" href=""><img src="<?php echo base_url().'assests/uploads/images/'.$image; ?>" /></a>

                    <?php endforeach; ?>
                <?php endif; ?>
              
            </div> -->

            <ul class="bxslider">
                <li><a class="big_picture fancybox" href="<?php echo base_url().'assests/';?>images/product-img/pro-img-1.jpg" data-fancybox-group="gallery" title=""><img src="<?php echo base_url().'assests/';?>images/product-img/pro-img-1.jpg" /></a></li>
                <li><a class="big_picture fancybox" href="<?php echo base_url().'assests/';?>images/product-img/pro-img-2.jpg" data-fancybox-group="gallery" title=""><img src="<?php echo base_url().'assests/';?>images/product-img/pro-img-2.jpg" /></a></li>
                
            </ul>
            <div id="bx-pager">
              <a data-slide-index="0" href=""><img src="<?php echo base_url().'assests/';?>images/product-img/pro-img-1.jpg" /></a>
              <a data-slide-index="1" href=""><img src="<?php echo base_url().'assests/';?>images/product-img/pro-img-2.jpg" /></a>
              
            </div>

        </div><!--width end-->
        <div class="fl product-detail">
            <h2 class="orange"><?php echo $product['name']; ?></h2>
            <ul class="pro-code mrgn-topbot1">
                <li class="no-mrgn-left"><?php echo $product['reference_number']; ?></li>
                <li>|</li>
                <li><?php echo $product['brand']; ?></li>
            </ul>
            <p class="font14 line-height black"><?php echo $product['short_description']; ?></p>
            <p class="font30 black bold font-segoe pad-topbot4">
                
                <?php 
                    $discount_price = 0;
                    $price = $product['price'];
                ?>

                <?php if( (int)$product['discount_price'] != 0): ?>
                    <p class="font30 black bold font-segoe pad-topbot4">
                        <strike><i class='fa fa-inr'></i>
                            <?php 
                                echo number_format($product['price']); 
                            ?>
                        </strike> 
                        <span><i class='fa fa-inr'></i>
                            <?php 
                                echo number_format($product['discount_price']); 
                                $discount_price = $product['discount_price'];
                            ?>
                        </span>
                    </p>    
                <?php else: ?>
                    <p class="font30 black bold font-segoe pad-topbot4">
                        <span><i class='fa fa-inr'></i>
                            <?php 
                                echo number_format($product['price']); 
                            ?>
                        </span>
                    </p>
                <?php endif; ?>
            </p>
            <form action="<?php echo base_url().'index.php/front/'?>order/add_to_cart"  method="POST">

                <input name="product_id" value="<?php echo $product['product_id']; ?>" type="hidden" />
                <input name="price" value="<?php echo $price; ?>" type="hidden" />
                <input name="discount_price" value="<?php echo $discount_price; ?>" type="hidden" />
                <input name="main_image" value="<?php echo $product['main_image']; ?>" type="hidden" />
                <input name="name" value="<?php echo $product['name']; ?>" type="hidden" />
                <input name="slug" value="<?php echo $product['slug']; ?>" type="hidden" />
                <input name="brand_name" value="<?php echo $product['brand']; ?>" type="hidden" />

                <div class="clearfix font-segoe uppercase">
                    <div class="color-main fl">Color
                        <span class="white-box left">
                            <?php
                                $product_fields = explode(',', $product['field_id']);
                                $product_details = explode(',', $product['detail']);

                                $field_detail = array();

                                foreach( $product_fields as $key=> $detail ){

                                    $field_detail[ $detail ] = $product_details[ $key ];

                                }

                                foreach ($product['fields'] as $field) {
                                    if( strtolower($field['name']) == 'color' ){

                                        echo $field_detail[ $field['field_id'] ];
                                        echo '<input name="color" value="'.$field_detail[ $field['field_id'] ].'" type="hidden" />';
                                        break;

                                    }
                                }
                            ?>
                        </span>
                    </div>

                    <?php if( (int)$product['is_inventory'] ==1 && $product['inventory'][0]['size'] != "0"): ?>

                        <div class="size-main fl">
                            <p class="fl size">SIZE</p>
                            <select class="white-box no-mrgn-left uppercase black" name="size" id="product-size">
                                <?php 
                                    foreach ($product['inventory'] as $inventory) {
                                        echo "<option data-stk=". $inventory['stock'] ." value='".$inventory['size']."'>";
                                        echo $inventory['size'];
                                        echo "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if( (int)$product['is_inventory'] ==1 && $product['inventory'][0]['size'] != "0"): ?>

                    <div class="clearfix mrgn-topbot2 quantity-div">
                        <p class="fl size no-mrgn-left">QUANTITY</p>

                        <input type="number" min="1" max="<?php echo $product['inventory'][0]['stock']; ?>" value="1" class="txt-box" name="qty"/>

                    </div>

                    <input name="max_qty" value="<?php echo $product['inventory'][0]['stock']; ?>" type="hidden" id="max-qty" >
                    <div class="">
                        <input type="submit" id="submit" value="add to cart" class="submit-btn uppercase bold btn-pad">
                    </div>
                <?php else: ?>
                    Out Of Stock
                <?php endif; ?>

                
                <div class="clearfix border-top">
                    <span class='st_facebook_hcount' displayText='Facebook'></span>
                    <span class='st_googleplus_hcount' displayText='Google +'></span>
                    <span class='st_twitter_hcount' displayText='Tweet'></span>
                </div>
            </form>
        </div>
    </div>
    <div class="tab-description clearfix">

        <ul class="tabs">
            <li><a href="#tab1">Description</a></li>
            <li><a href="#tab2">specifications</a></li>
            <li><a href="#tab3">other info</a></li>
            <li><a href="#tab4">Video</a></li>
        </ul>
        <div class="tab_container">
            <?php if($product['description']!='') {?>
            <div id="tab1" class="tab_content clearfix">
                <?php echo $product['description']; ?>
            </div>
            <?php } ?>
            <?php if($product['specs']!='') {?>
            <div id="tab2" class="tab_content clearfix">
                <div class="spacifications-disc">
                    <?php $specs = json_decode($product['specs']); ?>
                    <?php foreach($specs as $name => $value): ?>
                        <div class="">
                            <div class="greya fl"><?php echo $name; ?></div>
                            <div class="greyb fl"><?php echo $value; ?></div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
            <?php } ?>
            <?php if($product['additional_info']!='') {?>
            <div id="tab3" class="tab_content clearfix">
                <ul class="bulletstyle">
                    <?php echo $product['additional_info']; ?>
                </ul>
            </div>
            <?php } ?>
            <?php if($product['video']!='') {?>
                <div id="tab4" class="tab_content video clearfix">
                    <iframe width="100%" height="510" src="<?php echo $product['video']; ?>" frameborder="0" allowfullscreen></iframe>
                </div>
            <?php } ?>
        </div>

    </div><!--tab-description end-->
    <div class="">
        <h5 class="uppercase black mrgn-topbot3">You may also like</h5>
        <div class="most-like border clearfix">

            <div class="product-box-main product-box-main2">
                <a href="#" class="fl">
                    <div class="product-box">
                        <span class="products-size-inner">
                            <img src="<?php echo base_url().'assests/';?>images/gps-72h.jpg" alt="Garmin GPS - 72H">
                        </span>
                        </div>
                        <p class="prod-nm uppercase font14 center">Garmin GPS - 72H</p>
                        <p class="price center">&#8377;12,500</p>
                </a>
            </div>

            <div class="product-box-main product-box-main2">
                <a href="#" class="fl">
                    <div class="product-box">
                        <span class="products-size-inner">
                        <img src="<?php echo base_url().'assests/';?>images/garmin-gps-map64.jpg" alt="Garmin GPS MAP 64">
                        </span>
                        </div>
                        <p class="prod-nm uppercase font14 center">Garmin GPS MAP 64</p>
                        <p class="price center">&#8377;11,500</p>
                </a>
                </div>
            <div class="product-box-main product-box-main2">
                <a href="#" class="fl">
                    <div class="product-box">
                        <span class="products-size-inner">
                        <img src="<?php echo base_url().'assests/';?>images/garmin-nuvi-55lm.jpg" alt="Garmin Nuvi 55 LM">
                        </span>
                        </div>
                        <p class="prod-nm uppercase font14 center">Garmin Nuvi 55 LM</p>
                        <p class="price center">&#8377;10,000</p>
                </a>
                </div>
            <div class="product-box-main product-box-main2">
                <a href="#" class="fl">
                    <div class="product-box">
                        <span class="products-size-inner">
                        <img src="<?php echo base_url().'assests/';?>images/garmin-gps-montana.jpg" alt="Garmin GPS Montana">
                        </span>
                        </div>
                        <p class="prod-nm uppercase font14 center">Garmin GPS Montana </p>
                        <p class="price center">&#8377;9,600</p>
                </a>
            </div>



            <?php //foreach( $product['similar'] as $similar ) { ?>
                <!-- <div class="product-box-main product-box-main2">
                    <a href="#" class="fl">
                        <div class="product-box">
                                <span class="products-size-inner">
                                <img src="<?php //echo base_url();?>assests/uploads/images/<?php //echo $product['main_image'];?>" alt="Garmin GPS - 72H">
                                </span>
                        </div>
                        <p class="prod-nm uppercase font14 center"><?php //echo $similar['name'];?></p>
                        <p class="price center">
                            <?php //if((int) $similar['discount_price']!=0) { ?>
                                <strike><i class='fa fa-inr'></i><?php //echo number_format($similar['discount_price']);?></strike>
                            <?php //} ?>
                            <i class="fa fa-inr"></i><?php //echo number_format($similar['price']); ?>
                        </p>
                    </a>
                </div> -->
            <?php //} ?>


        </div><!--most-like end-->
    </div>
</div><!--wrapper grey-bg container end-->
<script type="text/javascript">
    $(document).ready(function() {
        $('.fancybox').fancybox();
    });
</script>
<script>
    $('.bxslider').bxSlider({
        pagerCustom: '#bx-pager'
    });
</script>
<script type="text/javascript">

    $(document).ready(function() {

        //Default Action
        $(".tab_content").hide(); //Hide all content
        $("ul.tabs li:first").addClass("active").show(); //Activate first tab
        $(".tab_content:first").show(); //Show first tab content

        //On Click Event
        $("ul.tabs li").click(function() {
            $("ul.tabs li").removeClass("active"); //Remove any "active" class
            $(this).addClass("active"); //Add "active" class to selected tab
            $(".tab_content").hide(); //Hide all tab content
            var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
            $(activeTab).fadeIn(); //Fade in the active content
            return false;
        });

    });
</script>
<!-- <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "f8f6678e-ec56-4fe2-a735-778ede3a014d", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>-->


<script>
    (function($) {
        $.fn.spinner = function() {
            this.each(function() {
                var el = $(this);

                // add elements
                el.wrap('<span class="spinner"></span>');
                el.before('<span class="sub">-</span>');
                el.after('<span class="add">+</span>');

                // substract
                el.parent().on('click', '.sub', function () {
                    if (el.val() > parseInt(el.attr('min')))
                        el.val( function(i, oldval) { return --oldval; });
                });

                // increment
                el.parent().on('click', '.add', function () {
                    if (el.val() < parseInt(el.attr('max')))
                        el.val( function(i, oldval) { return ++oldval; });
                });
            });
        };
    })(jQuery);

    $('input[type=number]').spinner();
</script>