<div class="contentWrapper">      
    <div class="container-fluid">
    
    <!-- Breadcrumb -->
    <div class="row-fluid hidden-phone">
        <div class="span12">
            <ul class="breadcrumb">
                <li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
                <li>Dashboard</a></li>
                <li><span class="divider"></span>Users</li>
                <li><span class="divider"></span>Manage Users</li>
            </ul>
        </div>
</div>
<div class="clearfix separator bottom"></div>
<!--  End Heading -->
        <div class="row-fluid">

            <!--  Buttons -->
            <div class="span6">
                <p class="lead">Manage Users</p>
            </div>
            <div class="clearfix"></div>
            <div class="separator"></div>
            <!-- End Buttons -->
        </div>
<?php echo $this->load->view("admin/flash.php"); ?>
<div class="row-fluid">
  <div class="span12">
    <form method="post" action="<?php echo base_url();?>user/cancel" id="delete-user-form">
      <table id="example" class="table table-striped table-bordered table-responsive block user-table">
        <thead>
          <tr>
              <th width="1%"><input type="checkbox" onchange="checkAll(this)" /></th>
            <th>No.</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Mobile Number</th>
          </tr>
        </thead>
        <tbody id="user-table-body">
          <?php 
                $i = 1;
                foreach($users as $u){ ?>
                   <tr>
                      <td class="column-check">
                        <input type="checkbox" name="checked[]" value="<?php echo $u['user_id']; ?>" />
                      </td>
                      <td><?php echo $i++;?></td>
                      <td><?php echo $u['fname'];?></td>
                      <td><?php echo $u['email'];?></td>
                      <td><?php echo $u['mobilenumber'];?></td>
                  </tr>

            <?php }?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="11">
              <input type="submit" id="delete-me" value="Delete"  class="btn btn-danger" onclick="return confirm('Are You sure you want to delete selected user(s)?')"/>
            </td>
          </tr>  
        </tfoot>      
      </table>
    </form>
  </div>
</div>
  <!-- Categories Table -->



  </div>
</div>
</div>

  
  



