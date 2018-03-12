<!DOCTYPE html>
<html>
<head>
    <title>AS Creation - Admin</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo base_url(); ?>assests/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assests/admin/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link
        href="<?php echo base_url(); ?>assests/admin/bootstrap/extend/bootstrap-wysihtml5/css/bootstrap-wysihtml5-0.0.2.css"
        rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.7/css/jquery.dataTables.css" rel="stylesheet">
    <!-- Bootstrap Extended -->
    <link href="<?php echo base_url(); ?>assests/admin/bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap.min.css"
          rel="stylesheet">
    <link href="<?php echo base_url(); ?>assests/admin/bootstrap/extend/jasny-bootstrap/css/jasny-bootstrap-responsive.min.css"
        rel="stylesheet">
    <!-- wysihtml5 -->
    <link href="<?php echo base_url(); ?>assests/admin/bootstrap/extend/bootstrap-wysihtml5/css/bootstrap-wysihtml5-0.0.2.css"
        rel="stylesheet">


    <!-- Theme :: Beauty Admin  -->
    <link href="<?php echo base_url(); ?>assests/admin/theme/css/beautyadmin.css?1359455799" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assests/admin/custom/css/style.css?1359455799" rel="stylesheet">

    <!--  Google Open Sans Font -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=latin,latin-ext'
          rel='stylesheet' type='text/css'>

    <!-- Jquery Latest -->
    <script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

    <!-- Glyphicons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assests/admin/theme/css/glyphicons.css"/>

    <script type="text/javascript" src="http://www.kryogenix.org/code/browser/sorttable/sorttable.js"></script>
</head>
<body class="main left-menu sticky_footer">

<!--  Header -->

<!-- Top Gray Line -->
<div class="navbar navbar-fixed-top top-line">
    <div class="container-fluid">
        <!-- Logo -->
        <div class="pull-left">
            <a href="<?php echo base_url(); ?>" class="brand">AS<strong>Creation</strong><span
                    class="label label-inverse"></span></a>
        </div>
        <!-- End Logo -->
        <!-- Top Right Menu -->
        <div class="pull-right">
            <div class="toplinks">
                <a href="#">My account
                    <icon class="icon-lock icon-gray"></icon>
                </a>
            </div>
            <span class="divider-topline"></span>

            <div class="toplinks">
                <a href="<?php echo base_url(); ?>index.php/login/logout"
                   onclick="return confirm('Do you really want to logout?')">
                    Logout
                    <icon class="icon-share-alt icon-gray"></icon>
                </a>
            </div>
        </div>
        <!-- End Top Right Menu -->
    </div>
</div>
<!-- End Top Gray Line -->


<!-- End Header -->

