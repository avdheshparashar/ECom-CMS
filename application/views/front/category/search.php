        <div class="wrapper grey-bg container clearfix">
            <div class="breadcrumb  font-segoe mrgn-bot1">
                <ul>
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><i class="fa fa-chevron-right"></i></li>
                    <li><?php echo "Search By : ".$searchtag; ?></li>
                </ul>
            </div><!--breadcrumb end-->
            <div class="garmin-banner">
                <img src="http://localhost/ascreation/assests/images/categories/1.jpg" alt="banner image" height="192" width="1000">
                <h1 class="uppercase">Search Result</h1>
            </div><!--garmin-banner end-->
            <div class="mrgn-top2">               
                <div class="right-bar fl white-bg width1">
                <?php foreach($products as $key=>$value) { ?> 
                    <div class="product-box-main new-box">
                        <a href="<?php echo base_url();?>product/<?php echo $value['slug'];?>" class="fl">
                            <div class="product-box pro-box-new">
                                <span class="products-size-inner pro-size-new">
                                    <img src="<?php echo base_url(); ?>assests/uploads/images/search/<?php echo $value['main_image'];?>" alt="watch">
                                </span>
                            </div>
                            <p class="prod-nm pronm-new uppercase font18 center blue"><?php echo $value['product_name']; ?></p>
                            <p class="price center">
                            <?php if($value['discount_price']!=0) {
                                echo "<strike><i class='fa fa-inr'></i>".number_format($value['discount_price'])."</strike>";
                            } ?>
                            <i class="fa fa-inr"></i><?php echo number_format($value['price']);?></p>
                            <?php
                            if((int) $value['discount_price']==0) {
                                if ((int)$value['stamp'] == 1) {
                                    echo "<div class='hot-selling uppercase'>Hot selling</div>";
                                } else if ((int)$value['stamp'] == 2) {
                                    echo "<div class='hot-selling uppercase'>New Arrival</div>";
                                }
                            } else {
                                $discount = 100 - ($value['discount_price'] *100)/$value['price'];
                                echo "<div class='hot-selling uppercase'>".round($discount)."%<br> off </div>";
                            }
                            ?>
                            </p>
                        </a>
                    </div>                    
                <?php } ?>
                </div>
            </div>
        </div><!--wrapper grey-bg container end-->