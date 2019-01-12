<?php 
include 'adminHeader.php';
include '../allList.php';
$obj = new newList();
$row = $obj->all('companyinfo_tb');
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
                                    <h4 class="page-title float-left">Setup</h4>

                                    <ol class="breadcrumb float-right">
                                    
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->  


                            <div class="settings row card-box hidden-print">
                                <div class="col-sm-10">
                                    <label class="pull-left">Edit Company / Mail Server Settings</label>
                                    
                                </div>
                                <div class="col-sm-2">
                                    <select id="slt" onchange="openSetting(2)" class="selectpicker show-tick pull-right">
                                        <option disabled selected>Select Company</option>
                                        <?php
                                        foreach ($row as $key) {
                                             echo '<option value="'.$key["cmpId"].'">'.$key["companyName"].'</option>';
                                         } 
                                         ?>
                                    </select>
                                </div>
                                <div class="col-sm-12"><label></label></div>
                                 <div class="col-sm-12">
                                    <label class="pull-left">Add New Company</label>
                                    <button onclick="openSetting(1)" class="btn btn-success btn-sm pull-right">Add</button>
                                </div>  
                                <div class="col-sm-12"><label></label></div>   
                                <div class="col-sm-12">
                                    <label class="pull-left">Add New Signatory</label>
                                    <button onclick="openSetting(3)" class="btn btn-success btn-sm pull-right">Add</button>
                                </div> 
                            </div>

                        <!-- end row -->

                        <!-- company and mailserver add form -->
                        <form id="Company" action="../clientEntry.php" method="POST" enctype="multipart/form-data" style="display: none;">
                            <div class="row card-box">
                                <div class="col-sm-12">
                                    <h2>Add Company</h2><br>
                                    <hr>
                                </div>
                                <div class="col-sm-6">
                                    <label>Company Name</label>
                                    <input type="text" class="form-control" name="CompanyName" placeholder="Company Name" required >
                                </div>  
                                <div class="col-sm-6">
                                    <label>Cell</label>
                                    <input type="text" class="form-control" name="Cell" placeholder="Cell" required >
                                </div> 
                                <div class="col-sm-6">
                                    <label>Email</label>
                                   <input type="email" class="form-control" name="Email" placeholder="Email" required >
                                </div>
                                <div class="col-sm-6">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="Address" placeholder="Address" required >
                                </div>
                                <div class="col-sm-6">
                                    <label>Website Address</label>
                                    <input type="text" class="form-control" name="web" placeholder="Website Address" required >
                                </div>
                                <div class="col-sm-6">
                                    <label>Insert company Logo</label>
                                    <p class="text-pink" id="err" style="display: none;">Plsease insert jpg/jpeg/png formate</p>
                                    <input id="fl" type="file" onblur="checkfile(this)" class="filestyle"  data-placeholder="(Not more than 1MB)" data-buttonname="btn-secondary" name="logo" required>
                                </div>


                                <div class="col-sm-12">
                                    <h2>Mail Server Settings</h2><br>
                                    <hr>
                                </div>
                                <div class="col-sm-8">
                                    <label>HOST Server</label>
                                    <input type="text"  class="form-control" name="host" placeholder="HOST Server" required >
                                </div>  
                                <div class="col-sm-2">
                                    <label>SMTP Port</label>
                                    <input type="number" class="form-control" name="port" placeholder="SMTP Port" required >
                                </div>
                                <div class="col-sm-2">
                                    <label>SMTP Secure</label>
                                    <select class="selectpicker show-tick" name="ssl">
                                        <option value="ssl">SSL</option>
                                        <option value="">No SSL</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Username" required >
                                </div> 
                                <div class="col-sm-6">
                                    <label>Password</label>
                                   <input type="text" class="form-control" name="pass" placeholder="Password" required >
                                </div>
                                <div class="col-sm-12">
                                    <br>
                                    <a onclick="openSetting(4)" class="btn btn-danger pull-right" style="width: 200px;">Close</a>
                                    <button id="compBtn" type="submit" class="btn btn-success pull-right" name="compBtn" disabled>Add to List</button>
                                </div>
                            </div>
                        </form>
                        <!-- end row -->

                        <!-- company and email update form -->
                        <form id="Mail" action="../adminControl.php" method="POST" enctype="multipart/form-data" style="display: none;">
                            <div class="row card-box">
                                <div class="col-sm-12">
                                <input type="hidden" id="ids" name="cmpids">
                                    <h2>Edit Company</h2><br>
                                    <hr>
                                </div>
                                <div class="col-sm-6">
                                    <label>Company Name</label>
                                    <input type="text" id="name" class="form-control" name="CompanyName" placeholder="Company Name" required >
                                </div>  
                                <div class="col-sm-6">
                                    <label>Cell</label>
                                    <input type="text" id="cell" class="form-control" name="Cell" placeholder="Cell" required >
                                </div> 
                                <div class="col-sm-6">
                                    <label>Email</label>
                                   <input type="email" id="mail" class="form-control" name="Email" placeholder="Email" required >
                                </div>
                                <div class="col-sm-6">
                                    <label>Address</label>
                                    <input type="text" id="add" class="form-control" name="Address" placeholder="Address" required >
                                </div>
                                <div class="col-sm-6">
                                    <label>Website Address</label>
                                    <input type="text" id="web" class="form-control" name="web" placeholder="Website Address" required >
                                </div>
                                <div class="col-sm-6">
                                    <label>Insert company Logo</label>
                                    <p class="text-pink" id="err1" style="display: none;">Plsease insert jpg/jpeg/png formate</p>
                                    <input id="fl1" type="file" onblur="checkfile(this)" class="filestyle"  data-placeholder="Not more than 1MB" data-buttonname="btn-secondary" name="cmplogo">
                                </div>

                                <div class="col-sm-12">
                                    <h2>Edit Mail Server Settings</h2><br>
                                    <hr>
                                </div>
                                <div class="col-sm-8">
                                    <label>HOST Server</label>
                                    <input type="text" id="host" class="form-control" name="host" placeholder="HOST Server" required >
                                </div>  
                                <div class="col-sm-2">
                                    <label>SMTP Port</label>
                                    <input type="number" id="port" class="form-control" name="port" placeholder="SMTP Port" required >
                                </div>
                                <div class="col-sm-2">
                                    <label>SMTP Secure</label>
                                    <input type="text" id="ssl" class="form-control" name="ssl" placeholder="SMTP Secure" required >
                                </div>
                                <div class="col-sm-6">
                                    <label>Username</label>
                                    <input type="text" id="uname" class="form-control" name="username" placeholder="Username" required >
                                </div>
                                <div class="col-sm-6">
                                    <label>Password</label>
                                   <input type="text" id="pass" class="form-control" name="pass" placeholder="Password" required >
                                </div>

                                <div class="col-sm-12">
                                    <br>
                                    <a onclick="openSetting(4)" class="btn btn-danger pull-right">Close</a>
                                    
                                    <button type="submit" class="btn btn-success pull-right" name="cmpUpbtn">Save</button>
                                </div>
                            </div>
                        </form>

                        <!-- end row -->
                        <form id="Signatory" action="../clientEntry.php" method="POST" enctype="multipart/form-data" style="display: none;">
                            <div class="row card-box">
                                <div class="col-sm-12">
                                    <h2>Add Signatory</h2><br>
                                    <hr>
                                </div>
                                <div class="col-sm-6">
                                    <label>Name: </label>
                                    <input type="text" class="form-control" name="signame" placeholder="Name" required=".jpg,.JPG,.jpeg,.JPEG,.png,.PNG" >
                                </div>
                                <div class="col-sm-6">
                                                        <label for="numEmployee">Designation</label>
                                                        <select class="selectpicker show-tick" name="designation">
                                                            <option disabled selected>Select</option>
                                                            <option value="Chairman">Chairman</option>
                                                            <option value="CEO">CEO</option>
                                                            <option value="Production Manager">Production Manager</option>
                                                            <option value="Project Manager">Project Manager</option>
                                                            <option value="Creative Head">Creative Head</option>
                                                            <option value="Software Engineer">Software Engineer</option>
                                                            <option value="Sr. Developer">Sr. Developer</option>
                                                            <option value="Jr. Developer">Jr. Developer</option>
                                                            <option value="Intern">Intern</option>
                                                            <option value="Sr. Designer">Sr. Designer</option>
                                                            <option value="Creative Executive">Creative Executive</option>
                                                            <option value="Business Development Executive">Business Development Executive</option>
                                                            <option value="Sales Executive">Sales Executive</option>
                                                            <option value="Sr. Sales Executive">Sr. Sales Executive</option>
                                                            <option value="Jr. Sales Executive">Jr. Sales Executive</option>
                                                        </select>
                                                    </div> 
                                <div class="col-sm-6">
                                    <label>Insert Signature</label>
                                    <p class="text-pink" id="err2" style="display: none;">Plsease insert jpg/jpeg/png formate</p>
                                    <input id="fl2" type="file" onblur="checkfile(this)" class="filestyle"  data-placeholder="Not more than 1MB" data-buttonname="btn-secondary" name="sig">
                                </div>
                                <div class="col-sm-12">
                                    <br>
                                    <a onclick="openSetting(4)" class="btn btn-danger pull-right">Close</a>
                                    
                                    <button type="submit" class="btn btn-success pull-right" name="sigbtn">Save</button>
                                </div>
                            </div>
                        </form>
                        <!-- end row -->
                        <div class="row card-box" id="cmpinfo" style="display: none;">
                            <div class="col-sm-12">
                                <button class="btn btn-danger pull-right" onclick="del()">Delete</button>
                                <button class="btn btn-secondary pull-right" onclick="edit()">Edit</button>
                            </div>
                            <div class="col-sm-12">
                                <h3>Company Info</h3>
                                <hr>
                            </div>
                            <div class="col-sm-6">
                               <h6>Company Name: <label id="name1"></label></h6>
                            </div>
                            <div class="col-sm-6">
                                <h6>Cell: <label id="cell1"></label></h6>
                            </div>
                            <div class="col-sm-6">
                                <h6>Email: <label id="mail1"></label></h6>
                            </div>
                            <div class="col-sm-6">
                                <h6>Address: <label id="add1"></label></h6>
                            </div>
                            <div class="col-sm-6">
                                <h6>Web Address: <label id="web1"></label></h6>
                            </div>
                            <div class="col-sm-6">
                                <h6>Date: <label id="date"></label></h6>
                            </div>
                            <div class="col-sm-12">
                                <h3>Mail Server</h3>
                                <hr>
                            </div>
                            <div class="col-sm-6">
                                <h6>Host: <label id="host1"></label></h6>
                            </div>
                            <div class="col-sm-6">
                                <h6>Username: <label id="uname1"></label></h6>
                            </div>
                            <div class="col-sm-6">
                                <h6>Password: <label id="pass1"></label></h6>
                            </div>
                            <div class="col-sm-6">
                                <h6>SMTP Port: <label id="port1"></label></h6>
                            </div>
                            <div class="col-sm-6">
                                <h6>SSL: <label id="ssl1"></label></h6>
                            </div>
                            <div class="col-sm-12">
                                <br>
                                <button onclick="openSetting(4)" class="btn btn-danger pull-right">Close</button>
                            </div>

                        </div>

                        <!-- end row -->

                </div> <!-- container -->
            </div> <!-- content -->

