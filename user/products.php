<?php include 'userHeader.php';
    include '../allList.php';
    $obj = new newList();
    $row = $obj->all("product_tb");
    $cnt=0;
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
                                    <h4 class="page-title float-left">Prodcuts</h4>
 <?php if(isset($_SESSION["is_Admin"]) && ($_SESSION["is_Admin"] == "IS_ACTIVE")){ ?>

                                    <ol class="breadcrumb float-right">
                                        <button type="button" class="btn btn-custom waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">Add New Product</button>
                                    </ol>
<?php } ?>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <?php include'productForm.php'; ?>

                        <div class="row">
                            <div class="col-12">
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title"><b>Prodcuts List</b></h4>

                                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Product Name</th>
                                            <th>Product Type</th>
                                            <th>Description</th>
                                            <th>Date</th>
<?php if(isset($_SESSION["is_Admin"]) && ($_SESSION["is_Admin"] == "IS_ACTIVE")){ ?>
                                            <th>Action</th>
<?php } ?>
                                        </tr>
                                        </thead>
                                        <tbody>
<?php foreach ($row as $key) {
    $cnt++;
    ?> 

                            

                                            <tr>
                                            <td><?php echo $cnt ?></td>
                                            <td><?php echo $key["productName"] ?></td>
                                            <td><?php echo $key["productType"] ?></td>
                                            <td><?php echo $key["description"] ?></td>
                                            <td><?php echo $key["productDate"] ?></td>
                                            
                                                
                                                
<?php if(isset($_SESSION["is_Admin"]) && ($_SESSION["is_Admin"] == "IS_ACTIVE")){
        echo '<td><form action="productUpdateForm.php" method="POST">
                    <input type="hidden" name="productId" value="'.$key["productId"].'">
                                                    <button type="submit" class="btn btn-secondary btn-sm" name="productUpdateForm">Update</button>'; 
        echo '<a class="btn btn-danger btn-sm" onclick="show('.$key["productId"].','."'".$key["productName"]."'".')" data-toggle="modal" data-target="#exampleModal" >Delete</a>
                </form></td>';

                                                    
 } ?>

                                            
                                            </tr>
<?php } ?>
                                        </tbody> 
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- end of the row -->
                    </div> <!-- container -->

                </div> <!-- content -->

<?php include 'userFooter.php'; ?>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons1').DataTable({
                    lengthChange: true,
                    // buttons: ['copy', 'excel', 'pdf', 'colvis']
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

        </script>

<script type="text/javascript">
    function show(id,name){
       var x ='All the Information about <strong>'+name+'</strong> will be Deleted.';
        document.getElementById('showinfo').innerHTML = x;
        document.getElementById('product').value= id;
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
            <input type="hidden" id="product" name="productid">
            <button type="submit" class="btn btn-primary" name="productDeleteButton">Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>