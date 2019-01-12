<?php 
include 'adminHeader.php';
include '../allList.php';
$obj=new newList();
$sql= "SELECT pn.productName,ps.* FROM product_tb pn INNER JOIN (SELECT productId, SUM(cost) total,COUNT(productId) numberofsales FROM customerproduct_tb GROUP BY productId) ps ON pn.productId = ps.productId";
$tkt1 = $obj->allSql($sql);
// $row=$obj->all("");
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
                                    <h4 class="page-title float-left">Product Sale vs Cost</h4>

                                    <ol class="breadcrumb float-right">
                                    
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->  
                        <div id="expenditure" class="card-box">
                            <div class="row m-t-20">
                                <div class="col-sm-12">
                                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                           <thead>
                                               <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Total Number of Sale</th>
                                                <th>Total Income</th>
                                           </thead>
                                           <tbody>
                                            <?php $cnt = 1;  foreach ($tkt1 as $key) { ?>
                                              <tr>
                                                 <td><?php echo $cnt; ?></td>
                                                 <td><?php echo $key["productName"]; ?></td>
                                                 <td><?php echo $key["numberofsales"]; ?></td>
                                                 <td><?php echo $key["total"]; ?></td>
                                            <?php $cnt++; } ?>
                                           </tbody>
                                       </table>
                                </div>
                            </div> 
                        </div>
                </div> <!-- container -->
            </div> <!-- content -->

<script type="text/javascript">
  function del(tid) {
    location.href='../delete.php?key=delt&tid='+tid;
  }

</script>
<?php
 include 'userFooter.php'; ?>
