<?php 
include 'adminHeader.php';
include '../allList.php';
include '../OAuth/Security.php';
if (isset($_GET['new']) && isset($_GET['ser'])) {
    $srl = trim(scrypt($_GET['ser'],'D'));
    $obj = new newList();

    $sql="SELECT * FROM invoicelist_tb WHERE invoSerial = :id ORDER BY id DESC";
    $par =":id";
    $id = $srl;
    $row = $obj->sqlFun($sql,$par,$id);
    $id = $row["id"];

    $sql="SELECT * FROM invoicesinfo_tb WHERE ILI = :id";
    $par =":id";
    $row = $obj->Fun($sql,$par,$id);

    $sql="SELECT SUM(quantity*unitCost) total FROM invoicesinfo_tb WHERE ILI = :id";
    $par =":id";
    $cohr = $obj->sqlFun($sql,$par,$id);

    $sql="SELECT * FROM note_tb WHERE invoId = :id";
    $par =":id";
    $note = $obj->Fun($sql,$par,$id);
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
                                        <!-- <button class="btn btn-primary btn-sm">Notes</button> -->
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->  

                            
                    <div class="card-box" id="invo">
                        <div class="row m-t-20">
                            <div class="col-sm-12"><h3><center>INVOICE</center></h3></div>     
                        </div>
                        <div class="row m-t-20">
                            <div class="col-sm-12"><label class="pull-right"><h4>Total: <?php echo $cohr["total"] ?></h4></label></div>     
                        </div>
                        <div class="row m-t-20">
                            <div class="col-sm-12">
                                <table id="tb" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                           <thead>
                                               <tr>
                                                   <th>#</th>
                                                   <th>Work</th>
                                                   <th>Unit</th>
                                                   <th>Quentity</th>
                                                   <th>Unit Cost</th>
                                                   <th>Total</th>
                                                   <th>Action</th>
                                               </tr>
                                           </thead>
                                           <tbody>
<?php 
$cnt = 1;
foreach ($row as $key) {
?>
                                            <tr>
                                                <td><?php echo $cnt ?></td>
                                                <td><?php echo $key["work"]; ?></td>
                                                <td><?php echo $key["unit"]; ?></td>
                                                <td><?php echo $key["quantity"]; ?></td>
                                                <td><?php echo $key["unitCost"]; ?></td>
                                                <td><?php echo $key["quantity"]*$key["unitCost"]; ?></td>
                                                <td>
                                                 <form action="../delete.php" method="POST">
                                                    <input type="hidden" name="ili" value="<?php echo $key["ILI"]; ?>">
                                                    <input type="hidden" name="id" value="<?php echo $key["id"]; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" name="IID">Delete</button>
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

                        <form action="../clientEntry.php" method="POST">
                            <div id="work" class="row card-box">
                                <div class="col-sm-6">
                                    <input type="hidden" name="ILI" value="<?php echo $id ?>">
                                    <label>Work</label>
                                   <input type="text" id="in" class="form-control" name="item" placeholder="Work" required >
                                </div>
                                <div class="col-sm-2">
                                    <label>Unit</label>
                                    <input type="text" id="pm" class="form-control" name="unit" placeholder="Unit" required >
                                </div>
                                <div class="col-sm-2">
                                    <label>Quantity</label>
                                    <input type="number" id="pm" class="form-control" name="quantity" placeholder="Quantity" required >
                                </div>
                                <div class="col-sm-2">
                                    <label>Unit Cost</label>
                                    <input type="number" id="cs" class="form-control" name="cost" placeholder="Unit Cost" required >
                                </div>
                            </div>

                        <div class="row m-t-20">
                            <div class="col-sm-12 pull-left">
                                <label></label>
                                <button type="submit" class="btn btn-success btn-sm" name="addfield" style="width: 100%;">Add To Invoice</button>
                            </div>   
                        </div>
                        </form>
                        <div class="row m-t-20">
                            <div class="col-sm-12">
                                <!-- <?php echo '<a href="invoicePrint.php?pre&ser='.$_GET['ser'].'" class="btn btn-secondary btn-sm pull-left" target="_blank" style="width: 50%">Preview</a>'?> -->
                                <!-- <button class="btn btn-primary btn-sm pull-right" onclick="Note(1)" style="width: 50%">  SEND </button> -->
                            </div>
                        </div>
                        
                    </div>

                    <div class="card-box" id="note" >
                        <div class="row m-t-20">
                            <div class="col-sm-12"><h4>Notes</h4></div>     
                        </div>
                        <div class="row m-t-20">
                            <div class="col-sm-12">
                                <table id="tb" cellspacing="0" width="100%">
                                           <thead>
                                               <tr>
                                                   <th>#</th>
                                                   <th>Note</th>
                                                   <th>Action</th>
                                               </tr>
                                           </thead>
                                           <tbody>
<?php 
$cnt = 1;
foreach ($note as $key) {
?>
                                            <tr>
                                                <td><?php echo $cnt ?></td>
                                                <td><?php echo $key["note"]; ?></td>
                                                <td>
                                                 <form action="../delete.php" method="POST">
                                                    <input type="hidden" name="ili" value="<?php echo $key["ILI"]; ?>">
                                                    <input type="hidden" name="id" value="<?php echo $key["id"]; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" name="notedel"><i style="font-size:24px" class="fa">&#xf00d;</i></button>
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
                        <form action="../clientEntry.php" method="POST">
                                <div class="row m-t-20">
                                    <div class="col-sm-11">
                                        <input type="hidden" name="ILI" value="<?php echo $id ?>">
                                        <input type="text" class="form-control" name="Note" placeholder="Note" required >
                                    </div>
                                    <div class="col-sm-1 pull-right">
                                        <button type="submit" class="btn btn-success" name="addnote" style="width: 100%;"><i class="fa fa-check-square" style="font-size:20px"></i></button>
                                    </div>   
                                </div>
                        </form>
                        <div class="row m-t-20">
                            <div class="col-sm-12">
                                <?php echo '<a href="invoicePrint.php?pre&ser='.$_GET['ser'].'" class="btn btn-primary btn-sm" target="_blank" style="width: 50%">Preview</a>'?>
                                <?php echo '<a href="invoicePrint.php?snd&ser='.$_GET['ser'].'" class="btn btn-success btn-sm pull-right" style="width: 50%">Send</a>'?>
                                <!-- <button class="btn btn-danger btn-sm " onclick="Note(2)" style="width: 33%"> Close </button> -->
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            function Note(x) {
                switch(x){
                    case 1:{
                        document.getElementById('invo').style.display='none';
                        document.getElementById('note').style.display='';
                        break;
                    }
                    case 2:{
                        document.getElementById('invo').style.display='';
                        document.getElementById('note').style.display='none';
                        break;
                    }
                }
                    
            }
        </script>

<?php 
}
else {
    echo "<script>location.href='invoicePage.php'</script>";
}
include 'userFooter.php'; 
?>