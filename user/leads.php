<?php include 'userHeader.php'; 
include '../allList.php';
$obj=new newList();
$row=$obj->all("leadinfo_tb")
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
                                    <h4 class="page-title float-left">Leads</h4>

                                    <ol class="breadcrumb float-right">
                                        <button type="button" class="btn btn-custom waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">New Lead</button>
                                    </ol>

                                    <div class="clearfix">

                                 <!-- sample modal content -->

                                    <div id="con-close-modal" class="modal fade" tabindex="-1" role="form" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                                    <h4 class="modal-title">New Lead Form</h4>
                                                </div>
                                                
                                                <?php include 'leadForm.php'; ?>


                                            </div>
                                        </div>
                                    </div>

                                    <!-- /.modal -->

                                    </div>


                                </div>
                            </div>
                        </div>
                        <!-- end row -->




                        <div class="row">
                            <div class="col-12">
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title"><b>Leads List</b></h4>

                                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>Company Name</th>
                                            <th>WebSite</th>
                                            <th>Cell</th>
                                            <th>Tag</th>
                                            <th>Reference Name</th>
                                            <th>View</th>
                                        </tr>
                                        </thead>
                                        <tbody>
<?php 
 // var_dump($row);
foreach ($row as $key) {
// var_dump($key);

?>
                                            <tr>
                                            <td><?php echo $key["cmpName"]; ?></td>
                                            <td><?php echo $key["cmpWeb"]; ?></td>
                                            <td><?php echo $key["cmpCell"]; ?></td>
                                            <td><?php echo $key["tag"]; ?></td>
                                            <td><?php echo $key["refName"]; ?></td>
                                            <td>
                                                <form action="leadInfo.php" method="POST">
                                                    <?php echo'<input type="hidden" name="Leadid" value="'.$key["leadId"].'">' ?>
                                                    <button type="submit" class="btn btn-success btn-sm" name="ID" >view</button>

<?php if(isset($_SESSION["is_Admin"]) && ($_SESSION["is_Admin"] == "IS_ACTIVE")){ 
        echo '<a class="btn btn-secondary btn-sm" onclick="go('.$key["leadId"].')" name="leadUpdate" >Update</a>';
        echo '<a class="btn btn-danger btn-sm" onclick="show('.$key["leadId"].','."'".$key["cmpName"]."'".')" data-toggle="modal" data-target="#exampleModal" >Delete</a>';
  } ?>      
                                                </form>
                                                

                                            </td>
                                            </tr>
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

<?php include 'userFooter.php';

if(isset($_SESSION["leadDone"]) && $_SESSION["leadDone"]=='yes' )
{
    echo '<script type="text/javascript"> window.alert("New Lead Added");</script>';
    $_SESSION["leadDone"]=null;
}

?>
<script type="text/javascript">
    function show(id,name){
       var x ='All the Information about <strong>'+name+'</strong> will be Deleted.';
        document.getElementById('showinfo').innerHTML = x;
        document.getElementById('leadid').value= id;
    }
    function go(id) {
        console.log(id);
        var link = 'leadUpdateForm.php?leadid='+id;
        location.href = link;
    }
</script>
<style type="text/css">
    a.btn.btn-danger.btn-sm {
    margin-left: 4px;
}
</style>

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
            <input type="hidden" id="leadid" name="leadid">
            <button type="submit" class="btn btn-primary" name="leadDeleteButton">Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>