<!-- Start Content -->
<div class="contentWrapper">
    <div class="container-fluid mainContainerFluid">

        <div class="row-fluid mainMenuWrapper">
            <div class="span2 mainMenu">
                <ul>
                    <li class="dropdown <?php echo $this->router->fetch_class() == "welcome" ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>welcome">Dashboard</a>
                    </li>
                    <li class="dropdown <?php echo $this->router->fetch_class() == "category" ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>category">Category</a>
                    </li>
                    <li class="dropdown <?php echo $this->router->fetch_class() == "product" ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>product">Product</a>
                    </li>
                    <li class="dropdown <?php echo $this->router->fetch_class() == "field" ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>field">Attribute</a>
                    </li>
                    <li class="dropdown <?php echo $this->router->fetch_class() == "discount" ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>discount">Discount</a>
                    </li>
                    <li class="dropdown <?php echo $this->router->fetch_class() == "offer" ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>offer">Offer</a>
                    </li>
                    <li class="dropdown <?php echo $this->router->fetch_class() == "inquiry" ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>inquiry">Inquiry</a>
                    </li>
                    <li class="dropdown <?php echo $this->router->fetch_class() == "subscriber" ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>subscriber">Subscriber</a>
                    </li>
                    <li class="dropdown <?php echo $this->router->fetch_class() == "gallery" ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>gallery">Slideshow</a>
                    </li>
                    <li class="dropdown <?php echo $this->router->fetch_class() == "size" ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>size">Size</a>
                    </li>
                    <li class="dropdown <?php echo $this->router->fetch_class() == "brand" ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>brand">Brand</a>
                    </li>
                    <li class="dropdown <?php echo $this->router->fetch_class() == "publication" ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>publication">Publication</a>
                    </li>
                    <li class="dropdown <?php echo ($this->router->fetch_class() == "user" && $this->router->fetch_method() == "index") ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>user">Admin Panel Users</a>
                    </li>
                    <li class="dropdown <?php echo ($this->router->fetch_class() == "user" && $this->router->fetch_method() == "lists") ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>user/lists">Customer</a>
                    </li>
                    <li class="dropdown <?php echo $this->router->fetch_class() == "export" ? 'active' : ''; ?>">
                        <a href="<?php echo base_url(); ?>export">Downloads</a>
                    </li>
                </ul>
            </div>
            <div class="span10 mainContent">
                <div class="inner">
                    <!-- Breadcrumb -->
                    <?php echo $content; ?>
                    <div class="footer">

                    </div>

                    <!-- Sticky Footer -->
                    <div id="sticky_footer">
                        <ul>
                            <li><a href="http://www.chhavi.in" class="glyphicons" title=""><i></i> <span
                                        class="hidden-phone">Chhavi</span></a></li>
                        </ul>
                    </div>

                    <!-- End Sticky Footer -->


                    <!-- Bootstrap JS -->
                    <script src="<?php echo base_url(); ?>assests/admin/bootstrap/js/bootstrap.min.js"
                            type="text/javascript"></script>

                    <!-- Resize Script -->
                    <script src="<?php echo base_url(); ?>assests/admin/theme/scripts/jquery.ba-resize.js"></script>

                    <!-- Cookies -->
                    <script src="<?php echo base_url(); ?>assests/admin/theme/scripts/jquery.cookie.js"></script>
                    <script src="<?php echo base_url(); ?>assests/admin/custom/js/parsley.min.js"></script>
                    <!-- Bootstrap Extended -->
                    <!-- jasny plugins -->
                    <script
                        src="<?php echo base_url(); ?>assests/admin/bootstrap/extend/jasny-bootstrap/js/jasny-bootstrap.min.js"
                        type="text/javascript"></script>
                    <script
                        src="<?php echo base_url(); ?>assests/admin/bootstrap/extend/jasny-bootstrap/js/bootstrap-fileupload.js"
                        type="text/javascript"></script>
                    <!-- bootbox -->
                    <script src="<?php echo base_url(); ?>assests/admin/bootstrap/extend/bootbox.js"
                            type="text/javascript"></script>
                    <!-- wysihtml5 -->
                    <script
                        src="<?php echo base_url(); ?>assests/admin/bootstrap/extend/bootstrap-wysihtml5/js/wysihtml5-0.3.0_rc2.min.js"
                        type="text/javascript"></script>
                    <script
                        src="<?php echo base_url(); ?>assests/admin/bootstrap/extend/bootstrap-wysihtml5/js/bootstrap-wysihtml5-0.0.2.min.js"
                        type="text/javascript"></script>

                    <!--  Flot (Charts) JS -->
                    <!--[if lte IE 8]>
                    <script language="javascript" type="text/javascript"
                            src="theme/scripts/flot/excanvas.min.js"></script><![endif]-->
                    <script src="<?php echo base_url(); ?>assests/admin/theme/scripts/flot/jquery.flot.js"
                            type="text/javascript"></script>
                    <script src="<?php echo base_url(); ?>assests/admin/theme/scripts/flot/jquery.flot.pie.js"
                            type="text/javascript"></script>
                    <script src="<?php echo base_url(); ?>assests/admin/theme/scripts/flot/jquery.flot.tooltip.js"
                            type="text/javascript"></script>
                    <script src="<?php echo base_url(); ?>assests/admin/theme/scripts/flot/jquery.flot.resize.js"
                            type="text/javascript"></script>
                    <script src="<?php echo base_url(); ?>assests/admin/theme/scripts/flot/jquery.flot.orderBars.js"
                            type="text/javascript"></script>


                    <script type="text/javascript" src="https://www.google.com/jsapi"></script>

                    <script src="<?php echo base_url(); ?>assests/admin/theme/scripts/load.js?1359455799"></script>
                    <script type="text/javascript">
                        var SITE_URL = '<?php echo site_url(); ?>';
                    </script>
                    <script type="text/javascript" charset="utf8"
                            src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
                    <script type="text/javascript">

                        //    function doSearch() {
                        //     var searchText = document.getElementById('searchTerm').value;
                        //     var targetTable = document.getElementById('dataTable');
                        //     console.log(targetTable);
                        //     var targetTableColCount;

                        //     //Loop through table rows
                        //     for (var rowIndex = 0; rowIndex < targetTable.rows.length; rowIndex++) {
                        //         var rowData = '';

                        //         //Get column count from header row
                        //         if (rowIndex == 0) {
                        //            targetTableColCount = targetTable.rows.item(rowIndex).cells.length;
                        //            continue; //do not execute further code for header row.
                        //         }

                        //         //Process data rows. (rowIndex >= 1)
                        //         for (var colIndex = 0; colIndex < targetTableColCount; colIndex++) {
                        //             rowData += targetTable.rows.item(rowIndex).cells.item(colIndex).textContent.toLowerCase();
                        //         }

                        //         //If search term is not found in row data
                        //         //then hide the row, else show
                        //         if (rowData.indexOf(searchText.toLowerCase()) == -1 )
                        //             targetTable.rows.item(rowIndex).style.display = 'none';
                        //         else
                        //             targetTable.rows.item(rowIndex).style.display = 'table-row';
                        //      }
                        // }
                        $(function () {
                            $("#example").dataTable({
                                "sPaginationType": "full_numbers"
                            });
                        });

                        function checkAll(ele) {
                            var checkboxes = document.getElementsByTagName('input');
                            if (ele.checked) {
                                for (var i = 0; i < checkboxes.length; i++) {
                                    if (checkboxes[i].type == 'checkbox') {
                                        checkboxes[i].checked = true;
                                    }
                                }
                            } else {
                                for (var i = 0; i < checkboxes.length; i++) {
                                    console.log(i)
                                    if (checkboxes[i].type == 'checkbox') {
                                        checkboxes[i].checked = false;
                                    }
                                }
                            }
                        }
                    </script>
</body>
</html>