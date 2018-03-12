<?php 
    if(empty($products['list'])) { ?>
        <?php echo "No Products Found"; ?>
    <?php } else {
    foreach($products['list'] as $key=>$value) { ?>
            <div class="product-box-main exmaple">
                <a href="<?php echo base_url();?>product/<?php echo $value['slug'];?>" class="fl">
                    <div class="product-box">
                        <span class="products-size-inner">
                            <img src="<?php echo base_url(); ?>assests/uploads/images/category/<?php echo $value['main_image'];?>" alt="gps etrex 10 image">
                        </span>
                    </div>
                    <p class="prod-nm uppercase font14 center"><?php echo $value['product_name']; ?></p>
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

                </a>
            </div>
            <?php } } ?>