        <div class="wrapper clearfix center grey-bg pad-bot5">
            <h5 class="uppercase blue bold news-title">In the News</h5>
            <ul class="in-thenews-box">
            <?php foreach($data['news'] as $key=>$value) { ?>
                <li>
                    <img src="<?php echo base_url(); ?>assests/images/publications/<?php echo $value['main_image'];?>" alt="a&s place photo">
                    <div class="line-height"><h6 class="font20 bold black left"><?php echo $value['title'];?></h6>
                    <p class="font15 left"><?php echo $value['description'];?></p>
                    </div>
                </li>
            <?php } ?>
            </ul>
        </div><!--wrapper end-->