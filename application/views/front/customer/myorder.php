<div class="wrapper grey-bg container clearfix forgot-btm-pad">
    <div class="breadcrumb  font-segoe mrgn-bot1">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><i class="fa fa-chevron-right"></i></li>
            <li>My Order</li>
        </ul>
    </div><!--breadcrumb end-->
    <div class="garmin-banner">
        <img src="<?php echo base_url(); ?>assests/front/images/dashboard-banner.jpg" alt="banner image" height="192" width="1000">
        <h1 class="uppercase">My Order</h1>
    </div><!--garmin-banner end-->
    <div class="mrgn-top2">
        <?php echo $this->load->view('front/element/customer_sidebar'); ?>
        <div class="right-bar fl no-border">
            <span class="blue uppercase font18 mrgn-bot1">My Orders</span>
            <form>
                <table border="0" cellpadding="0" cellspacing="0" class="shop-cart-table font-segoe black">
                    <tr class="border">
                        <th width="38%" class="uppercase blue left font16">product</th>
                        <th width="19%" class="uppercase blue left font16">Order date</th>
                        <th width="19%" class="uppercase blue left font16">price</th>
                        <th width="19%" class="uppercase blue left font16">Status</th>

                    </tr>
                    <tr>
                        <td>
                            <img src="<?php echo base_url(); ?>assests/front/images/product-img/pro-thumb1.jpg" alt="product image" class="border fl mr-rgt-img">
                            <div class="prod-code font15 uppercase">Etrex - 10</div>
                        </td>

                        <td class="font15">15.05.15</td>
                        <td class="size-main">
                            <div class="font15"><i class="fa fa-inr"></i>5,850</div>
                        </td>
                        <td class="total font15 uppercase">Shipped</td>

                    </tr>


                </table>

            </form>
        </div><!--right-bar end-->

    </div>
</div><!--wrapper grey-bg container end-->