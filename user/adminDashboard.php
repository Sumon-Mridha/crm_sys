<?php 
include 'adminHeader.php';
include '../allList.php';
date_default_timezone_set('Asia/Dhaka');
$date = date('Y-m');
$date = $date.'%';
$obj = new newList();
$sql ="SELECT SUM(cost) inc FROM customerproduct_tb WHERE cpdatetime LIKE '$date'";
$inc = $obj->limitOne($sql);

$sql ="SELECT SUM(tc) exp FROM customerinfo_tb b INNER JOIN (SELECT p.productName,a.* FROM product_tb p INNER JOIN (SELECT c.customerId,c.productId,c.cpdatetime,cs.* FROM customerproduct_tb c INNER JOIN (SELECT cpId,SUM(cost) tc,SUM(hours) th FROM expenditure_tb GROUP BY cpId) cs ON c.cpId=cs.cpId) a ON p.productId=a.productId) x ON b.customId=x.customerId WHERE x.cpdatetime LIKE '$date'";
$exp = $obj->limitOne($sql);

$sql ="SELECT COUNT(tc) ps FROM customerinfo_tb b INNER JOIN (SELECT p.productName,a.* FROM product_tb p INNER JOIN (SELECT c.customerId,c.productId,c.cpdatetime,cs.* FROM customerproduct_tb c INNER JOIN (SELECT cpId,SUM(cost) tc,SUM(hours) th FROM expenditure_tb GROUP BY cpId) cs ON c.cpId=cs.cpId) a ON p.productId=a.productId) x ON b.customId=x.customerId WHERE x.cpdatetime LIKE '$date'";
$ps = $obj->limitOne($sql);

$sql ="SELECT COUNT(customId) nc FROM customerinfo_tb c WHERE c.cdatetime LIKE '$date'";
$nc = $obj->limitOne($sql);

$sql ="SELECT COUNT(leadId) nl FROM leadinfo_tb c WHERE c.ldatetime LIKE '$date'";
$nl = $obj->limitOne($sql);

$sql ="SELECT COUNT(customId) ltoc FROM customerinfo_tb c WHERE c.cdatetime LIKE '$date' AND LtoC = 1";
$ltoc = $obj->limitOne($sql);

$sql ="SELECT COUNT(proposalId) np FROM proposal_tb  WHERE pdatetime LIKE '$date'";
$np = $obj->limitOne($sql);

$sql ="SELECT COUNT(id) ins FROM invoicelist_tb i WHERE i.datetime LIKE '$date'";
$ins = $obj->limitOne($sql);

$sql ="SELECT COUNT(tId) ts FROM ticketlist_tb i WHERE i.datetime LIKE '$date'";
$ts = $obj->limitOne($sql);

$sql ="SELECT COUNT(tId) ts FROM ticketlist_tb i WHERE i.datetime LIKE '$date' AND i.status = 'Queued'";
$ts = $obj->limitOne($sql);
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
                                    <h4 class="page-title float-left">Dashboard</h4>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                        <div class="row">

                            <div class="col-xl-4 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <i class="mdi  icon-basket-loaded widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Total Income</p>
                                        <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup"><?php
                                        if($inc["inc"]==null)
                                            echo '&#2547; 0';
                                        else
                                            echo '&#2547; '.$inc["inc"]; 
                                        ?></span></h2>
                                        <p class="m-0"><?php echo date('Y-M'); ?></p>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-4 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <i class="mdi  icon-basket widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Total Expense</p>
                                        <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup"><?php
                                        if($exp["exp"] == null)
                                            echo '&#2547; 0';
                                        else
                                            echo '&#2547; '.$exp["exp"]; 
                                        ?></span></h2>
                                        <p class="m-0"><?php echo date('Y-M');?></p>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-4 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <i class="mdi mdi-crown widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Number of Product Sold</p>
                                        <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup"><?php
                                        if($ps["ps"]==null)
                                            echo 0;
                                        else
                                            echo $ps["ps"]; 
                                        ?></span></h2>
                                        <p class="m-0"><?php echo date('Y-M'); ?></p>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-4 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <i class="mdi mdi mdi-account-multiple-plus widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">New Customers Added</p>
                                        <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup"><?php
                                        if($nc["nc"]==null)
                                            echo 0;
                                        else
                                            echo $nc["nc"]; 
                                        ?></span></h2>
                                        <p class="m-0"><?php echo date('Y-M'); ?></p>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-4 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <i class="mdi mdi mdi-account-check widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">New Leads Added</p>
                                        <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup"><?php
                                        if($nl["nl"]==null)
                                            echo 0;
                                        else
                                            echo $nl["nl"]; 
                                        ?></span></h2>
                                        <p class="m-0"><?php echo date('Y-M'); ?></p>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-4 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <i class="mdi mdi mdi-account-switch widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Lead to Customer</p>
                                        <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup"><?php
                                        if($ltoc["ltoc"]==null)
                                            echo 0;
                                        else
                                            echo $ltoc["ltoc"]; 
                                        ?></span></h2>
                                        <p class="m-0"><?php echo date('Y-M'); ?></p>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-4 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <i class="mdi pe-7s-next-2 widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Proposals Sent</p>
                                        <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup"><?php
                                        if($np["np"]==null)
                                            echo 0;
                                        else
                                            echo $np["np"]; 
                                        ?></span></h2>
                                        <p class="m-0"><?php echo date('Y-M'); ?></p>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-4 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <i class="mdi  mdi mdi-receipt widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Invoices Sent</p>
                                        <h2 class="font-600"><span><i class="mdi mdi-arrow-up"></i></span> <span data-plugin="counterup"><?php
                                        if($ins["ins"]==null)
                                            echo 0;
                                        else
                                            echo $ins["ins"]; 
                                        ?></span></h2>
                                        <p class="m-0"><?php echo date('Y-M'); ?></p>
                                    </div>
                                </div>
                            </div><!-- end col -->

                             <div class="col-xl-4 col-sm-6">
                                <div class="card-box widget-box-two widget-two-custom">
                                    <i class="mdi dripicons-archive widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Unanswered Tickets</p>
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
                                    <i class="mdi mdi-stackexchange widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-bold font-secondary text-overflow" title="Statistics">Tickets</p>
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


                        </div>
                        <!-- end row -->
                    </div> <!-- container -->

                </div> <!-- content -->
<?php include 'userFooter.php'; ?>