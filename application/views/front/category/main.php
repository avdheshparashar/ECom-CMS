        <div class="wrapper grey-bg container clearfix">
            <div class="breadcrumb  font-segoe mrgn-bot1">
                <ul>
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                    <li><i class="fa fa-chevron-right"></i></li>
                    <li><?php echo $breadcrumps[0]['name']; ?></li>
                </ul>
            </div><!--breadcrumb end-->
            <div class="garmin-banner">
                <img src="<?php echo base_url(); ?>assests/images/categories/<?php echo $banner;?>" alt="banner image" height="192" width="1000">
                <h1 class="uppercase"><?php echo $breadcrumps[0]['name']; ?></h1>
            </div><!--garmin-banner end-->
            <div class="mrgn-top2">               
                <div class="right-bar fl white-bg width1">
                <?php foreach($rootcategories as $key=>$value) { ?>    
                    <div class="product-box-main new-box">
                        <a href="<?php echo base_url(); ?>category/<?php echo $value['slug'];?>" class="fl">
                            <div class="product-box pro-box-new">
                                <span class="products-size-inner pro-size-new">
                                    <img src="<?php echo base_url(); ?>assests/images/categories/<?php echo $value['image_name'];?>" alt="watch">
                                </span>
                            </div>
                            <p class="prod-nm pronm-new uppercase font18 center blue"><?php echo $value['name'];?></p>
                        </a>
                    </div>                    
                <?php } ?>
                </div>
            </div>
        </div><!--wrapper grey-bg container end-->