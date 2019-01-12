<?php
include 'userHeader.php';
include '../allList.php';
$obj = new newList();
$client = $obj->all("customerinfo_tb");
$lead = $obj->all("leadinfo_tb");
// $pro = $obj->all("proposal_tb");
$pro = $obj->allProp();
// var_dump($pro);
//company
$cmp=$obj->all("companyinfo_tb");
$cnt=0;
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
                                    <h4 class="page-title float-left">Proposals</h4>
                                    <ol class="breadcrumb float-right"> 
                                        <select onchange="deactive()" class="selectpicker show-tick" id="select">
                                            <option>New Proposal</option>
                                            <option>Customers</option>
                                            <option>Leads</option>
                                        </select>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <form id="frm" action="#" method="POST" enctype="multipart/form-data">
                            <div id="proposalSend" class="row card-box">

                                <div class="col-sm-4" >

                                    <select class="select2" id="customer" name="custom" required disabled>
                                        <option disabled selected>Customers</option>
<?php foreach ($client as $key1) {?> 
                            <?php echo'<option value="'.$key1["customId"].'" >'.$key1["cmpName"].'</option>'; ?>
<?php } ?>
                                    </select>

                                </div>
                                <div class="col-sm-4" >
                                    <select class="select2" id="lead" name="led" required disabled>
                                        <option disabled selected>Leads</option>
<?php foreach ($lead as $key2) {?> 
                            <?php echo'<option value="'.$key2["leadId"].'" >'.$key2["cmpName"].'</option>'; ?>
<?php } ?>
                                    </select>

                                </div>
                                <div class="col-sm-3">

                                        <input type="file" id="file" class="filestyle"  data-placeholder="No file" data-buttonname="btn-secondary" name="proposal" required >

                                </div>
                                <div class="col-sm-1">
                                    <button type="submit" id="probtn" onclick="check()" class="btn btn-success btn-sm" name="proposalsend">SEND</button>
                                </div>
                                <div class="row col-12">
                                    
                                    <div class="col-sm-4">
                                        <label></label>
                                        <select class="selectpicker show-tick" name="compnayId">
                                            <option disabled selected>From</option>
