        <div class="wrapper grey-bg container clearfix pad-bot1 mrgn-bot4">
            <div class="breadcrumb  font-segoe mrgn-bot1">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><i class="fa fa-chevron-right"></i></li>
                    <li>In the Press</li>
                    
                </ul>
            </div><!--breadcrumb end-->
            <div class="garmin-banner">
                <img src="<?php echo base_url();?>assests/front/images/about-banner.jpg" alt="banner image" height="192" width="1000">
                <h1 class="uppercase">in the press</h1>
            </div><!--garmin-banner end-->
            <div class="press-box-main clearfix mrgn-bot6">
                <div class="mrgn-top2">
                  <div class="clearfix center grey-bg press-box mrgn-bot5">
                        <ul class="in-thenews-box mrgn-bot6">
                        <?php foreach($news as $key=>$value) { ?>    
                            <li>
                                <img src="<?php echo base_url();?>assests/images/publications/<?php echo $value['main_image'];?>" alt="a&s place photo">
                                <div class="line-height"><h6 class="font20 bold black left line-height2"><?php echo $value['title'];?></h6>
                                <p class="font15 left"><?php echo $value['description'];?></p>
                                </div>
                                <a href="<?php echo $value['link'];?>" class="btn-plane uppercase font14 bold fr mrgn-top2">Read more</a>
                            </li>
                        <?php } ?>        
                        </ul>
                    </div><!--wrapper end-->  
                   
                    
                    
                </div>
            </div><!--press-box-main end-->
            <div class="width1 pagination pad-topbot3 fr font-segoe font14 white-bg border">
                    <div class="fr">
                        <p class="fl">Page</p>
                        <a href="#" class="prev fl">1</a>
                        <p class="fl ">of</p>
                        <a href="#" class="next fl">3</a>
                        <a href="#" class="fl next1">Next</a>
                    </div>
                </div>
        </div><!--wrapper end-->