<script type="text/javascript">
    var cs = 0;
    var fsize = 0;
    $('#fl').bind('change', function() {
        fsize = this.files[0].size/1024;    
    });
    $('#fl1').bind('change', function() {
        fsize = this.files[0].size/1024;    
    });
    $('#fl2').bind('change', function() {
        fsize = this.files[0].size/1024;    
    });
    function checkfile(f) {
        var x = f.value
        var name = x.split('.');
        var ar = ['jpg','jpeg','png'];
        var len = name.length;
        if (ar.includes(name[len-1].toLowerCase()) && fsize <= 1024) {
            document.getElementById('err').style.display = 'none';
            document.getElementById('err1').style.display = 'none';
            document.getElementById('err2').style.display = 'none';
            document.getElementById('compBtn').disabled = false;
            fsize = 0;
        } 
        else{
            if (cs == 1) {
                document.getElementById('err').style.display = '';
            } 
            if (cs == 2) {
                document.getElementById('err1').style.display = '';
            } 
            if (cs == 3) {
                document.getElementById('err2').style.display = '';
            }
            fsize = 0;
        }
        
        
    }
    function edit() {
       document.getElementById('Mail').style.display='';
       document.getElementById('cmpinfo').style.display='none';
    }

    function del() {
        var id = document.getElementById('ids').value;
        location.href = '../delete.php?key=del&id='+id;
    }
    function openSetting(id) {
    switch(id) {
    case 1:{
        document.getElementById('Company').style.display='';
        document.getElementById('cmpinfo').style.display='none';
        document.getElementById('Signatory').style.display='none';
        cs = 1;
       break; 
    }

        
    case 2:{
        document.getElementById('Company').style.display='none';
        document.getElementById('cmpinfo').style.display='';
        document.getElementById('Signatory').style.display='none';
        cs = 2;
        active();
        break;
    }

        break;
    case 3:{
        document.getElementById('Company').style.display='none';
        document.getElementById('cmpinfo').style.display='none';
        document.getElementById('Signatory').style.display='';
        cs = 3;
        break;
    }

       
    default:
        document.getElementById('Company').style.display='none';
        document.getElementById('cmpinfo').style.display='none';
        document.getElementById('Signatory').style.display='none';
        document.getElementById('Mail').style.display='none';
        
    }
}

    function active() {
        
        // $("#product").empty();
        var cid = document.getElementById("slt").value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // console.log(this.responseText);
                if(this.responseText){
                    var jsn = JSON.parse(this.responseText);
                    document.getElementById('host').value = jsn.serverhost; 
                    document.getElementById('port').value = jsn.smtpPort; 
                    document.getElementById('ssl').value = jsn.serverSSL; 
                    document.getElementById('uname').value = jsn.username; 
                    document.getElementById('pass').value = jsn.password; 
                    document.getElementById('name').value = jsn.companyName; 
                    document.getElementById('cell').value = jsn.cmpCell; 
                    document.getElementById('mail').value = jsn.cmpEmail; 
                    document.getElementById('add').value = jsn.address; 
                    document.getElementById('web').value = jsn.web; 
                    document.getElementById('ids').value = jsn.cmpId;

                    document.getElementById('host1').innerHTML = jsn.serverhost; 
                    document.getElementById('port1').innerHTML = jsn.smtpPort; 
                    document.getElementById('ssl1').innerHTML = jsn.serverSSL; 
                    document.getElementById('uname1').innerHTML = jsn.username; 
                    document.getElementById('pass1').innerHTML = jsn.password; 
                    document.getElementById('name1').innerHTML = jsn.companyName; 
                    document.getElementById('cell1').innerHTML = jsn.cmpCell; 
                    document.getElementById('mail1').innerHTML = jsn.cmpEmail; 
                    document.getElementById('add1').innerHTML = jsn.address; 
                    document.getElementById('web1').innerHTML = jsn.web; 
                    document.getElementById('date').innerHTML = jsn.datetime; 
                }
                else{
                    document.getElementById('name').value = ''; 
                    document.getElementById('cell').value = ''; 
                    document.getElementById('mail').value = ''; 
                    document.getElementById('add').value = ''; 
                    document.getElementById('web').value = ''; 
                    document.getElementById('ids').value = '';
                    document.getElementById('host').value = ''; 
                    document.getElementById('port').value = ''; 
                    document.getElementById('ssl').value = ''; 
                    document.getElementById('uname').value = ''; 
                    document.getElementById('pass').value = ''; 
                    document.getElementById('ids').value = '';
                }
            }
        };
        xmlhttp.open("GET", "../allList.php?key=setup&companyid="+cid, true);
        xmlhttp.send();

    }


</script>
<style type="text/css">
    label{
        font-size: 15px;
    }
    button{
        width: 185px;
    }
</style>
<?php 
include 'userFooter.php'; 
?>