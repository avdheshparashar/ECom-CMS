<div class="wrapper grey-bg container clearfix">
    <div class="breadcrumb  font-segoe mrgn-bot1">
        <ul>
            <li><a href="<?php echo base_url(); ?>">Home</a></li>
            <li><i class="fa fa-chevron-right"></i></li>
            <li><?php echo $details['brand']['name']; ?></li>
        </ul>
    </div><!--breadcrumb end-->
    <input type="hidden" value="<?php echo $details['brand']['slug'];?>" id="my-slug">
    <input type="hidden" value="<?php echo $details['brand']['brand_id'];?>" id="my-id">
    <div class="garmin-banner">
        <img src="<?php echo base_url(); ?>assests/images/brands/<?php echo $details['brand']['banner_image']; ?>" alt="banner image" height="192" width="1000">
        <h1 class="uppercase"><?php echo $details['brand']['name']; ?></h1>
    </div><!--garmin-banner end-->
    <div class="mrgn-top2">
        <div class="left-bar fl">
            <div class="uppercase orange pad-topbot2 heading no-border-top">Show me</div>
            <?php 
                foreach($filters as $key1=>$filter) { 
                    if($filter['is_price']==0) {
            ?>
            <div class="no-pad1">
                <div class="uppercase orange pad-topbot2 heading"><?php echo $filter['name']; ?></div>
                <div class="clearfix left-bar-inner mrgn-top3 features">
                <?php
                    $attrs = explode(",",$filter['details']);
                    foreach ($attrs as $key2 => $attr) {
                ?>  
                    <div class="mrgn-bot2 ">
                        <input type="checkbox" class="css-checkbox call-ajax" name="checkboxG1" data-send="<?php echo $attr; ?>" id="<?php echo $filter['name'].$key2; ?>" >
                        <label for="<?php echo $filter['name'].$key2; ?>" class="css-label mrgnbtm0 " ><?php echo $attr; ?></label>
                    </div>
                <?php } ?>
                </div>
            </div><!--left-bar-inner end-->
            <?php }  else { ?>
            <div class="no-pad1">
                <div class="uppercase orange pad-topbot2 heading">Price range</div>
                <?php  
                    $attrs = explode(",",$filter['details']);
                    $min = min($attrs);
                    $max = max($attrs);
                    $diff = $max - $min;
                ?>
                <div class="clearfix left-bar-inner mrgn-top3">
                    <div class="fl mrgn-bot2 width1">
                        <input type="checkbox" class="fl css-checkbox prices call-ajax" name="checkboxG15" id="checkboxG15" data-min="<?php echo $min; ?>" data-max="<?php echo $min + ceil($diff/4); ?>">
                        <label for="checkboxG15" class="css-label mrgnbtm0">Below <?php echo $min + ceil($diff/4); ?></label>
                    </div>
                    <div class="fl mrgn-bot2 width1">
                        <input type="checkbox" class="fl css-checkbox prices call-ajax" name="checkboxG16" id="checkboxG16" data-min="<?php echo $min + ceil($diff/4); ?>" data-max="<?php echo $min + 2 *ceil($diff/4);?>">
                        <label for="checkboxG16" class="css-label mrgnbtm0">Rs. <?php echo $min + ceil($diff/4); ?> to Rs.<?php echo $min + 2 *ceil($diff/4);?></label>
                    </div>
                    <div class="fl mrgn-bot2 width1">
                        <input type="checkbox" class="fl css-checkbox prices call-ajax" name="checkboxG147" id="checkboxG17" data-min="<?php echo $min + 2 *ceil($diff/4);?>" data-max="<?php echo $min + 3* ceil($diff/4);?>">
                        <label for="checkboxG17" class="css-label mrgnbtm0">Rs. <?php  echo $min + 2 *ceil($diff/4); ?> to Rs.<?php echo $min + 3* ceil($diff/4);?></label>
                    </div>
                    <div class="fl mrgn-bot2 width1">
                        <input type="checkbox" class="fl css-checkbox prices call-ajax" name="checkboxG18" id="checkboxG18" data-min="<?php echo $min + 3* ceil($diff/4);?>" data-max="<?php echo $max;?>" >
                        <label for="checkboxG18" class="css-label mrgnbtm0">Above Rs. <?php echo $min + 3* ceil($diff/4);?></label>
                    </div>
                </div>
            <?php } }?>    
            </div><!--left-bar-inner end-->
        </div><!--left-bar end-->
    
        <div class="right-bar fl white-bg" id="replace-me">
            <div class="category-pagination">
                <?php echo $this->load->view("front/brand/content"); ?>
            </div>    
        </div><!--right-bar end-->

        <div class="pagination pad-topbot3 fr font-segoe font14 white-bg border">
            <div class="fr">
                <p class="fl">Page</p>
                <a href="#" class="prev fl">1</a>
                <p class="fl ">of</p>
                <a href="#" class="next fl">20</a>
                <a href="#" class="fl next1">Next</a>
            </div>
        </div>
    </div>
</div><!--wrapper grey-bg container end-->
<script type="text/javascript">   
    $(document).ready(function(){
        $(".call-ajax").click(function(){
        var data_to_send = [];
        var prices = [];
        
            $(".call-ajax:checked").each(function(){
                data_to_send.push( $(this).attr("data-send") );
            }).promise().done(function(){

                $(".prices:checked").each(function(){
                    var priceObj = {};
                    priceObj.min = $(this).attr('data-min');
                    priceObj.max = $(this).attr('data-max');
                    prices.push(priceObj);

                }).promise().done(function(){

                    // if( data_to_send.length !== 0 || prices.length !== 0  ){
                        var data = {};
                        data.filter = data_to_send;
                        data.slug = $("#my-slug").val();
                        data.catid = $("#my-id").val();
                        data.price = prices;
                        
                        $.ajax({
                            url: 'http://localhost/ascreation/front/brand/filter',
                            type: "POST",
                            cache: false,
                            data: data,
                            success: function (response) {
                                console.log(response);
                                $("#replace-me").html(response);
                            }   

                        });
                    // }
                });           
          });
        });
    });
</script>