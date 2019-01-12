<?php 
include 'adminHeader.php';
include '../allList.php';
$obj=new newList();
$row=$obj->all("customerinfo_tb");
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
                                    
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->  

                        <div id="expenditure" class="card-box">
                            <div class="row m-t-20">
                                <div class="col-sm-6">
                                    <label>Select Company</label>
                                    <select id="company" onchange="active()" class="select2" >
                                        <option>Select company</option>
                                        <?php foreach ($row as $key ) { ?>
                                            <option value="<?php echo $key["customId"]; ?>" ><?php echo $key["cmpName"]; ?></option>
                                        <?php } ?>
                                    </select>
                                    
                                </div>
                                <div class="col-sm-6">
                                    <label>Select Product</label>
                                       <table class="table">
                                           <thead>
                                               <tr>
                                                   <th>Product Name</th>
                                                   <th>Date</th>
                                                   <th>Action</th>
                                               </tr>
                                           </thead>
                                           <tbody id="product">
                                               
                                           </tbody>
                                       </table>
                                </div>
                        </div>

                     </div>
                </div> <!-- container -->
            </div> <!-- content -->
<?php include 'userFooter.php'; ?>


<script type="text/javascript">
    function active() {
        $("#product").empty();
        var cid = document.getElementById("company").value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // console.log(this.responseText);
                var jsn = JSON.parse(this.responseText);
                // jsn = this.responseText;
                for (var i = jsn.length - 1; i >= 0; i--) {
                    var x = document.getElementById("product");
                    var option = document.createElement("option");
                    var tx =jsn[i].productName;
                    var val = jsn[i].cpId;
                    option.text = tx;
                    option.value = val;
                    $("#product").append(
                        '<tr><td>'+tx+'</td><td>'+jsn[i].cpdatetime+'</td><td><a class="btn btn-secondary" href="addExpenditure.php?xkpnt='+val+'&exp=true">Expenditure</a></td></tr><br>'
                        );
                }
            }
        };
        xmlhttp.open("GET", "../allList.php?key=expen&companyid="+cid, true);
        xmlhttp.send();
        
        // $.get('../allList.php?',{'companyidy':cid},function(return_data){
        //     $.each(return_data.data, function(key,value){
        //         $("#product").append("<option value=" + value.cpId +">"+value.productName+"</option>");
        //         });
        //     }, "json");
    
    }


</script>