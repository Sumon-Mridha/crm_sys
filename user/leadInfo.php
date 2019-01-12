<?php include 'userHeader.php';

include '../allList.php';
if(isset($_REQUEST["ID"]) && isset($_POST['Leadid'])){ 
// echo  $_POST['Leadid']; 
    $obj = new newList();
//getting customer and user information
    $var="SELECT * FROM leadinfo_tb INNER JOIN user_tb ON leadinfo_tb.ownerId=user_tb.userId  WHERE leadId = :id";
    $par=':id';
    $row = $obj->sqlFun($var,$par,$_POST['Leadid']);
//getting contact informatoin
    $var="SELECT * FROM contactinfo_tb  WHERE leadId = :id";
    $par=':id';
    $cont = $obj->Fun($var,$par,$_POST['Leadid']);

    $rows=$obj->all("product_tb");
}
else
    header('location:leadInfo.php');


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
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" >Creat as Customer</button>
                                    </ol>

                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    <div class="card-box">
                        <?php //var_dump($row) ?>
                                    
                                    <div class="" style="font-size: 15px;">
                                      <div class="row m-t-20">
                                          <div class="col-sm-6">

                                            <div class="card m-b-30">
                                                <div class="card-header">
                                                    <legend> Company Info</legend>
                                                </div>
                                                <div class="card-body">
                                                    <blockquote class="card-bodyquote">
                                                      <h2 ><?php echo $row["cmpName"]; ?></h2>
                                                      <label >Cell :</label> <span><?php echo $row["cmpCell"]; ?> </span><br>
                                                      <label >E-mail :</label> <span><?php echo $row["cmpEmail"]; ?> </span><br>
                                                      <label >Address :</label> <span><?php echo $row["cmpAddress"]; ?> </span><br>
                                                      <label >Area :</label> <span><?php echo $row["cmpArea"]; ?> </span><br>
                                                      <label >WebSite :</label> <span><?php echo $row["cmpWeb"]; ?> </span><br>
                                                      <label >Yearly Revenue :</label> <span><?php echo $row["cmpYearlyRevenue"]; ?> </span><br>
                                                      <label >Year of Establishment :</label> <span><?php echo $row["cmpYearOfEst"]; ?> </span><br>
                                                      <label >Number of Employees :</label> <span><?php echo $row["cmpNumEmp"]; ?> </span><br>
                                                      <label >Payment Method :</label> <span><?php echo $row["cmpPayMethod"]; ?> </span><br>
                                                      <label >Tags :</label> <span><?php echo $row["tag"]; ?> </span><br>
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
                                                            <h4>Contact Person: <?php echo $cnt; ?></h4> 
                                                            <label >Name :</label> <span><?php echo $key["contactName"]; ?> </span><br>
                                                            <label >Cell :</label> <span><?php echo $key["contactCell"]; ?> </span><br>
                                                            <label >E-mail :</label> <span><?php echo $key["contactEmail"]; ?> </span><br>
                                                            <label >linkd In :</label> <span><?php echo $key["linkIn"]; ?> </span><br>    
                                                            </div>
                                                        </div>
<?php $cnt++;} ?>
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
                                      </div>
                                    </div>
                                </div>

                    </div> <!-- container -->

                </div> <!-- content -->

<?php include 'userFooter.php';


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

                <?php echo'<input type="hidden" name="ldid" value="'.$row["leadId"].'">'?>
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
                <button type="submit" class="btn btn-success" name="leadToCutom">Save as Customer</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>





<style type="text/css">
    legend{
        color: black;
        font-size: 30px;  
        !important;
    }
    label{
        color: gray;
    }

</style>