<?php 
include '../OAuth/Security.php';
$obj = new newList();
$sql= "SELECT * FROM invoicelist_tb  WHERE invoTo = :id AND sendStatus = 1 ORDER BY id DESC";
$pro = $obj->Fun($sql,':id',$_SESSION["userId"]);
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
                                      <label><font size="6">Open New Ticket</font></label>
                                    </div>
                                    <div class="col-sm-4"></div>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->  
                        <div id="product" class="card-box">
                            <div class="row m-t-20">
                                <div class="col-sm-12">
                                <table id="tb" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                           <thead>
                                               <tr>
                                                   <th>#</th>
                                                   <th>To Work</th>
                                                   <th>From</th>
                                                   <th>To</th>
                                                   <th>Serial</th>
                                                   <th>Cost</th>
                                                   <th>Date</th>
                                                   <th>Action</th>
                                               </tr>
                                           </thead>
                                           <tbody>
<?php 
$cnt = 1;
foreach ($pro as $key) {
?>
                                            <tr>
                                                <td><?php echo $cnt ?></td>
                                                <td><?php echo $key["toWork"]; ?></td>
<?php 
        $sql="SELECT * FROM companyinfo_tb WHERE cmpId = :id";
        $par =":id";
        $id = $key["invoFrom"];
        $cohr = $obj->sqlFun($sql,$par,$id);
 ?>
                                                <td><?php echo $cohr["companyName"]; ?></td>
<?php 
        $sql="SELECT * FROM customerinfo_tb WHERE customId = :id";
        $par =":id";
        $id = $key["invoTo"];
        $cohr = $obj->sqlFun($sql,$par,$id);
 ?>
                                                <td><?php echo $cohr["cmpName"]; ?></td>
                                                <td><?php echo $key["invoSerial"]; ?></td>
<?php 
        $sql="SELECT SUM(quantity*unitCost) total FROM invoicesinfo_tb WHERE ILI = :id";
        $par =":id";
        $id = $key["id"];
        $cohr = $obj->sqlFun($sql,$par,$id);
 ?>
                                                <td><?php echo $cohr["total"]; ?></td>
                                                <td><?php echo $key["datetime"]; ?></td>
                                                <td>
                                                    <?php echo '<a href="invoice.php?new&ser='.scrypt(trim($key["invoSerial"])).'" class="btn btn-secondary btn-sm" target="_blank" style="width: 100px;">Open</a>'?>
                                                </td>
                                            </tr>
<?php
$cnt++; }
?>
                                           </tbody>
                                       </table>
                                </div>
                        </div>

                     </div>

                </div> <!-- container -->
            </div> <!-- content -->
<style type="text/css">
  .dt-buttons.btn-group {
    display: none;
}
</style>