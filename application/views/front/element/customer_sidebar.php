<div class="left-bar fl">
    <div class="uppercase orange pad-topbot2 heading no-border-top">My account</div>
    <div class="left-bar-inner all-products">
        <!--<h3 class="orange">All products</h3>-->
        <ul>
            <li><a href="<?php echo base_url();?>myaccount/dashboard" class="<?php echo $this->router->fetch_method() == "dashboard" ? 'active' : ''; ?>">Dashboard</a></li>
            <li><a href="<?php echo base_url();?>myaccount/edit" class="<?php echo $this->router->fetch_method() == "edit" ? 'active' : ''; ?>">My profile</a></li>
            <li><a href="<?php echo base_url();?>myaccount/myaddress" class="<?php echo $this->router->fetch_method() == "address" ? 'active' : ''; ?>">My Address</a></li>
            <li><a href="<?php echo base_url();?>front/customer/myorder" class="<?php echo $this->router->fetch_method() == "myorder" ? 'active' : ''; ?>">My Orders</a></li>

        </ul>
    </div><!--left-bar-inner end-->
</div><!--left-bar end-->