<div class="">
<?php foreach($data['rootcategories'] as $key=>$value) { ?>    
    <div class="home-box new-width fl pad-btm">
        <a href="<?php echo base_url(); ?>category/<?php echo $value['slug']; ?>">
        <div class="box-img">
            <span><img src="<?php echo base_url(); ?>assests/images/categories/<?php echo $value['image_name']; ?>" alt="box image" height="317" width="217"></span>
        </div><!--home-box end-->
        <div class="clearfix box-pad white-bg">
            <div class="bold font26 orange font-calibri mrgn-bot2"><?php echo $value['name']; ?></div>
                 <div class="clearfix">
                    <p class="font16 fl short-dis"><?php echo $value['description']; ?></p>
                    <a href="<?php echo base_url(); ?>category/<?php echo $value['slug']; ?>" class="fr">
                        <img src="<?php echo base_url(); ?>assests/front/images/arrow-grey.png" alt="grey arroe">
                    </a>
                </div>
            </div>
        </a>
    </div>                          
<?php } ?>    
</div>