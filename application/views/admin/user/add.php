<div class="contentWrapper">
<div class="col-xs-12">
    <div class="sec-box">       
    	<header>
            <h2 class="heading"><a href="<?php echo site_url("/user"); ?>" class="hyper_link">User</a> &gt; Add user</h2>
            <div class="clearfix"></div>
        </header>
        <form name="article_add" method="post" action="<?php echo  site_url('user/add'); ?> " enctype="multipart/form-data">
         <div class="contents">
            <div class="table-box">
            	<table class="table">
          	  		<tbody>
          	  			<tr>
          	  				<td class="col-md-2 col-lg-2 col-sm-2">Email:</td>
          	  				<td class="col-md-5 col-lg-5 col-sm-5"><input type="text" name="email" class="form-control"><label><?php echo form_error('email'); ?></label></td>
          	  				<td class="col-md-5 col-lg-5 col-sm-5"></td>
          	  			</tr>
                    <tr>
                      <td class="col-md-2 col-lg-2 col-sm-2">Name:</td>
                      <td class="col-md-5 col-lg-5 col-sm-5"><input type="text" name="name" class="form-control"><label><?php echo form_error('name'); ?></label></td>
                      <td class="col-md-5 col-lg-5 col-sm-5"></td>
                    </tr>
                    <tr>
                      <td class="col-md-2 col-lg-2 col-sm-2">Password:</td>
                      <td class="col-md-5 col-lg-5 col-sm-5"><input type="password" name="password" class="form-control"><label><?php echo form_error('password'); ?></label></td>
                      <td class="col-md-5 col-lg-5 col-sm-5"></td>
                    </tr>
                    <tr>

                      <td class="col-md-2 col-lg-2 col-sm-2">Role:</td>
                      <td class="col-md-5 col-lg-5 col-sm-5">
                        <select class="form-control" name="role_id">
                          <option disabled default>--Select Role--</option>

                          <?php 
                            foreach ($role as $r) {?>
                                <option value="<?php echo $r['role_id'];?>"><?php echo $r['role_name'];?></option>
                          <?php  }
                          ?>
                        </select>
                        <lable><?php echo form_error('role_id'); ?><lable>
                      </td>
                      <td class="col-md-5 col-lg-5 col-sm-5"></td>
                    </tr>
          	  			<tr>
          	  				<td class="col-md-2 col-lg-2 col-sm-2"></td>
          	  				<td class="col-md-5 col-lg-5 col-sm-5"><input class="btn btn-primary" type="submit" value="Add"></td>
          	  				<td class="col-md-5 col-lg-5 col-sm-5"></td>
          	  			</tr>
          	  		</tbody>	
            	</table>
	        </div>
         </div>
        </form> 
    </div>
</div>
</div>
