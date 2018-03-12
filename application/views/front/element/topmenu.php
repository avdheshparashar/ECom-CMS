            <div class="clearfix menu-main">
            <div class="nav-left fl">
                <ul id='nav'>
                    <li><a href='#' class="orange uppercase">Browse By<br><span class="bold font25">Products</span></a>
                        <?php echo menu($this->results); ?>
                    </li>
                    <li>
                       
                        <a href='#' class="orange uppercase">Browse By<br><span class="bold font25">Brands</span></a>
                        <ul class=""> 
                        <?php foreach($this->brands as $key=>$value) { ?>
                            <li><a href='<?php echo base_url();?>brand/<?php echo $value['slug'];?>'><?php echo $value['name'];?></a></li>
                        <?php } ?>
                        </ul>
                    </li>
                   
                </ul>
                </div><!--nav-left end-->
                </div><!--main-nav end-->