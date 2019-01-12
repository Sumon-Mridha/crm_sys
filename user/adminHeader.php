<?php 
  include '../Session.php';
  $sna= new Session();
  $sna->init();
    if(isset($_SESSION["is_Admin"]) && ($_SESSION["is_Admin"] == "IS_ACTIVE")){
        $sna->adminPageLoad();
    }
    else{
      header('location:../index.php');
    }
  
  include '../Core.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <?php SetTitle("User"); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <!-- <link rel="shortcut icon" href="assets/images/favicon.ico"> -->
        <!-- Plugins css-->
        <link href="../assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />
        <link href="../assets/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" />
        <link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="../assets/plugins/switchery/switchery.min.css">
        <!-- Data Table -->
        
        <link href="../assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
         <!-- Responsive datatable examples -->
        <link href="../assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />       
        <!-- App css -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/metismenu.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/css/style.css" rel="stylesheet" type="text/css" />
        <script src="../assets/js/modernizr.min.js"></script>

        <!-- text editor plugins -->
        <script src="https://cdn.ckeditor.com/ckeditor5/11.1.0/classic/ckeditor.js"></script>
        <!-- jquery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
         <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>


    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">

                    <a href="../index.php"><h2 style="color: white; font-size: 30px;"><strong>CRM SYSTEM</strong></h2></a>
                </div>

                <nav class="navbar-custom">

                    <ul class="list-inline float-right mb-0">


                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <img src="../assets/images/profile.png" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                                <!-- item-->
                                <!-- <div class="dropdown-item noti-title"> -->
                                    <a href="myProfile.php" class="dropdown-item notify-item">
                                        <i class="mdi mdi-account-circle"></i><small><span><?php echo $_SESSION["fname"];?></span></small>
                                    </a>
                                <!-- item-->
                                <a href="../logout.php" class="dropdown-item notify-item">
                                    <i class="mdi mdi-power"></i> <small><span>Logout</span></small>
                                </a>

                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="dripicons-menu"></i>
                            </button>
                        </li>
<!--                         <li class="hide-phone app-search">
                            <form role="search" class="">
                                <input type="text" placeholder="Search..." class="form-control">
                                <a href=""><i class="fa fa-search"></i></a>
                            </form>
                        </li> -->
                    </ul>

                </nav>

            </div>
            <!-- Top Bar End -->
            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="slimscroll-menu " id="remove-scroll">
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li>
                                <a href="adminDashboard.php">
                                    <i class="fi-air-play"></i><span> DASHBOARD </span>
                                </a>
                            </li>
                            <li>
                                <a href="customer.php"><i class="mdi mdi-account-multiple-outline"></i> <span> CUSTOMERS </span></a>
                            </li>
                            <li>
                                <a href="leads.php"><i class="mdi mdi-account-star"></i> <span> LEADS </span></a>
                            </li>
                            <li>
                                <a href="javascript: void(0);"><i class="mdi mdi-trending-up"></i> <span> SALES </span> <span class="menu-arrow"></span></a>
                                    <ul class="nav-second-level" aria-expanded="false">
                                        <li><a href="productSale.php">Product Sales</a></li>
                                        <li><a href="Proposal.php">Proposals</a></li>
                                        <li><a href="invoicePage.php">Invoice</a></li>
                                    </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="mdi mdi-package-variant"></i> <span> PRODUCTS </span> <span class="menu-arrow"></span></a>
                                    <ul class="nav-second-level" aria-expanded="false">                                        
                                        <li><a href="customerWiseProduct.php">Customer wise Products</a></li>
                                        <li><a href="products.php">All Poducts</a></li>
                                    </ul>
                            </li>

<?php if(isset($_SESSION["is_Admin"]) && ($_SESSION["is_Admin"] == "IS_ACTIVE")){ ?>
                            <li>
                                <a href="users.php"><i class=" mdi mdi-account-circle"></i> <span> USERS </span></a>
                            </li>

                            <li>
                                <a href="expenditure.php"><i class="fi-paper"></i> <span> EXPENDITURE </span></a>
                            </li>

                            <li>
                                <a href="tickets.php"><i class="mdi mdi-cards"></i> <span> TICKETS </span></a>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class=" mdi mdi-chart-areaspline"></i> <span> REPORTS </span> <span class="menu-arrow"></span></a>
                                    <ul class="nav-second-level" aria-expanded="false">                                        
                                        <li><a href="productexpense.php">Product wise Expense</a></li>
                                        <li><a href="customerincome.php">Customer wise Sale</a></li>
                                        <li><a href="saleReport.php">Product wise Sales</a></li>
                                        <li><a href="leadreport.php">Lead to Customer</a></li>
                                    </ul>
                            </li>

                            <li>
                                <a href="setup.php"><i class="icon-settings"></i> <span> SETUP </span></a>
                            </li>
<?php } ?>

                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->