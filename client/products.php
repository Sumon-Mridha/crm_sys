<?php 
$cust_product = new newList();
$sql= "SELECT * FROM customerproduct_tb c LEFT JOIN product_tb p ON c.productId = p.productId WHERE c.customerId = :id";
$pro = $cust_product->Fun($sql,':id',$_SESSION["userId"]);
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
                                      <label><font size="6">PRODUCTS</font></label>
                                    </div>
                                    <div class="col-sm-4"></div>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->  

                        <div class="card-box">

                            <div class="row m-t-20">
                                <div class="col-sm-12">
                                       <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                           <thead>
                                               <tr>
                                                <th>No.</th>
                                                <th>Product Name</th>
                                                <th>Detail</th>
                                                <th>Product type</th>
                                                <th>Date</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                            <?php $cnt = 1;  foreach ($pro as $key) { ?>
                                              <tr>
                                                 <td><?php echo $cnt; ?></td>
                                                 <td><?php echo $key["productName"]; ?></td>
                                                 <td><?php echo $key["description"]; ?></td>
                                                 <td><?php echo $key["productType"]; ?></td>
                                                 <td><?php  $date = explode(' ', $key["cpdatetime"]); echo $date[0]; ?></td>
                                               </tr>
                                            <?php $cnt++; } ?>
                                           </tbody>
                                       </table>
                                </div>
                        </div>

                     </div>
                </div> <!-- container -->
            </div> <!-- content -->