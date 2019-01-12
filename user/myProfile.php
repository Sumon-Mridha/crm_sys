<?php 
include 'userHeader.php';
include '../allList.php';
$obj = new newList();
$sql = "SELECT c.companyName,u.* FROM companyinfo_tb c RIGHT JOIN user_tb u ON c.cmpId = u.companyId WHERE u.userId = :id";
$row = $obj->sqlFun($sql,':id',$_SESSION["userId"]);
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
                                    <h2 class="page-title float-left">My Profile</h2>

                                    <ol class="breadcrumb float-right">
                                    
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->  


                           
                        <div class="row card-box" id="cmpinfo">
                            <div class="col-sm-12">
                                <button class="btn btn-secondary pull-right" onclick="repass(1)">Reset Password</button>
                            </div>
                            <div class="col-sm-12">
                                <h3>About Me</h3>
                                <hr>
                            </div>
                            <div class="col-sm-6">
                               <h6>Name: <label ><?php echo $row["fullName"] ?></label></h6>
                            </div>
                            <div class="col-sm-6">
                                <h6>Designation: <label ><?php echo $row["designation"] ?></label></h6>
                            </div>
                            <div class="col-sm-6">
                                <h6>Cell: <label ><?php echo $row["cell"] ?></label></h6>
                            </div>
                            <div class="col-sm-6">
                                <h6>Email: <label ><?php echo $row["userName"] ?></label></h6>
                            </div>
                            <div class="col-sm-6">
                                <h6>Company: <label ><?php echo $row["companyName"] ?></label></h6>
                            </div>
                            <div class="col-sm-6">
                                <h6>Company ID: <label ><?php echo $row["idNumber"] ?></label></h6>
                            </div>
                            <div class="col-sm-6">
                                <h6>Added to the System: <label id="host1"><?php echo $row["datetime"] ?></label></h6>
                            </div>

                        </div>

                        <!-- end row -->
                        <form id="resetPass" action="../clientEntry.php" method="POST" style="display: none;">
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
                                    
                                    <button type="submit" id="resetPa" class="btn btn-success pull-right" name="resetPa" disabled>Save</button>
                                </div>
                            </div>
                        </form>





                </div> <!-- container -->
            </div> <!-- content -->
<script type="text/javascript">
    function repass(x) {
        switch(x){
            case 1:
                document.getElementById('resetPass').style.display = '';
                document.getElementById('cmpinfo').style.display = 'none';
                break;
            case 2:
                document.getElementById('resetPass').style.display = 'none';
                document.getElementById('cmpinfo').style.display = '';
                break;
            default:
                document.getElementById('resetPass').style.display = 'none';
                document.getElementById('cmpinfo').style.display = '';
        }
        
    }
    function check(pas) {
        var old = document.getElementById('op1').value;
        if(old!=pas && pas!=''){
            document.getElementById('er').style.display='';
            document.getElementById('resetPa').disabled = true;
        }
        if(old==pas){
            document.getElementById('er').style.display='none';
            document.getElementById('resetPa').disabled = false;
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
    label{
        font-size: 15px;
    }
    button{
        width: 185px;
    }
</style>
<?php 
include 'userFooter.php'; 
?>