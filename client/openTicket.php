<?php 
$cust_product = new newList();
$sql= "SELECT * FROM customerproduct_tb c LEFT JOIN product_tb p ON c.productId = p.productId WHERE c.customerId = :id ORDER BY c.cpId DESC";
$pro = $cust_product->Fun($sql,':id',$_SESSION["userId"]);
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
                                  <div class="row m-t-20">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4">
                                      <label><font size="6">Open New Ticket</font></label>
                                    </div>
                                    <div class="col-sm-4"></div>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->  
                        <form id="openticket" action="../clientControl.php" method="POST" enctype="multipart/form-data" style="display: none;">
                            <div  class="row card-box col-sm-12">
                                    <div class="col-sm-4">
                                        <label>From</label>
                                        <input type="text" id="from" class="form-control" name="" disabled>
                                    </div>
                                    <div class="col-sm-4">
                                      <input type="hidden" id="id" name="cpid">
                                        <label>Product Title</label>
                                        <input type="text" id="title" class="form-control" name="" disabled>
                                    </div> 
                                    <div class="col-sm-4">
                                      <label>Priority</label>
                                      <select class="selectpicker show-tick" name="priority">
                                        <option value="Low">Low</option>
                                        <option value="Medium" selected>Medium</option>
                                        <option value="High">High</option>
                                      </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <label>Subject</label>
                                        <input type="text" class="form-control" name="ticketSubject" placeholder="Subject" required>
                                    </div>  
                                    <div class="col-sm-12">
                                      <label>Message</label>
                                        <textarea class="form-control" rows="6" id="desc" name="desce" data-placeholder="Proposal Description"></textarea>
                                    </div>
                                    <div class="col-sm-3">
                                      <label>Add Attachment</label>
                                    <input type="file" id="file" class="filestyle"  data-placeholder="No file" data-buttonname="btn-secondary" name="attach[]" multiple>
                                    </div>
                                    <div class="col-sm-7"></div>
                                    <div class="col-sm-2">
                                      <br>
                                      <button type="Submit" class="btn btn-success" name="openNew">Submit</button>
                                      <a class="btn btn-danger" onclick="closeticket()">Close</a>
                                    </div>                              
                                </div>
                            </div>
                        </form>
                        <div id="product" class="card-box">
                            <div class="row m-t-20">
                                <div class="col-sm-12">
                                       <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                           <thead>
                                               <tr>
                                                <th>No.</th>
                                                <th>Product Name</th>
                                                <th>Title</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                            <?php $cnt = 1;  foreach ($pro as $key) { ?>
                                              <tr>
                                                 <td><?php echo $cnt; ?></td>
                                                 <td><?php echo $key["productName"]; ?></td>
                                                 <td><?php echo $key["title"]; ?></td>
                                                 <td><?php  $date = explode(' ', $key["cpdatetime"]); echo $date[0]; ?></td>
                                                 <td>
                                                  <button class="btn btn-secondary" onclick="openTicket('<?php echo $key["cpId"] ?>','<?php echo $key["title"] ?>','<?php echo $_SESSION["fname"] ?>')">Open New Ticket</button>
                                                 </td>
                                               </tr>
                                            <?php $cnt++; } ?>
                                           </tbody>
                                       </table>
                                </div>
                        </div>

                     </div>

                </div> <!-- container -->
            </div> <!-- content -->

<script type="text/javascript">
  function openTicket(id,name,fname) {
    document.getElementById('openticket').style.display = '';
    document.getElementById('product').style.display = 'none';
    document.getElementById('title').value = name;
    document.getElementById('from').value = fname;
    document.getElementById('id').value = id;
  }
  function closeticket() {
    document.getElementById('openticket').style.display = 'none';
    document.getElementById('product').style.display = '';
  }

</script>
<style type="text/css">
  .dt-buttons.btn-group {
    display: none;
}
</style>