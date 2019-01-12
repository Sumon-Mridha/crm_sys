                                    <div id="con-close-modal" class="modal fade" tabindex="-1" role="form" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                                    <h4 class="modal-title">NEW USER FORM</h4>
                                                </div>
                                                
                                    <form id="default-wizard" onsubmit="confirmInput()" action="../clientEntry.php" method="POST">
                                         <div class="modal-body">

                                        <fieldset>
                                                <div class="modal-header">
                                                    <legend>User Information</legend>
                                                </div>
                                            <div class="row m-t-20">
                                                <div class="col-sm-4"></div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="numEmployee">User Type</label>
                                                        <select class="selectpicker show-tick" name="type">
                                                            <option value="User">User</option>
                                                            <option value="Admin">Admin</option>
                                                        </select>
                                                    </div> 
                                                </div>
                                                <div class="col-sm-4"></div>
                                            </div>


                                            <div class="row m-t-20">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="companyName">Full Name</label>
                                                        <input type="text" class="form-control" placeholder="" name="fName" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="numEmployee">Designation</label>
                                                        <select class="selectpicker show-tick" name="designation">
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

                                                    <div class="form-group">
                                                        <label for="companyName">Cell</label>
                                                        <input type="text" class="form-control" placeholder="" name="cell" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="address">Company ID</label>
                                                        <input type="text" class="form-control" placeholder="" name="id" required>
                                                    </div>
                             
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="companyName">E-mail</label>
                                                        <input type="email" class="form-control" placeholder="" name="mail" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="establishment">Password</label>
                                                        <input type="Password" id="pas1" class="form-control" placeholder="" name="password" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <p class="text-pink" id="err" style="display: none;">Password doesn't matched..!!</p>
                                                        <label for="numEmployee" >Confirm Password</label>
                                                        <input type="Password" id="pas2" onblur="checkPass()" class="form-control" placeholder="" required>
                                                    </div>
                                                     <div class="form-group">
                                                        <label for="numEmployee">Company Name</label>
                                                        <select class="selectpicker show-tick" name="cmpId">
<?php foreach ($cmp as $key2) {?> 
                            <?php echo'<option value="'.$key2["cmpId"].'" >'.$key2["companyName"].'</option>'; ?>
<?php } ?>
                                                        </select>
                                                    </div>                                                                                                  
                                                </div>
                                            </div>


                                        </fieldset>

                                       <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                    <button id="sbt" type="submit" class="btn btn-info waves-effect waves-light" name="userEntry" disabled>Save</button>
                                                </div>
                                       </div>
                                    </form>


                                            </div>
                                        </div>
                                    </div>

<script type="text/javascript">
   function checkPass(){
   var x = document.getElementById('pas1').value;
   var y = document.getElementById('pas2').value;
   console.log(x,y);
       if(x!=y){
            document.getElementById('err').style.display='';
            document.getElementById('sbt').disabled = true;
       }
       else{
            document.getElementById('err').style.display='none';
            document.getElementById('sbt').disabled = false;

       }
    }
    function confirmInput() {
    var x = document.getElementById('pas1').value;
    var y = document.getElementById('pas2').value;
        if(x!=y){
           var fr = document.getElementById('default-wizard');
           fr.setAttribute('action',"#");
           alert('Something went worng....');

        }
        else{
             var fr = document.getElementById('default-wizard');
               fr.setAttribute('action',"../clientEntry.php");
        }
    }
</script>