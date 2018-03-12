<div class="contentWrapper">      
    <div class="container-fluid">
    
    <!-- Breadcrumb -->
    <div class="row-fluid hidden-phone">
  <div class="span12">
    <ul class="breadcrumb">
      <li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
      <li>Dashboard</a></li>
      <li><span class="divider"></span>Users</li>
      <li class="active"><span class="divider"></span>Access Control <span class="divider"></span>Manage Permissions</li>
    </ul>
  </div>

</div>
    <div class="row-fluid">
  <div class="span6">
    <p class="lead">Manage functions and their Access</p>
  </div>
  <div class="span6" align="right">
    <a href="#modalAddUser" class="btn btn-primary btn-phone-block" data-toggle="modal">
      <icon class="icon-plus-sign icon-white"></icon> 
      Add New User
    </a>
  </div>
</div>
<div class="clearfix separator bottom"></div>
<!--  End Heading -->
<?php echo $this->load->view("admin/flash.php"); ?>
<div class="row-fluid">
  <div class="span12">
    <form method="post" action="<?php echo base_url();?>user/changestatus" id="delete-user-form">
      <table class="table table-striped table-bordered table-responsive block user-table" id="example">
        <thead>
          <tr>
            <th class="column-check"></th>
            <th>No.</th>
            <th>Email</th>
            <th>Role Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="user-table-body">
          <?php 
                $i = 1;
              foreach($user as $u){ ?>
                   <tr>
                      <td class="column-check">
                        <input type="checkbox" name="checked[]" value="<?php echo $u->user_id;?>" />
                      </td>
                      <td><?php echo $i++;?></td>
                      <td><?php echo $u->email;?></td>
                      <td><?php echo $u->role_name;?></td>
                      <td>
                        <a href="#modalEditUser-<?php echo $u->user_id;?>" class="btn btn-primary btn-phone-block" data-toggle="modal">
                          <icon class="icon-plus-sign icon-white"></icon> 
                          Edit
                        </a>
                      </td>
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


<!--  Modal Add User -->
<div class="hide modal" id="modalAddUser">
  <div class="modal-header">
    <p>
      Add User
      <button type="button" class="close " data-dismiss="modal" aria-hidden="true">&times;</button>
    </p>
  </div>
  <div class="modal-body">
    <form class="form-horizontal">
      <table class="table user-add">
          <tbody>
            <tr>
              <td class="col-md-2 col-lg-2 col-sm-2">
                Email:</td>
              <td class="col-md-5 col-lg-5 col-sm-5">
                <input type="text" name="email" class="form-control">
              </td>
              <td class="col-md-5 col-lg-5 col-sm-5"></td>
            </tr>

            <tr>
              <td class="col-md-2 col-lg-2 col-sm-2">
                Name:
              </td>
              <td class="col-md-5 col-lg-5 col-sm-5">
                <input type="text" name="name" class="form-control">
              </td>
              <td class="col-md-5 col-lg-5 col-sm-5"></td>
            </tr>

            <tr>
              <td class="col-md-2 col-lg-2 col-sm-2">
                Password:
              </td>
              <td class="col-md-5 col-lg-5 col-sm-5">
                <input type="password" name="password" class="form-control">
              </td>
              <td class="col-md-5 col-lg-5 col-sm-5"></td>
            </tr>

            <tr>
              <td class="col-md-2 col-lg-2 col-sm-2">Role:</td>
              <td class="col-md-5 col-lg-5 col-sm-5">
                <select class="form-control" name="role_id" id="role-id">
                  <option disabled default>--Select Role--</option>

                  <?php 
                    foreach ($role as $r) {?>
                        <option value="<?php echo $r['role_id'];?>"><?php echo $r['role_name'];?></option>
                  <?php  }
                  ?>
                </select>
              </td>
              <td class="col-md-5 col-lg-5 col-sm-5"></td>
            </tr>
          </tbody>  
      </table>
    </form>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary" id="add-user">Save & Continue <icon class="icon-share-alt icon-white"></icon></button>
  </div>
</div>
<!--  End Modal Add User -->

<!--///////////////////////////////////////// Used in Editing Begin ////////////////////////////////// -->

<?php foreach($user as $u): ?>

      <div class="hide modal" id="modalEditUser-<?php echo $u->user_id;?>">
        <div class="modal-header">
          <p>
            Edit User
            <button type="button" class="close " data-dismiss="modal" aria-hidden="true">&times;</button>
          </p>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">
            <table class="table user-edit">
              <input name="user_id" class="form-control" value="<?php echo $u->user_id;?>" type='hidden'>
                <tbody>
                  <tr>
                    <td class="col-md-2 col-lg-2 col-sm-2">
                      Email:</td>
                    <td class="col-md-5 col-lg-5 col-sm-5">
                      <input type="text" name="email" class="form-control" value="<?php echo $u->email;?>">
                    </td>
                    <td class="col-md-5 col-lg-5 col-sm-5"></td>
                  </tr>

                  <tr>
                    <td class="col-md-2 col-lg-2 col-sm-2">
                      Name:
                    </td>
                    <td class="col-md-5 col-lg-5 col-sm-5">
                      <input type="text" name="name" class="form-control" value="<?php echo $u->name;?>">
                    </td>
                    <td class="col-md-5 col-lg-5 col-sm-5"></td>
                  </tr>

                  <tr>
                    <td class="col-md-2 col-lg-2 col-sm-2">
                      Password:
                    </td>
                    <td class="col-md-5 col-lg-5 col-sm-5">
                      <input type="password" name="password" class="form-control" value="">
                    </td>
                    <td class="col-md-5 col-lg-5 col-sm-5"></td>
                  </tr>

                  <tr>
                    <td class="col-md-2 col-lg-2 col-sm-2">Role:</td>
                    <td class="col-md-5 col-lg-5 col-sm-5">
                      <select class="form-control" name="role_id" id="role-id">
                        <option disabled default>--Select Role--</option>

                        <?php foreach ($role as $r): ?>

                          <?php if( $r['role_id'] == $u->role_id ): ?>

                            <option value="<?php echo $r['role_id'];?>" selected>
                              <?php echo $r['role_name'];?>
                            </option>

                          <?php else: ?>

                            <option value="<?php echo $r['role_id'];?>" >
                              <?php echo $r['role_name'];?>
                            </option>

                          <?php endif; ?>

                        <?php endforeach; ?>
                      </select>
                    </td>
                    <td class="col-md-5 col-lg-5 col-sm-5"></td>
                  </tr>
                </tbody>  
            </table>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary edit-user">Save & Continue <icon class="icon-share-alt icon-white"></icon></button>
        </div>
    </div>

<?php endforeach; ?>
                  <!--///////////////////////////////////////// Used in Editing Ends ////////////////////////////////// -->



<script type="text/javascript" src="<?php echo base_url();?>assests/admin/custom/js/user.js"> 
</script>
    
  </div>
</dvi>
</div>

  
  



