<?php 
$cust_product = new newList();
$sql= "SELECT * FROM proposal_tb p LEFT JOIN companyinfo_tb c ON p.companyId = c.cmpId WHERE p.customId = :id ORDER BY p.proposalId DESC";
$proposal = $cust_product->Fun($sql,':id',$_SESSION["userId"]);
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
                                      <label><font size="6">PROPOSALS</font></label>
                                    </div>
                                    <div class="col-sm-4"></div>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->  

                        <div id="expenditure" class="card-box">

                            <div class="row m-t-20">
<?php
if(isset($proposal)){
 foreach ($proposal as $key2) {
?> 
                            <div class="col-md-4">
                                <div class="card m-b-30 card-inverse text-white" style="background-color: #7ea9a1; border-color: #333; font-color: black;">
                                    <div class="card-body">
                                      <?php $date = explode(' ', $key2["pdatetime"]);
                                      $id = $key2["proposalId"];  ?>
                                      <h5 class="card-title" style="float: right;">Date: <?php echo $date[0] ?><br>Time: <?php echo $date[1]; ?><br>Status: <?php echo $key2["status"]; ?></h5>
                                        <h5 class="card-title">Serial: <?php echo $key2["propSerial"] ?></h5>
                                        <h5 class="card-title">Subject: <?php echo $key2["propTitle"] ?></h5>
                                        <p class="card-text"><?php echo $key2["description"] ?></p>
                                    </div>
                                    <div class="card-footer" style="">
                                        <form action="../proposalSend.php" method="get" target="_blank">
                                          <?php echo '<input type="hidden" name="openx" value="'.$key2["propName"].'">'  ?>  
                                          <button class="btn btn-secondary btn-sm waves-effect waves-light"" name="open" >Open</button>
                                          <?php if($key2["status"]=='On Progress') {?>
                                          <a href="<?php echo '../clientControl.php?acp=true&pro='.$id ?>" class="btn btn-success btn-sm waves-effect waves-light">Accept</a>
                                          <a href="<?php echo '../clientControl.php?acp=false&pro='.$id ?>" class="btn btn-danger btn-sm waves-effect waves-light">Reject</a> 
                                          <?php } ?>
                                        </form>
                                      
                                    </div>
                                </div>
                            </div>
<?php }} ?>
                        </div>

                     </div>
                </div> <!-- container -->
            </div> <!-- content -->
<style type="text/css">
  h5.card-title {
    color: white;
}
</style>