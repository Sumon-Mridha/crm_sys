<?php 
include '../inwordConv.php';
    $obj = new newList();
    //getting customer and owner information
    $var="SELECT c.*,u.fullName,u.cell FROM customerinfo_tb c INNER JOIN user_tb u ON c.ownerId=u.userId WHERE customId = :id";
    $par=':id';
    $row = $obj->sqlFun($var,$par,$_SESSION["userId"]);

    //getting contact information
    $var="SELECT * FROM contactinfo_tb  WHERE customerId = :id";
    $par=':id';
    $cont = $obj->Fun($var,$par,$_SESSION["userId"]);
    include '../OAuth/Security.php';
    $pass = scrypt($row["userPassword"],'D');

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
                                    <h2 class="page-title float-left">Company Profile</h2>

                                    <ol class="breadcrumb float-right">
                                        <div class="col-sm-12">
                                            <button id="btnre" class="btn btn-secondary pull-right" onclick="repass(1)">Reset Password</button>
                                        </div>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->  
                            <div class="card-box" id="cmpinfo">
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

                                      </div>
                                    </div>
                                </div>
                        <form id="resetPass" action="../clientControl.php" method="POST" style="display: none;">
                            <div class="row card-box">
                                <div class="col-sm-12">
                                    <h2>Reset Password</h2><br>
                                    <hr>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label>Old Password: </label>
                                    <b id="er" style="color: red; display: none;">Password is not Correct...!</b>
                                    <input type="hidden" id="op1" value="<?php echo $pass ?>">
                                    <input type="password" id="op2" onblur="check(this.value)" class="form-control" name="signame" placeholder="Password" required >
                                </div>
                                <div class="col-sm-6">
                                </div>
                                <div class="col-sm-6">
                                    <label>New password: </label>
                                    <input type="password" id="p1" class="form-control" name="pass" placeholder="Password" required >
                                </div>
                                <div class="col-sm-6">
                                    <label>Confirm New password: </label>
                                    <b id="er2" style="color: red; display: none;">Password didn't Match...!</b>
                                    <input type="password" id="p2" onblur="check2(this.value)" class="form-control" name="signame" placeholder="Password" required >
                                </div>
                                <div class="col-sm-12">
                                    <br>
                                    <a onclick="repass(2)" class="btn btn-danger pull-right" style="width: 185px;">Close</a>
                                    
                                    <button type="submit" id="resetPa" class="btn btn-success pull-right" style="width: 185px;" name="resetPa" disabled>Save</button>
                                </div>
                            </div>
                        </form>

                    </div> <!-- container -->

                </div> <!-- content -->
            </div>

<script type="text/javascript">
    function repass(x) {
        switch(x){
            case 1:
                document.getElementById('resetPass').style.display = '';
                document.getElementById('cmpinfo').style.display = 'none';
                document.getElementById('btnre').style.display = 'none';
                break;
            case 2:
                document.getElementById('resetPass').style.display = 'none';
                document.getElementById('cmpinfo').style.display = '';
                document.getElementById('btnre').style.display = '';
                break;
            default:
                document.getElementById('resetPass').style.display = 'none';
                document.getElementById('cmpinfo').style.display = '';
                document.getElementById('btnre').style.display = '';
        }
        
    }
    function check(pas) {
        var old = document.getElementById('op1').value;
        if(pas!=''){
            if (old!=pas) {
                document.getElementById('er').style.display='';
            }
            else{
            document.getElementById('er').style.display='none';
            document.getElementById('resetPa').disabled = false;
            }
        }
        
    }
    function check2(x) {
        var y = document.getElementById('p1').value;
        if (x==y) {
            document.getElementById('er2').style.display='none';
        } else {
            document.getElementById('er2').style.display='';
        }
    }
</script>

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