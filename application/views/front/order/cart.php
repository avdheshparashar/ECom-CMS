<div class="wrapper grey-bg container clearfix pad-bot2">
    <div class="breadcrumb  font-segoe mrgn-bot1">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><i class="fa fa-chevron-right"></i></li>
            <li><a href="#">Shopping Cart</a></li>
        </ul>
    </div><!--breadcrumb end-->
    <div class="garmin-banner">
        <img src="<?php echo base_url();?>assests/front/images/shopping-banner.jpg" alt="banner image" height="192" width="1000">
        <h1 class="uppercase">Shopping cart</h1>
    </div><!--garmin-banner end-->
    <div class="mrgn-top2 grey-bg clearfix">
        <form action="<?php echo base_url();?>front/order/update_cart" method="post" data-parsley-trigger="change"
              data-parsley-ui-enabled="true" data-parsley-validate>
            <table border="0" cellpadding="0" cellspacing="0" class="shop-cart-table font-segoe">
                <tr class="border">
                    <th width="19%" class="uppercase blue left font16">product</th>
                    <th width="19%" class="uppercase blue left font16">description</th>
                    <th width="19%" class="uppercase blue left font16">price</th>
                    <th width="19%" class="uppercase blue left font16">quantity</th>
                    <th width="19%" class="uppercase blue left font16">total</th>
                    <th width="5%" class="uppercase blue left font16"></th>
                </tr>
            <?php
                $final_total = 0;
                foreach($products as $key=>$value) {?>
                <tr>
                    <td>
                        <img src="<?php echo base_url();?>assests/uploads/images/thumb/<?php echo $value['main_image'];?>"
                             alt="product image" class="border">
                    </td>
                    <td class="uppercase line-height">
                        <div class="prod-code font15"><?php echo $value['name']; ?></div>
                        <div class="prod-nm font13"><?php echo $value['brand_name'];?></div>
                        <div class="prod-size font13">Size:<?php echo $value['size'];?></div>
                    </td>
                    <td class="pro-price font15"><i class="fa fa-inr"></i>
                        <?php
                            if($value['discount_price']!=0) {
                                echo number_format($value['discount_price']);
                                $total = $value['qty'] * $value['discount_price'];
                        } else {
                                echo number_format($value['price']);
                                $total = $value['qty'] * $value['price'];
                            }
                        $final_total = $final_total + $total;
                        ?>
                    </td>
                    <td class="size-main">
                        <input type="text" name="qty[<?php echo $key;?>]" value="<?php echo $value['qty']; ?>"
                               data-parsley-range="[1,<?php echo $value['max_qty'];?>]"
                               data-parsley-error-message="<?php echo '<br/>';?>Qty Should be between 1 to <?php echo $value['max_qty'];?>"
                               class="white-box no-mrgn-left uppercase black" />
                    </td>
                    <td class="total font15"><i class="fa fa-inr"></i><?php echo number_format($total); ?></td>
                    <td><a href="<?php echo base_url().'front/order/remove_from_cart/'.$key;?>" class="close-btn"></a></td>
                </tr>
            <?php } ?>

            </table>
            <div class="clearfix">

                <button  type="submit" class="yellow-btn updt-btn uppercase fr font-segoe" >Update cart</button>

            </div>
            </form>
            <div class="clearfix border-top mrgn-topbot7">
                <div class="fl redeem-coupon">
                    <span class="blue uppercase font18 mrgn-bot1">Redeem coupon</span>
                    <form method="post" action="<?php echo base_url();?>front/order/apply_coupon">
                        <div>
                            <input type="text" name="code" id="coupon" value="<?php echo $this->session->userdata("discount_code"); ?>" class="coupon-feild">
                            <button type="submit" name="apply-coupon" class="yellow-btn uppercase updt-btn font-segoe">APPLY COUPON</button>
                        </div>
                    </form>
                </div><!--redeem-coupon end-->
                <div class="cart-total fl">
                    <span class="blue uppercase font18 mrgn-bot1 block">Cart totals</span>
                    <div class="white-bg border pad-all">
                        <fieldset>
                            <label>Cart subtotal</label>
                            <span class="fr"><i class="fa fa-inr"></i><?php echo number_format($final_total); ?></span>
                        </fieldset>
                        <fieldset>
                            <label>Discount coupon</label>
                            <span class="fr"><?php echo number_format($this->session->userdata("discount")); ?></span>
                        </fieldset>
                        <fieldset class="border-top"></fieldset>
                        <fieldset>
                            <label>Order total</label>
                            <?php $final_total = $final_total - $this->session->userdata("discount"); ?>
                            <span class="fr"><i class="fa fa-inr"></i><?php echo number_format($final_total); ?></span>
                        </fieldset>

                    </div>
                    <fieldset class="fr mrgn-top2"><a href="#" class="uppercase green-btn">PROCEED TO CHECKOUT</a></fieldset>
                </div><!--cart-total end-->
            </div><!--redeem-coupon end-->
        </from>
    </div>
</div><!--wrapper grey-bg container end-->