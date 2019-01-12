<?php 
include 'adminHeader.php';
include '../allList.php';
$obj=new newList();
$sql= "SELECT b.cmpName,x.* FROM customerinfo_tb b INNER JOIN (SELECT p.productName,a.* FROM product_tb p INNER JOIN (SELECT c.customerId,c.productId,c.cpdatetime,cs.* FROM customerproduct_tb c INNER JOIN (SELECT cpId,SUM(cost) tc,SUM(hours) th FROM expenditure_tb GROUP BY cpId) cs ON c.cpId=cs.cpId) a ON p.productId=a.productId) x ON b.customId=x.customerId";
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
                                                <th>Customer Name</th>
                                                <th>Product Name</th>
                                                <th>Total Hours</th>
                                                <th>Total Expense</th>
                                                <th>Date</th>
                                           </thead>
                                           <tbody>
                                            <?php $cnt = 1;  foreach ($tkt1 as $key) { ?>
                                              <tr>
                                                 <td><?php echo $cnt; ?></td>
                                                 <td><?php echo $key["cmpName"]; ?></td>
                                                 <td><?php echo $key["productName"]; ?></td>
                                                 <td><?php echo $key["th"]; ?></td>
                                                 <td><?php echo $key["tc"]; ?></td>
                                                 <td><?php
                                                    $date = explode(' ', $key["cpdatetime"]); 
                                                    echo $date[0];
                                                  ?></td>
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
