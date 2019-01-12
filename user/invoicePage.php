<?php 
include 'adminHeader.php';
include '../OAuth/Security.php';
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
                                    <h4 class="page-title float-left">Invoices</h4>

                                    <ol class="breadcrumb float-right">
                                    <button type="button" id="addin" onclick="Inv(1)" class="btn btn-success" data-toggle="modal" data-target="#myModal" >Add New Invoice</button>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->  


<?php 
include '../allList.php';
$obj = new newList();
$row = $obj->all('companyinfo_tb');
$row2 = $obj->all('customerinfo_tb');
$row3 = $obj->all('signature_tb');
$row4 = $obj->all('invoicelist_tb');

 ?>                            
                        <form id="invFrm" action="../clientEntry.php" method="POST" style="display: none;">
                            <div class="row card-box hidden-print">
                                <div class="col-sm-6">
                                    <label>From</label>
                                    <select id="slt" class="selectpicker show-tick pull-right" name="from" required>
                                        <option disabled selected>Select Company*</option>
                                        <?php
                                        foreach ($row as $key) {
                                             echo '<option value="'.$key["cmpId"].'">'.$key["companyName"].'</option>';
                                         } 
                                         ?>
                                    </select>
                                </div> 
                                <div class="col-sm-6">
                                    <label>To</label>
                                    <select id="slt" class="selectpicker show-tick pull-right" name="to" required>
                                        <option disabled selected>Select Company*</option>
                                        <?php
                                        foreach ($row2 as $key) {
                                             echo '<option value="'.$key["customId"].'">'.$key["cmpName"].'</option>';
                                         } 
                                         ?>
                                    </select>
                                </div> 
                                <div class="col-sm-6">
                                    <label>Signature</label>
                                    <select id="slt" class="selectpicker show-tick pull-right" name="sig" required>
                                        <option disabled selected>Select Signature*</option>
                                        <?php
                                        foreach ($row3 as $key) {
                                             echo '<option value="'.$key["id"].'">'.$key["name"].' ('.$key["designation"].')</option>';
                                         } 
                                         ?>
                                    </select>
                                </div>  
                                <div class="col-sm-12">
                                    <label>To Work</label>
                                    <input type="text" class="form-control" placeholder="To Work" name="towork" required>
                                </div> 
                                <div class="col-sm-12">
                                    <br>
                                    <a class="btn btn-danger btn-sm pull-right" onclick="Inv(2)" style="width: 150px;">Close</a>
                                    <button type="submit" class="btn btn-success btn-sm pull-right" name="crtInv">Create New Invoice</button>
                                </div>
                            </div>
                        </form>
                            



                    <div class="card-box">
                        <div class="row m-t-20">
                            <div class="col-sm-12"><h3><center>All INVOICE</center></h3></div>     
                        </div>
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
                                                   <th>Status</th>
                                                   <th>Date</th>
                                                   <th>Action</th>
                                               </tr>
                                           </thead>
                                           <tbody>
<?php 
$cnt = 1;
foreach ($row4 as $key) {
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
                                                <td><?php 
                                                if($key["sendStatus"]==0)
                                                    echo '<b><font color="red">Not Sent</font></b>';
                                                else
                                                    echo '<b><font color="green">Sent</font></b>';
                                                ?></td>
                                                <td><?php echo $key["datetime"]; ?></td>
                                                <td>
                                                <form action="../delete.php" method="POST">
                                                    <?php echo '<a href="createInvoice.php?new&ser='.scrypt(trim($key["invoSerial"])).'" class="btn btn-secondary btn-sm" style="width: 100px;">Open</a>'?>
                                                    <input type="hidden" name="id" value="<?php echo $key["id"]; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" name="InvoD" style="width: 100px;">Delete</button>
                                                 </form>
                                                   
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


<script type="text/javascript">
    function Inv(s) {
        if (s==1) {
            document.getElementById('invFrm').style.display = '';
            document.getElementById('addin').style.display = 'none';
        }
        else{
            document.getElementById('invFrm').style.display = 'none';
            document.getElementById('addin').style.display = '';
        }
    }
</script>
<?php 
include 'userFooter.php'; 
?>