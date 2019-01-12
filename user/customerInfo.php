<?php 
include 'userHeader.php';
include '../allList.php';
include '../inwordConv.php';
if(isset($_REQUEST["cmpID"]) && isset($_POST['customid'])){ 
    // echo  $_POST['Leadid']; 
    $obj = new newList();

    //getting customer and owner information
    $var="SELECT * FROM customerinfo_tb INNER JOIN user_tb ON customerinfo_tb.ownerId=user_tb.userId  WHERE customId = :id";
    $par=':id';
    $row = $obj->sqlFun($var,$par,$_POST['customid']);

    //getting contact information
    $var="SELECT * FROM contactinfo_tb  WHERE customerId = :id";
    $par=':id';
    $cont = $obj->Fun($var,$par,$_POST['customid']);

    //customer products
    $sql="SELECT * FROM (SELECT productId,cpdatetime FROM customerproduct_tb WHERE customerId = :id) x LEFT JOIN product_tb p ON x.productId = p.productId ";
    $par=':id';
    $products = $obj->Fun($sql,$par,$_POST['customid']);

    //all products
    $rows=$obj->all("product_tb");
}
if (isset($row)) {

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
                                    <h4 class="page-title float-left">Company Information</h4>

                                    <ol class="breadcrumb float-right">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" >Add New Product</button>
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="card-box">
                                    
                                    <div class="" style="font-size: 15px;">
                                      <div class="row m-t-20">
                                          <div class="col-sm-6">
                                            <div class="card m-b-30">
                                                <div class="card-header">
                                                    <legend> Company Info</legend>
                                                </div>
                                                <div class="card-body">
                                                    <blockquote class="card-bodyquote">
                                                      <center>
                                                        <h2 ><?php echo $row["cmpName"]; ?></h2>
                                                      </center>
                                                      <br>
                                                      <label >Cell :</label> <span><?php echo $row["cmpCell"]; ?> </span><br>
                                                      <label >E-mail :</label> <span><?php echo $row["cmpEmail"]; ?> </span><br>
                                                      <label >Address :</label> <span><?php echo $row["cmpAddress"]; ?> </span><br>
                                                      <label >Area :</label> <span><?php echo $row["cmpArea"]; ?> </span><br>
                                                      <label >WebSite :</label> <span><?php echo $row["cmpWeb"]; ?> </span><br>
                                                      <label >Yearly Revenue :</label> <span><?php echo $row["cmpYearlyRevenue"]; ?> </span><br>
                                                      <label >Year of Establishment :</label> <span><?php echo $row["cmpYearOfEst"]; ?> </span><br>
                                                      <label >Number of Employees :</label> <span><?php echo $row["cmpNumEmp"]; ?> </span><br>
                                                      <label >Payment Method :</label> <span><?php echo $row["cmpPayMethod"]; ?> </span><br><br><br>
                                                        <footer>
                                                        </footer>
                                                    </blockquote>
                                                </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-6">

                                            <div class="card m-b-30">
                                                <div class="card-header">
                                                    <legend>Contact Person Info</legend>
                                                </div>
                                                <div class="card-body">
                                                    <blockquote class="card-bodyquote">
<?php 
$cnt=1;
foreach ($cont as $key) {
  
?>  
                                                        <div class="card m-b-30">
                                                            <div class="card-body">
                                                              <center>
                                                                <h4>Contact Person: <?php echo trim(ucwords(numberToWord($cnt))); ?></h4> 
                                                              </center>
                                                              
                                                            <label >Name :</label> <span><?php echo $key["contactName"]; ?> </span><br>
                                                            <label >Cell :</label> <span><?php echo $key["contactCell"]; ?> </span><br>
                                                            <label >E-mail :</label> <span><?php echo $key["contactEmail"]; ?> </span><br>
                                                            <label >linkd In :</label> <span><?php echo $key["linkIn"]; ?> </span><br>    
                                                            </div>
                                                        </div>
<?php $cnt++; } ?>
                                                        <footer></footer>
                                                    </blockquote>
                                                </div>
                                            </div>
                                               <br><br>
                                          </div>
                                      </div>
                                      <div class="row m-t-20">
                                          <div class="col-sm-6">

                                            <div class="card m-b-30">
                                                <div class="card-header">
                                                   <legend>Reference Person Info</legend>
                                                </div>
                                                <div class="card-body">
                                                    <blockquote class="card-bodyquote">
                                                        <label >Name :</label> <span><?php echo $row["refName"]; ?> </span><br>
                                                        <label >Cell :</label> <span><?php echo $row["refCell"]; ?> </span><br>
                                                        <footer>
                                                        </footer>
                                                    </blockquote>
                                                </div>
                                            </div>
                                            <br><br>
                                          </div>
                                          <div class="col-sm-6">
                                            <div class="card m-b-30">
                                              <div class="card-header">
                                                 <legend>Owner info</legend>
                                              </div>
                                              <div class="card-body">
                                                  <blockquote class="card-bodyquote">
                                                      <label >Name</label> <span><?php echo $row["fullName"]; ?> </span><br>
                                                      <label >Cell :</label> <span><?php echo $row["cell"]; ?> </span><br>
                                                      <footer>
                                                      </footer>
                                                  </blockquote>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-12">
                                            <div class="card m-b-30">
                                              <div class="card-header">
                                                 <legend>Products</legend>
                                              </div>
                                              <div class="card-body">
                                                  <blockquote class="card-bodyquote">
                                                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                      <thead>
                                                      <tr>
                                                          <th>Name</th>
                                                          <th>Type</th>
                                                          <th>Description</th>
                                                          <th>Date</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
<?php 
foreach ($products as $key) {
?>
                                                          <tr>
                                                          <td><?php echo $key["productName"]; ?></td>
                                                          <td><?php echo $key["productType"]; ?></td>
                                                          <td><?php echo $key["description"]; ?></td>
                                                          <td><?php echo $key["cpdatetime"]; ?></td>
                                                          </tr>

                                                     
<?php } ?>


                                                      </tbody>
                                                  </table>




                                                      <footer>
                                                      </footer>
                                                  </blockquote>
                                              </div>
                                            </div>
                                          </div> 




                                      </div>
                                    </div>
                                </div>

                    </div> <!-- container -->

                </div> <!-- content -->

<?php 
}
include 'userFooter.php';


// if(isset($_SESSION["customDone"]) && $_SESSION["customDone"]=='yes' )
// {
//     echo '<script type="text/javascript"> window.alert("New Customer Added");</script>';
//     $_SESSION["customDone"]=null;
// }


?>


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Select Product</h4>
        </div>
        <form action="../clientEntry.php" method="POST">
            <div class="modal-body">

                <?php echo'<input type="hidden" name="cid" value="'.$row["customId"].'">'?>
                        <label for="numEmployee">Product</label>
                        <select class="selectpicker show-tick" name="product">
<?php 
 // var_dump($row);
foreach ($rows as $key) {
// var_dump($key);

?>
                        <?php echo'<option value="'.$key["productId"].'">'.$key["productName"].'</option>' ; ?>
                                      
<?php
}
?>                                       

                        </select>
                        <label>Product Title</label>
                        <input type="text" class="form-control" name="title" required>
                        <label>Cost</label>
                        <input type="number" class="form-control" name="cost" required>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" name="customToProd">Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>





<style type="text/css">
    legend{
        color: black;
        font-size: 20px;  
        !important;
    }
    label{
        color: gray;
    }

</style>