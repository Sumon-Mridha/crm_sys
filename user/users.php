<?php
include 'adminHeader.php';
include '../allList.php';

//getting user information
$obj = new newList();
$sql="SELECT u.userId,u.fullName,u.userName,u.cell,u.designation,u.idNumber,u.userType,c.companyName,c.companyName,u.datetime FROM user_tb u LEFT JOIN companyinfo_tb c ON u.companyId=c.cmpId ";
$user = $obj->allSql($sql);

//getting company information
    $cmp = $obj->all('companyinfo_tb');
 ?>





            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">

                        <!-- starting a new row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left">Users</h4>
                                    <ol class="breadcrumb float-right">
                                        <button type="button" class="btn btn-custom waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">Add New User</button>
                                    </ol>
                
                <!-- including user form -->
                                    <?php include 'userForm.php'; ?>
                
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-12">
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title"><b>User List</b></h4>

                                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>E-mail</th>
                                            <th>Cell</th>
                                            <th>Designation</th>
                                            <th>Compnay Id NO.</th>
                                            <th>Company</th>
                                            <th>User Type</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
<?php
foreach ($user as $key) {
?>
                                            <tr>
                                            <td><?php echo $key["fullName"]; ?></td>
                                            <td><?php echo $key["userName"]; ?></td>
                                            <td><?php echo $key["cell"]; ?></td>
                                            <td><?php echo $key["designation"]; ?></td>
                                            <td><?php echo $key["idNumber"]; ?></td>
                                            <td><?php echo $key["companyName"]; ?></td>
                                            <td><?php echo $key["userType"]; ?></td>
                                            <td><?php echo $key["datetime"]; ?></td>
                                            <td>
                                                <form action="customerInfo.php" method="POST">
                                                    <a class="btn btn-secondary btn-sm" onclick="go('.$key["userId"].')" style="width: 70px;" >Update</a>
                                                    <!-- <a class="btn btn-danger btn-sm" onclick="show('.$key["userId"].','."'".$key["fullName"]."'".')" data-toggle="modal" data-target="#exampleModal"  style="width: 70px;">Delete</a> -->

<?php 
if(isset($_SESSION["userId"]) && ($_SESSION["userId"] == $key["userId"])){
    echo '<button class="btn btn-danger btn-sm" style="width: 70px;" disabled>Delete</button>';                                    
 } 
else{
    echo '<a class="btn btn-danger btn-sm" onclick="show('.$key["userId"].','."'".$key["fullName"]."'".')" data-toggle="modal" data-target="#exampleModal"  style="width: 70px;">Delete</a>';
}
 ?>                                                    
                                                </form>

                                                
                                            </td>
                                            </tr>                                       
<?php
}
?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->



                    </div> <!-- container -->

                </div> <!-- content -->
<?php include 'userFooter.php';?>

<script type="text/javascript">
    function show(id,name){
       var x ='All the Information about <strong>'+name+'</strong> will be Deleted.';
        document.getElementById('showinfo').innerHTML = x;
        document.getElementById('uid').value= id;
    }
    function go(id) {
        console.log(id);
        var link = 'userUpdateForm.php?userid='+id;
        location.href = link;
    }
</script>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><font color="red">Warning....!!</font></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="showinfo"></p>
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="../delete.php" method="POST">
            <input type="hidden" id="uid" name="uid">
            <button type="submit" class="btn btn-primary" name="userDeleteButton">Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>
