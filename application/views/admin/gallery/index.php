<div class="contentWrapper">
    <div class="container-fluid">

        <!-- Breadcrumb -->
        <div class="row-fluid hidden-phone">
            <div class="span12">
                <ul class="breadcrumb">
                    <li>You are here: <icon class="icon-home icon-blue-l"></icon></li>
                    <li>Dashboard</a></li>
                    <li><span class="divider"></span>Slideshows</li>
                    <li><span class="divider"></span>Manage Slideshows</li>
                </ul>
            </div>
        </div>
        <div class="clearfix separator bottom"></div>
        <!--  End Heading -->
        <div class="row-fluid">
            <div class="span6">
                <p class="lead">Manage Your Photoes</p>
            </div>
            <div class="clearfix"></div>
            <div class="separator"></div>
        </div>
<?php echo $this->load->view("admin/flash.php"); ?>
        <div class="row-fluid">
            <div class="span12">

                    <table class="table table-striped table-bordered table-responsive block">
                        <thead>
                        <tr>
                            <th class="center"  width="2%"></th>
                            <th class="center"  width="80%">Image</th>
                            <th class="center"  width="18%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 0;
                        foreach($slideshows[0]['data'] as $image) { ?>
                            <tr>
                                <td><?php echo ++$i; ?></td>
                                <td><center><img style="height:100px" src="<?php echo base_url();?>assests/images/slideshows/<?php echo $image['image_name'];?>" alt="slideshow"></center></td>
                                <td><a href="<?php base_url(); ?>gallery/edit/<?php echo $image['slideshow_id'];?>" target="_blank" class="btn btn-success btn-phone-block"><icon class="icon-pencil icon-white"></icon>Edit</a></td>
                            </tr>
                        <?php } ?>
                        </tbody>

                    </table>
            </div>

        </div>
        <!-- Categories Table -->



    </div>
    </dvi>
</div>