<?php foreach ($cmp as $key2) {?> 
                            <?php echo'<option value="'.$key2["cmpId"].'" >'.$key2["companyName"].'</option>'; ?>
<?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-8">
                                        <label></label>
                                        <textarea class="form-control" rows="6" id="desc" name="desce" data-placeholder="Proposal Description"></textarea>
                                    </div>
                                    <div class="col-sm-4">
                                        <label></label>
                                        <textarea class="form-control" id="title"  name="title" placeholder="Proposal Subject" required ></textarea>
                                    </div>

                                    
                                </div>
                            </div>
                            
                        </form>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title"><b>Proposal List</b></h4>

                                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Title</th>
                                            <th>Serial</th>
                                            <th>To</th>
                                            <th>Email</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>view</th>
                                        </tr>
                                        </thead>
                                        <tbody>
<?php
if(isset($pro)){
 foreach ($pro as $key2) {
    $cnt++;
?> 

                            

                                            <tr>
                                            <td><?php echo $cnt ?></td>
                                            <td><?php echo $key2["propTitle"] ?></td>
                                            <td><?php echo $key2["propSerial"] ?></td>
                                            <?php if ($key2["cusName"]=='') {?>
                                            <td><?php echo $key2["lname"] ?></td>
                                            <td><?php echo $key2["lemail"] ?></td>
                                            <td>Lead</td>
                                            <?php } else {?>
                                            <td><?php echo $key2["cusName"] ?></td>
                                            <td><?php echo $key2["cusEmail"] ?></td>
                                            <td>Customer</td>
                                            <?php } ?>
                                            <td><?php 
                                            $st = $key2["status"]; 
                                            if($st[0] == 'O') 
                                                echo '<b><font color="black">'.$key2["status"].'</font></b>';
                                            elseif ($st[0] == 'A') {
                                               echo '<b><font color="green">'.$key2["status"].'</font></b>';
                                            }
                                            else
                                                echo '<b><font color="red">'.$key2["status"].'</font></b>';
                                            ?> 
                                            </td>
                                            <td><?php echo $key2["pdatetime"] ?></td>
                                            <td>
                                                <form action="../proposalSend.php" method="get" target="_blank">
                                                    <?php echo '<input type="hidden" name="openx" value="'.$key2["propName"].'">'  ?>  
                                                    <button class="btn btn-success btn-sm" name="open" >Open</button>
<?php if(isset($_SESSION["is_Admin"]) && ($_SESSION["is_Admin"] == "IS_ACTIVE")){ 
        echo '<a class="btn btn-danger btn-sm" onclick="show('.$key2["proposalId"].','."'".$key2["propTitle"]."'".')" data-toggle="modal" data-target="#exampleModal" >Delete</a>';
                                                    
 } ?>
                                                </form>
                                             
                                            </td>

                                            </tr>
<?php }} ?>
                                        </tbody> 
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                    </div> <!-- container -->

                </div> <!-- content -->

<?php include 'userFooter.php'; 

if(isset($_SESSION["ok"]))
{
    if($_SESSION["ok"]=='done'){
        echo '<script type="text/javascript"> window.alert("Mail Sent");</script>';
    }
    
    unset($_SESSION["ok"]);
}



?>
<script type="text/javascript">
    // document.getElementById("select").addEventListener("onchange", deactive);
    var a = document.getElementById("select").value;
    if(a=='New Proposal'){
        document.getElementById("proposalSend").style.display="none";
    }
    function deactive() {
        var x = document.getElementById("select").value;
        if (x=='New Proposal') {
            document.getElementById("proposalSend").style.display="none";
            document.getElementById("lead").disabled = true;
            document.getElementById("customer").disabled = true;


        } else {
                document.getElementById("proposalSend").style.display="";         
            if (x=='Customers') {
                document.getElementById("customer").disabled = false;
                document.getElementById("lead").disabled = true;
            }
            else{
                document.getElementById("lead").disabled = false;
                document.getElementById("customer").disabled = true;
            }
        }
        
        
    }

    function check(){
        
        var a=document.getElementById("lead").value;
        var b=document.getElementById("customer").value;
        var c=document.getElementById("file").value;
        var d=document.getElementById("title").value;
        var e=document.getElementById("desc").value;
        // console.log(a+'\n'+b+'\n'+c+'\n'+d+'\n'+e);
        
        if(c != null && d !=null ){
            var spl= c.split(".");
            var len = spl.length;
            var x = spl[len-1];
            // alert(x.toLowerCase());
            var type =['pdf'];
            x = x.toLowerCase();
            // console.log(d+'\n'+e);
            if(type.includes(x)){
                document.getElementById("probtn").style.display="none";
                    if(document.getElementById("lead").disabled){
                        if(b =='Customers'){
                            alert("Please select Customer");
                        }
                        else{
                            document.getElementById("frm").setAttribute("action","../proposalSend.php");
                            // console.log(d+'\n'+e);
                        }
                    }

                    if(document.getElementById("customer").disabled){
                        if(a =='Leads'){
                            alert("Please select Leads");
                        }
                        else{
                            document.getElementById("frm").setAttribute("action","../proposalSend.php");
                            // console.log(d+'\n'+e);
                        }
                    }
            }

        }

    // document.getElementById("probtn").disabled = true;        

    }

</script>
<script type="text/javascript">
    function show(id,name){
       var x ='All the Information about <strong>'+name+'</strong> will be Deleted.';
        document.getElementById('showinfo').innerHTML = x;
        document.getElementById('proposalid').value= id;
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
            <input type="hidden" id="proposalid" name="proposalid">
            <button type="submit" class="btn btn-primary" name="proposalDeleteButton">Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>

<style type="text/css">
    div#mceu_14 {
    display: none;
}

.disMe{
    display: none;
}
textarea#title {
    margin-top: -112px;
}
</style>