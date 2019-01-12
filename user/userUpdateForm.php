<?php 
if (isset($_GET['userid'])){
$uid = $_GET['userid'];
include 'adminHeader.php';
include '../allList.php';
$obj = new newList();
//getting company information
	$cmp = $obj->all('companyinfo_tb');
//getting contact informatoin
$sql="SELECT u.userId,u.fullName,u.userName,u.userType,u.cell,u.designation,u.idNumber,u.companyId,c.companyName,u.datetime FROM user_tb u INNER JOIN companyinfo_tb c ON u.companyId=c.cmpId WHERE u.userId = :uid ";
$par = ':uid';
$user = $obj->sqlFun($sql,$par,$uid);
// var_dump($user);
// var_dump($user["userType"]);
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
                                    <h4 class="page-title float-left">User Update Form</h4>
                                    <div class="clearfix">
                                    	
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>
                <div class="card-box">
                    <div class="container-fluid">
                            <div class="row m-t-20">
                                <div class="col-sm-12">

                                    <form id="default-wizard"  action="../adminControl.php" method="POST">
                                      <div class="modal-body">

                                        <fieldset>
                                                <div class="modal-header">
                                                    <legend>User Information</legend>
                                                </div>
                                            <div class="row m-t-20">
                                                <div class="col-sm-4"></div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <input type="hidden" name="userid" value="<?php echo $user["userId"]?>">
                                                        <label for="numEmployee">User Type</label>
                                                        <select id="slt" class="selectpicker show-tick" name="type">
							<?php echo'<option value="'.$user["userType"].'" >'.$user["userType"].'</option>'; ?>
                                                            <option value="User">User</option>
                                                            <option value="Admin">Admin</option>
                                                        </select>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-4"></div>
                                            </div>


                                            <div class="row m-t-20">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="companyName">Full Name</label>
                                                        <input type="text" class="form-control" placeholder="" name="fName" value="<?php echo $user["fullName"] ?>" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="numEmployee">Designation</label>
                                                        <select id="slt" class="selectpicker show-tick" name="designation">
                            <?php echo'<option value="'.$user["designation"].'" >'.$user["designation"].'</option>'; ?>
                                                            <option value="Chairman">Chairman</option>
                                                            <option value="CEO">CEO</option>
                                                            <option value="Production Manager">Production Manager</option>
                                                            <option value="Project Manager">Project Manager</option>
                                                            <option value="Creative Head">Creative Head</option>
                                                            <option value="Software Engineer">Software Engineer</option>
                                                            <option value="Sr. Developer">Sr. Developer</option>
                                                            <option value="Jr. Developer">Jr. Developer</option>
                                                            <option value="Intern">Intern</option>
                                                            <option value="Sr. Designer">Sr. Designer</option>
                                                            <option value="Creative Executive">Creative Executive</option>
                                                            <option value="Business Development Executive">Business Development Executive</option>
                                                            <option value="Sales Executive">Sales Executive</option>
                                                            <option value="Sr. Sales Executive">Sr. Sales Executive</option>
                                                            <option value="Jr. Sales Executive">Jr. Sales Executive</option>
                                                        </select>
                                                    </div> 

                                                    <div class="form-group">
                                                        <label for="companyName">Cell</label>
                                                        <input type="text" class="form-control" placeholder="" name="cell" value="<?php echo $user["cell"] ?>" required>
                                                    </div>


                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="companyName">E-mail</label>
                                                        <input type="email" class="form-control" placeholder="" name="mail" value="<?php echo $user["userName"] ?>" required>
                                                    </div>
                                                     <div class="form-group">
                                                        <label for="numEmployee">Company Name</label>
                                                        <select id="slt" class="selectpicker show-tick" name="cmpId">
                            <?php echo'<option value="'.$user["companyId"].'" >'.$user["companyName"].'</option>'; ?>
<?php foreach ($cmp as $key2) {?> 
                            <?php echo'<option value="'.$key2["cmpId"].'" >'.$key2["companyName"].'</option>'; ?>
<?php } ?>
                                                        </select>
                                                    </div>  
                                                    <div class="form-group">
                                                        <label for="address">Company ID</label>
                                                        <input type="text" class="form-control" placeholder="" name="id" value="<?php echo $user["idNumber"] ?>" required>
                                                    </div>                                                                                                
                                                </div>
                                            </div>


                                        </fieldset>

                                       <div class="modal-footer">              
                                                <a href="users.php" class="btn btn-danger stepy-finish" name="btn">Close</a>
                                                <button type="submit" class="btn btn-info waves-effect waves-light" name="userUpdateForm">Update</button>
                                       </div>
                                     </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

<?php 
include 'userFooter.php';
}
else{
    // echo "hi";
    header('location:../index.php');
} ?>

<script type="text/javascript">
var map = {};
$('#slt option').each(function () {
    if (map[this.value]) {
        $(this).remove()
    }
    map[this.value] = true;
})
</script>