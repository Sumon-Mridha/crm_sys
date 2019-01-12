<?php 
if (isset($_REQUEST["productUpdateForm"]) && isset($_POST['productId'])) {
    $productId = $_POST['productId'];
    
    include 'adminHeader.php';
    include '../allList.php';
    $obj = new newList();
    //getting customer and user information
    $var="SELECT * FROM product_tb WHERE productId = :id";
    $par=':id';
    $row = $obj->sqlFun($var,$par,$productId);
    // var_dump($row);
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
                                    <h4 class="page-title float-left">Product Update</h4>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div> <!-- container -->

                </div> <!-- content -->
                <div class="card-box">
                    <div class="container-fluid">
                            <div class="row m-t-20">
                                <div class="col-sm-12">
                                    <form action="../adminControl.php" method="POST">
                                               <div class="modal-header">
                                                    <legend>Product Information</legend>
                                                </div>

                                            <div class="row m-t-20">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <?php echo '<input type="text" class="form-control" placeholder="" name="name" value="'.$row["productName"].'" required>'; 
                                                        ?>
                                                        
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Type</label>
                                                        <?php echo '<input type="text" class="form-control" placeholder="" name="type" value="'.$row["productType"].'" required>'; 
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <?php echo '<textarea class="form-control" rows="3" name="description">'.$row["description"].'</textarea>'; 
                                                        ?>                                                        
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <?php echo '<input type="hidden" name="id" value="'.$productId.'">' ?>
                                                    <button type="submit" class="btn btn-info waves-effect waves-light" name="productUpdate">Save</button>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
<?php include 'userFooter.php';
}
else{
    header('location:../index.php');
} ?>