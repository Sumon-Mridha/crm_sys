<?php

if (isset($_GET['xkpnt']) && isset($_GET['exp'])) {
	if ($_GET['exp']=="true") {
		include 'adminHeader.php';
		include '../allList.php';
		$obj = new newList();
		$sql="SELECT * FROM expenditure_tb WHERE cpId = :id ORDER BY exId DESC";
		$par =":id";
		$id = $_GET['xkpnt'];
		$row = $obj->Fun($sql,$par,$id);

		$sql="SELECT SUM(hours) hr, SUM(cost) cst FROM expenditure_tb WHERE cpId = :id";
		$par =":id";
		$id = $_GET['xkpnt'];
		$cohr = $obj->sqlFun($sql,$par,$id);
    
		$sql="SELECT p.productName,c.cpdatetime,c.cost FROM product_tb p INNER JOIN customerproduct_tb c ON p.productId = c.productId WHERE c.cpId = :id";
		$par =":id";
		$id = $_GET['xkpnt'];
		$name = $obj->sqlFun($sql,$par,$id);
		$ar = explode(' ', $name["cpdatetime"])
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
                                    <h4 class="page-title float-left">Expenditure</h4>
                                    <ol class="breadcrumb float-right"> 
                                        <button id="add" class="btn btn-secondary" onclick="add()">Add Expenditure</button>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->  
                        <form id="addEx" action="../clientEntry.php" method="POST" style="display: none;">
                        	<a id="cls" onclick="clos()" class="btn btn-danger" style="float: right; border-radius: 10px;"><span aria-hidden="true">&times;</span></a>
                            <div class="row card-box">  
                            	<input type="hidden" name="cpId" value="<?php echo $_GET['xkpnt'] ?>"> 
                                <div class="col-sm-3">
                                   <input type="text" class="form-control" name="item" placeholder="Item" required >
                                </div>
                                <div class="col-sm-2">
                                	<input type="number" class="form-control" name="quantity" placeholder="Quantity" required >
                                </div>
                                <div class="col-sm-2">
                                	<input type="number" class="form-control" name="hours" placeholder="Hours" required >
                                </div>
                                <div class="col-sm-2">
                                	<input type="Date" id="datepicker" class="form-control " name="date" required >
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="cost" placeholder="Cost" required >
                                </div>
                                <div class="col-sm-1">
                                    <button type="submit" class="btn btn-success btn-sm" name="addExpenditure">Save</button>
                                </div>
                            </div>
                            
                        </form>

                        <div id="expenditure1" class="card-box">
                        <div class="row m-t-20">
                        	<div class="col-sm-11"></div>
                                <div class="col-sm-1">
                                	<button class="btn btn-primary btn-sm" onclick="edit()">Edit</button>
                                </div>
                        </div>
                        <div class="row m-t-20">

                                <div class="col-sm-2">
                                	<label>Product Name: <?php echo $name["productName"]; ?></label>
                                	
                                	<label>Product Cost: <?php echo $name["cost"]; ?></label>
                                	<label>Product Date: <?php echo $ar[0]; ?></label>
                                </div>
                                <div class="col-sm-8"></div>
                                <div class="col-sm-2">
                                    <label>Total Hours : <?php echo $cohr["hr"]; ?></label><br/>
                                    <label>Total Cost :<?php echo $cohr["cst"]; ?></label>
                                </div>
                        </div>
                            <div class="row m-t-20">
                                
                                <div class="col-sm-12">
                                       <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                           <thead>
                                               <tr>
                                                   <th>Item</th>
                                                   <th>Quentity</th>
                                                   <th>Hours</th>
                                                   <th>Cost</th>
                                                   <th>Date</th>
                                                   
                                               </tr>
                                           </thead>
                                           <tbody>
<?php foreach ($row as $key) { ?>
																																												<tr>
																																													<td><?php echo $key["item"]; ?></td>
																																													<td><?php echo $key["quantity"]; ?></td>
																																													<td><?php echo $key["hours"]; ?></td>
																																													<td><?php echo $key["cost"]; ?></td>
																																													<td><?php echo $key["exdate"]; ?></td>
																																												</tr>
<?php } ?>
                                           </tbody>
                                       </table>
                                </div>
                                
                        </div>

                     </div>



                        <div id="expenditure2" class="card-box" style="display: none;">
                        	<div class="row m-t-20">
                        	<div class="col-sm-11"></div>
                                <div class="col-sm-1">
                                	<button class="btn btn-danger btn-sm" onclick="editof()">Close</button>
                                </div>
                        </div>
                        <div class="row m-t-20">
                                <div class="col-sm-2">
                                	<font color="black" style="size: 15px"><label>Product Name: <?php echo $name["productName"]; ?></label></font>
                                	
                                	<label>Product Cost: <?php echo $name["cost"]; ?></label>
                                	<label>Product Date: <?php echo $ar[0]; ?></label>
                                </div>
                                <div class="col-sm-8"></div>
                                <div class="col-sm-2">
                                    <label>Total Hours : <?php echo $cohr["hr"]; ?></label><br/>
                                    <label>Total Cost :<?php echo $cohr["cst"]; ?></label>
                                </div>
                        </div>
                            <div class="row m-t-20">
                                <div class="col-sm-12">
                                    
                                </div>
                                <div class="col-sm-12">
                                       <table class="table table-stripped">
                                           <thead>
                                               <tr>
                                                   <th>Item</th>
                                                   <th>Quentity</th>
                                                   <th>Hours</th>
                                                   <th>Cost</th>
                                                   <th>Date</th>
                                                   <th>Action</th>
                                               </tr>
                                           </thead>
                                           <tbody>
<?php foreach ($row as $key) { ?>
																						<tr>
																							<form id="exform" action="../adminControl.php" method="POST">
																								<input type="hidden" name="exid" value="<?php echo $key["exId"].' '.$_GET['xkpnt'] ?>">
																							<td><input type="text" class="form-control" name="item" placeholder="Item" value="<?php echo $key["item"]; ?>" required ></td>
																							<td><input type="number" class="form-control" name="quantity" placeholder="Quantity" value="<?php echo $key["quantity"]; ?>" required ></td>
																							<td><input type="number" class="form-control" name="hours" placeholder="Hours" value="<?php echo $key["hours"]; ?>" required ></td>
																							<td><input type="text" class="form-control" name="cost" placeholder="Cost" value="<?php echo $key["cost"]; ?>" required ></td>
																							<td><input type="Date" id="datepicker" class="form-control " name="date" value="<?php echo $key["exdate"]; ?>" required ></td>
																							<td>																					
																								<button type="submit" class="btn btn-success btn-sm" onclick="upd()" name="upex">Update</button>
																								<a class="btn btn-danger btn-sm" onclick="del('<?php echo $key["exId"].' '.$_GET['xkpnt'] ?>')">Delete</a>
																							</td>
																							</form>
																						</tr>
<?php } ?>
                                           </tbody>
                                       </table>
                                </div>
                        </div>

                     </div>

                        
                </div> <!-- container -->
            </div> <!-- content -->
<?php
		include 'userFooter.php';

	}
	else 
		header('location:../index.php');
}
else
	header('location:../index.php');
?>
<style type="text/css">
.row.card-box {
    margin-left: 2px;
}
</style>
<script type="text/javascript">
	function add() {
		document.getElementById('addEx').style.display='';
		document.getElementById('add').disabled=true;
	}
	function clos() {
		document.getElementById('addEx').style.display='none';
		document.getElementById('add').disabled=false;
	}
		function edit() {
		document.getElementById('expenditure2').style.display='';
		document.getElementById('expenditure1').style.display='none';
	}
		function editof() {
		document.getElementById('expenditure1').style.display='';
		document.getElementById('expenditure2').style.display='none';
	}

		function del(id) {
		location.href='../delete.php?del&ex='+id;
	}

</script>