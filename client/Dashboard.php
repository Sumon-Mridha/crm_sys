<?php 
  include '../Session.php';
  $sna = new Session();
  $sna->init();
    if(isset($_SESSION["is_Client"]) && ($_SESSION["is_Client"] == "IS_ACTIVE")){
        $sna->clientPageLoad();
        // header('location:../test.php');
    }
    else{
        // header('location:../test.php');
        header('location:../index.php');
    }
  include '../Core.php';
  include '../check.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8" />
        <?php SetTitle("Customer"); ?>
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

    </head>


    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <!-- <a href="index.html" class="logo">
                        <span>
                            <img src="assets/images/logo.png" alt="" height="25">
                        </span>
                        <i>
                            <img src="assets/images/logo_sm.png" alt="" height="28">
                        </i>
                    </a> -->
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
                                    <a href="Dashboard.php?page=myProfile" class="dropdown-item notify-item">
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
                                <a href="Dashboard.php">
                                    <i class="fi-air-play"></i><span> DASHBOARD </span>
                                </a>
                            </li>

                            <li>
                                <a href="Dashboard.php?page=products"><i class="mdi mdi-package-variant"></i> <span> PRODUCTS </span></a>
                            </li>

                            <li>
                                <a href="Dashboard.php?page=proposals"><i class="mdi mdi-script"></i> <span> PROPOSALS </span></a>
                            </li>

                            <li>
                                <a href="Dashboard.php?page=invoiceList"><i class="mdi mdi-receipt"></i> <span> INVOICES </span></a>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="mdi mdi-stackexchange"></i> <span> TICKETS </span> <span class="menu-arrow"></span></a>
                                    <ul class="nav-second-level" aria-expanded="false">
                                        <li><a href="Dashboard.php?page=openTicket">Open New Ticket</a></li>
                                        <li><a href="Dashboard.php?page=allTickets">All Tickets</a></li>
                                    </ul>
                            </li>
                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->
        </div>

<!-- start page here -->






<?php
if(isset($_GET['page'])){
    include ($_GET['page'].'.php'); 
}
else{
    include 'main.php';
}
?>




<!-- end of content -->

            <footer class="footer text-right">
                    CRM SYSTEM © ThemeLine Comunication.
            </footer>

        <!-- END wrapper -->
        <!-- jQuery  -->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/popper.min.js"></script><!-- Popper for Bootstrap -->
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/metisMenu.min.js"></script>
        <script src="../assets/js/waves.js"></script>
        <script src="../assets/js/jquery.slimscroll.js"></script>

        <script src="../assets/plugins/switchery/switchery.min.js"></script>
        <script src="../assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
        <script src="../assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/bootstrap-select/js/bootstrap-select.js" type="text/javascript"></script>
        <script src="../assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

        <script type="text/javascript" src="../assets/plugins/autocomplete/jquery.mockjax.js"></script>
        <script type="text/javascript" src="../assets/plugins/autocomplete/jquery.autocomplete.min.js"></script>
        <script type="text/javascript" src="../assets/plugins/autocomplete/countries.js"></script>
        <script type="text/javascript" src="../assets/pages/jquery.autocomplete.init.js"></script>

        <!-- Required datatable js -->
        <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="../assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="../assets/plugins/datatables/jszip.min.js"></script>
        <script src="../assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="../assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="../assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="../assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="../assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Init Js file -->
        <script type="text/javascript" src="../assets/pages/jquery.form-advanced.init.js"></script>

        <!-- App js -->
        <!-- <script src="../assets/js/jquery.core.js"></script> -->
        <script src="../assets/js/jquery.app.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: true,
                    buttons: [
                    {
                    extend: 'pdf',
                    text: 'Export as PDF'
                },

                    ]
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

        </script>

        <!--Wysiwig js-->
        <script src="../assets/plugins/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                if($("#desc").length > 0){
                    tinymce.init({
                        selector: "textarea#desc",
                        theme: "modern",
                        height:100,
                        plugins: [
                            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                            "save table contextmenu directionality emoticons template paste textcolor"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ",
                        style_formats: [
                            {title: 'Bold text', inline: 'b'},
                            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                            {title: 'Example 1', inline: 'span', classes: 'example1'},
                            {title: 'Example 2', inline: 'span', classes: 'example2'},
                            {title: 'Table styles'},
                            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                        ]
                    });
                }
            });
        </script>

        <!-- add more contact js -->
<script type="text/javascript">
        $(document).ready(function(){
            var x= 0;
            var html='<div class="row m-t-20"><legend><h6> New Contact <a id="remove" class="btn btn-danger btn-sm">X</a></h6></legend><div class="col-sm-6"><div class="form-group"><label for="conPerName">Name</label><input id="childname" type="text" class="form-control" placeholder="Full Name" name="cntPerName[]" required=""></div><div class="form-group"><label for="cell">Phone Number</label><input id="childcell" type="text" class="form-control" name="cntCell[]" required=""></div></div><div class="col-sm-6"><div class="form-group"><label for="aboutme">E-mail</label><input id="childmail" type="email" class="form-control" name="cntEmail[]" required=""></div><div class="form-group"><label>Linkdin</label><div class="input-group"><span class="input-group-addon"></span><input id="childurl" type="text" class="form-control" placeholder="Linkdin url" name="cntLin[]"></div></div></div></div>';
        
                $("#add").click(function() {
                    $("#container").append(html);  
                });

                $("#container").on('click','#remove',function(){
                    $(this).closest('div').remove();
                });

            });
</script>

</body>
</html>
<style type="text/css">
    
    a.btn.btn-secondary.buttons-pdf.buttons-html5 {
    margin-left: 30px;
    background-color: blueviolet;
    color: #fff;
    }

/*    .navbar-custom {
        background-color: #7bc0c7;
    }*/
    ul.list-inline.menu-left.mb-0 {
    display: none;
    }
</style>