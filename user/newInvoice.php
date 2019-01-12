                            <div class="row card-box hidden-print">
                                <div class="col-sm-6">
                                    <label>Clietn Name</label>
                                    <input type="text" id="inClient" onblur="client(this.value)" class="form-control" name="item" placeholder="Client Name" required >
                                </div>  
                                <div class="col-sm-6">
                                    <label>Address</label>
                                    <input type="text" id="inAdd" onblur="address(this.value)" class="form-control" name="item" placeholder="Address" required >
                                </div> 
                                <div class="col-sm-6">
                                    <label>Work</label>
                                   <input type="text" id="in" class="form-control" name="item" placeholder="Work" required >
                                </div>
                                <div class="col-sm-2">
                                    <label>Quantity</label>
                                    <input type="number" id="pm" class="form-control" name="quantity" placeholder="Quantity" required >
                                </div>
                                <div class="col-sm-3">
                                    <label>Unit Cost</label>
                                    <input type="text" id="cs" class="form-control" name="cost" placeholder="Unit Cost" required >
                                </div>
                                <div class="col-sm-1">
                                    <label></label>
                                    <button type="submit" onclick="myCreateFunction()" class="btn btn-success btn-sm" name="addExpenditure" style="width: 100px">Add to List</button>
                                </div>
                            </div>
                            
                    <div id="expenditure1" class="card-box">
                        <div class="row m-t-20">
                            <div class="col-sm-12"><h3><center>INVOICE</center></h3></div>
                                
                        </div>
                        <div class="row m-t-20">

                                <div class="col-sm-3">
                                    <label id="client">Client Name: </label><br/>
                                    <label id="address">Address: </label>
                                </div>
                                <div class="col-sm-7"></div>
                                <div class="col-sm-2">
                                    <label ><?php date_default_timezone_set('Asia/Dhaka'); echo 'Date: '.date('Y-m-d'); ?></label>
                                </div>
                        </div>
                            <div class="row m-t-20">
                                
                                <div class="col-sm-12">
                                       <table id="tb" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                           <thead>
                                               <tr>
                                                   <th>#</th>
                                                   <th>Work</th>
                                                   <th>Quentity</th>
                                                   <th>Cost</th>
                                                   <th>Total</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                           </tbody>
                                       </table>
                                </div>
                                <div class="col-sm-10"></div>
                                <div class="col-sm-2"><label id="to">Total Cost: 0</label></div>
                                <div class="col-sm-4"> 
                                    <button id="rowdel" class="btn btn-danger btn-sm hidden-print" onclick="myDeleteFunction()" style="width:400px;">Delete Last Row</button>
                                </div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4">
                                    <div class="hidden-print m-t-30 m-b-30">
                                        <div class="text-right">
                                            <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i class="fa fa-print m-r-5"></i> Print</a>
                                            <a href="#" class="btn btn-info waves-effect waves-light">Submit</a>
                                        </div>
                                    </div>
                                </div>
                                
                        </div>

                     </div>
<style type="text/css">
    
a.btn.btn-secondary.buttons-pdf.buttons-html5 {
    display: none;
}
button.btn.btn-success.btn-sm {
    margin-bottom: -29px;
}

</style>

<script>
document.getElementById('nvoice').style.display='none';
var x = 0;
var pm = 0;
var tt = new Array();
if (x==0) {
    document.getElementById('rowdel').style.display= 'none';
}
else{
    document.getElementById('rowdel').style.display= '';
}
function myCreateFunction() {
    x++;
    var table = document.getElementById("tb");
    var tx = document.getElementById("in").value;
    var q = document.getElementById("pm").value;
    var m = document.getElementById("cs").value;
    m=Number(m);
    q=Number(q);
    tt[x-1]=m*q;
    pm += tt[x-1];
    var row = table.insertRow(x);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    cell1.innerHTML = x;
    cell2.innerHTML = tx;
    cell3.innerHTML = q;
    cell4.innerHTML = m;
    cell5.innerHTML = tt[x-1];
    document.getElementById("to").innerHTML = 'Product Cost: '+pm;
    document.getElementById("in").value='';
    document.getElementById("pm").value=0;
    if (x==0) {
    document.getElementById('rowdel').style.display= 'none';
}
else{
    document.getElementById('rowdel').style.display= '';
}
}

function myDeleteFunction() {
if(x>0){
    document.getElementById("tb").deleteRow(x);
    pm -=tt[x-1];
    document.getElementById("to").innerHTML ='Total Cost: '+pm;
    x--;
    }
    if (x==0) {
    document.getElementById('rowdel').style.display= 'none';
}
else{
    document.getElementById('rowdel').style.display= '';
}
}

function client(name) {
    document.getElementById('client').innerHTML = 'Client Name: '+name;
}
function address(name) {
    document.getElementById('address').innerHTML = 'Address: '+name;
}
</script>
