<?php
date_default_timezone_set('Asia/Dhaka');
$date = date('Y-m');
$date = $date.'%';
$id = $_SESSION["userId"];
$obj = new newList();

$sql= "SELECT COUNT(p.proposalID) pr FROM proposal_tb p LEFT JOIN companyinfo_tb c ON p.companyId = c.cmpId WHERE p.customId = '$id' AND p.pdatetime LIKE '$date'";
$pr = $obj->limitOne($sql);

$sql = "SELECT COUNT(i.id) io FROM invoicelist_tb i WHERE i.invoTo ='$id' AND i.sendStatus = 1 AND i.datetime LIKE '$date'"; 
$io = $obj->limitOne($sql);

$sql= "SELECT COUNT(t.tId) ts FROM ticketlist_tb t LEFT JOIN customerproduct_tb c ON t.cpId = c.cpId WHERE c.customerId = '$id' AND NOT t.status = 'Closed' AND t.datetime LIKE '$date'";
$ts = $obj->limitOne($sql);

$sql= "SELECT COUNT(t.tId) tq FROM ticketlist_tb t LEFT JOIN customerproduct_tb c ON t.cpId = c.cpId WHERE c.customerId = '$id' AND t.status = 'Queued' AND t.datetime LIKE '$date'";
$tq = $obj->limitOne($sql);

$sql= "SELECT COUNT(t.tId) ta FROM ticketlist_tb t LEFT JOIN customerproduct_tb c ON t.cpId = c.cpId WHERE c.customerId = '$id' AND t.status = 'Answered' AND t.datetime LIKE '$date'";
$ta = $obj->limitOne($sql);

$sql= "SELECT COUNT(c.cpId) pro FROM customerproduct_tb c LEFT JOIN product_tb p ON c.productId = p.productId WHERE c.customerId = '$id' AND p.productDate LIKE '$date'";
$pro = $obj->limitOne($sql);
?>

 <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                  <div class="row m-t-20">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4">
                                      <!-- <label><font size="6">My Support Tickets</font></label> -->
                                    </div>
                                    <div class="col-sm-4"></div>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->  

                        <div class="row">
                            <div class="col-xl-4 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <i class="mdi dripicons-document widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Total Proposal</p>
                                        <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup"><?php
                                        if($pr["pr"]==null)
                                            echo 0;
                                        else
                                            echo $pr["pr"]; 
                                        ?></span></h2>
                                        <p class="m-0"><?php echo date('Y-M'); ?></p>
                                    </div>
                                </div>
                            </div><!-- end col -->

                             <div class="col-xl-4 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <i class="mdi dripicons-ticket widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Open Tickets</p>
                                        <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup"><?php
                                        if($ts["ts"]==null)
                                            echo 0;
                                        else
                                            echo $ts["ts"]; 
                                        ?></span></h2>
                                        <p class="m-0"><?php echo date('Y-M'); ?></p>
                                    </div>
                                </div>
                            </div><!-- end col -->

                             <div class="col-xl-4 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <i class="mdi dripicons-archive widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Queued Tickets</p>
                                        <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup"><?php
                                        if($tq["tq"]==null)
                                            echo 0;
                                        else
                                            echo $tq["tq"]; 
                                        ?></span></h2>
                                        <p class="m-0"><?php echo date('Y-M'); ?></p>
                                    </div>
                                </div>
                            </div><!-- end col -->    

                             <div class="col-xl-4 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <i class="mdi dripicons-broadcast widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Answered Tickets</p>
                                        <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup"><?php
                                        if($ta["ta"]==null)
                                            echo 0;
                                        else
                                            echo $ta["ta"]; 
                                        ?></span></h2>
                                        <p class="m-0"><?php echo date('Y-M'); ?></p>
                                    </div>
                                </div>
                            </div><!-- end col -->   

                            <div class="col-xl-4 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <i class="mdi dripicons-clipboard widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Total Invoices</p>
                                        <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup"><?php
                                        if($io["io"]==null)
                                            echo 0;
                                        else
                                            echo $io["io"]; 
                                        ?></span></h2>
                                        <p class="m-0"><?php echo date('Y-M'); ?></p>
                                    </div>
                                </div>
                            </div><!-- end col -->   

                            <div class="col-xl-4 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <i class="mdi dripicons-wallet widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Total Products</p>
                                        <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup"><?php
                                        if($pro["pro"]==null)
                                            echo 0;
                                        else
                                            echo $pro["pro"]; 
                                        ?></span></h2>
                                        <p class="m-0"><?php echo date('Y-M'); ?></p>
                                    </div>
                                </div>
                            </div><!-- end col -->                        

                </div> <!-- container -->
            </div> <!-- content -->

<style type="text/css">
  .dt-buttons.btn-group {
    display: none;
}
</style>
