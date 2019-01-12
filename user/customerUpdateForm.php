<?php 
if (isset($_GET['customerid'])){
    $cId = $_GET['customerid'];
    include 'adminHeader.php';
    include '../allList.php';
    $obj = new newList();
    $var="SELECT * FROM customerinfo_tb  WHERE customId = :id";
    $par=':id';
    $row = $obj->sqlFun($var,$par,$cId);
//getting contact information
    $var="SELECT * FROM contactinfo_tb  WHERE customerId = :id";
    $par=':id';
    $cont = $obj->Fun($var,$par,$cId);
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
                                    <h4 class="page-title float-left">Customer Update Form</h4>
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
                                    <form id="default-wizard" action="../adminControl.php" method="POST">
                                        <fieldset >
                                            <input type="hidden" name="cusID" value="<?php echo $row["customId"]; ?>">
                                             <div class="modal-header">
                                                   <legend>Company Information</legend>
                                            </div>
                                            
                                            <div class="row m-t-20">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="companyName">Company Name</label>
                                                        <input type="text" class="form-control" placeholder="" name="cmpName" required="" value="<?php echo $row["cmpName"]; ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="aboutme" >Contact</label>
                                                        <input type="text" class="form-control" name="cmpCell" required="" value="<?php echo $row["cmpCell"]; ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="aboutme" >E-mail</label>
                                                        <input type="email" class="form-control" name="cmpEmail" required="" value="<?php echo $row["cmpEmail"]; ?>"> 
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <textarea class="form-control" rows="6" name="cmpAddress" required=""><?php echo $row["cmpAddress"]; ?></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="area">Area</label>
                                                        <input type="text" class="form-control" placeholder="City" name="cmpArea" required="" value="<?php echo $row["cmpArea"]; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="revenue">Yearly Revenue</label>
                                                        <input type="text" class="form-control" placeholder="" name="cmpRevenue" required="" value="<?php echo $row["cmpYearlyRevenue"]; ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="establishment">Year of Establishment</label>
                                                        <input type="text" class="form-control" placeholder="" name="cmpEstablishment"
                                                        value="<?php echo $row["cmpYearOfEst"]; ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="numEmployee">Number of Employees</label>
                                                        <input type="text" class="form-control" placeholder="" name="numEmployee" value="<?php echo $row["cmpNumEmp"]; ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="numEmployee">Payment Method</label>
                                                        <select id="slt" class="selectpicker show-tick" name="payMethod">
                                                            <option value="<?php echo $row["cmpPayMethod"]; ?>" selected><?php echo $row["cmpPayMethod"]; ?></option>
                                                            <option value="Monthly" >Monthly</option>
                                                            <option value="Ad Hoc">Ad Hoc</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="webAddress">Web Address</label>
                                                        <input type="text" class="form-control"placeholder="" name="cmpWeb" required="" value="<?php echo $row["cmpWeb"]; ?>">
                                                    </div>
                                                </div>
                                            </div>


                                        <div class="row m-t-20">
                                            <div class="col-sm-12">
                                            <div class="card m-b-30">
                                                <div class="card-header">
                                                    <legend>Contact Person Info</legend>
                                                </div>
                                                <div class="card-body">
                                                    
                                                    <blockquote class="card-bodyquote">
<?php 
$cnt=0;
$contId = array();
foreach ($cont as $key) {
    $cntId[$cnt] = $key["contactId"];
?>  


                                             <div class="modal-header">
                                                   <legend>Contact Person: <?php echo $cnt+1; ?> </legend>
                                            </div>
                                            
                                            <div class="row m-t-20">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="conPerName">Name</label>
                                                            <input id="name" type="text" class="form-control" placeholder="Full Name" name="<?php echo 'cntPerName'.$cnt; ?>" required="" value="<?php echo $key["contactName"]; ?>">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="cell">Phone Number</label>
                                                            <input id="cell" type="text" class="form-control" name="<?php echo 'cntCell'.$cnt; ?>" required="" value="<?php echo $key["contactCell"]; ?>">
                                                        </div>


                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="aboutme">E-mail</label>
                                                            <input id="mail" type="email" class="form-control" name="<?php echo 'cntEmail'.$cnt; ?>" required="" value="<?php echo $key["contactEmail"]; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Linkdin</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input id="url" type="text" class="form-control" placeholder="Linkdin url" name="<?php echo 'cntLin'.$cnt; ?>" value="<?php echo $key["linkIn"]; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
<?php $cnt++; }
$_SESSION["tracker"] = $cntId;
?>
                                                        <footer></footer>
                                                    </blockquote>
                                                    
                                                </div>
                                            </div>
                                               <br><br>
                                          </div>
                                        </div>

                                             <div class="modal-header">
                                                    <legend>Reference</legend>
                                            </div>
                                            <div class="row m-t-20">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="conPerName">Name</label>
                                                        <input type="text" class="form-control" placeholder="Full Name" name="refPerName" required="" value="<?php echo $row["refName"]; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                   <div class="form-group">
                                                        <label for="cell">Phone Number</label>
                                                        <input type="text" class="form-control" name="refCell" required="" value="<?php echo $row["refCell"]; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="row m-t-20">
                                            <div class="col-sm-10"></div>
                                            <div class="col-sm-1">
                                               <button type="submit" class="btn btn-success stepy-finish" name="customerInofUpdate">Update</button> 
                                            </div>
                                            <div class="col-sm-1">                    
                                                <a href="customer.php" class="btn btn-danger stepy-finish" name="btn">Close</a>
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