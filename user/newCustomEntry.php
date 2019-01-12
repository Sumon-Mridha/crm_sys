<?php 

include 'userHeader.php';
include '../allList.php';
$obj=new newList();
$row=$obj->all("product_tb")

?>


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container-fluid">
                     <!-- Basic Form Wizard -->
                        <div class="row card-box">
                            <div class="col-md-12">
                                    <form id="default-wizard" action="../clientEntry.php" method="POST">

                                        <fieldset >
                                             <div class="modal-header">
                                                   <legend>Company Information</legend>
                                            </div>
                                            
                                            <div class="row m-t-20">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="companyName">Company Name</label>
                                                        <input type="text" class="form-control" placeholder="" name="cmpName" required="">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="aboutme" >Contact</label>
                                                        <input type="text" class="form-control" name="cmpCell" required="">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="aboutme" >E-mail</label>
                                                        <input type="email" class="form-control" name="cmpEmail" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="webAddress">Web Address</label>
                                                        <input type="text" class="form-control"placeholder="" name="cmpWeb" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="area">Area</label>
                                                        <input type="text" class="form-control" placeholder="City" name="cmpArea" required="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                     <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <textarea class="form-control" rows="6"name="cmpAddress" required=""></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="revenue">Yearly Revenue</label>
                                                        <input type="number" class="form-control" placeholder="" name="cmpRevenue" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="establishment">Year of Establishment</label>
                                                        <input type="text" class="form-control" placeholder="" name="cmpEstablishment">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="numEmployee">Number of Employees</label>
                                                        <input type="number" class="form-control" placeholder="" name="numEmployee">
                                                    </div>

                                                </div>
                                            </div>

                                        </fieldset>

                                        <fieldset>
                                             <div class="modal-header">
                                                <legend>Product</legend>
                                            </div>
                                            <div class="row m-t-20">
                                                <div class="col-sm-6">
                                                    <div class="form-group">

                                                    <label for="numEmployee">Add Product</label>
                                                    <select class="selectpicker show-tick" name="product">
            <?php
            foreach ($row as $key) {
                                                     echo'<option value="'.$key["productId"].'">'.$key["productName"].'</option>';
            }
            ?>                                       

                                                    </select>
                                        
                                                </div>
                                                <div class="form-group">
                                                    <label>Product Title</label>
                                                    <input type="text" class="form-control" name="title" required>
                                                </div>

                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Cost</label>
                                                        <input type="number" class="form-control" name="cost" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="numEmployee">Payment Method</label>
                                                        <select class="selectpicker show-tick" name="payMethod">
                                                            <option value="Monthly">Monthly</option>
                                                            <option value="Ad Hoc">Ad Hoc</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>



                                        <fieldset id="container">
                                             <div class="modal-header">
                                                   <legend>Contact Person</legend>
                                            </div>
                                            
                                            <div class="row m-t-20">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="conPerName">Name</label>
                                                            <input id="name" type="text" class="form-control" placeholder="Full Name" name="cntPerName[]" required="">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="cell">Phone Number</label>
                                                            <input id="cell" type="text" class="form-control" name="cntCell[]" required="">
                                                        </div>


                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="aboutme">E-mail</label>
                                                            <input id="mail" type="email" class="form-control" name="cntEmail[]" required="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Linkdin</label>
                                                            <div class="input-group">
                                                                <span class="input-group-addon"></span>
                                                                <input id="url" type="text" class="form-control" placeholder="Linkdin url" name="cntLin[]">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        <div class="row m-t-20">
                                            <div class="col-sm-12">
                                                 <a id="add" class="btn btn-primary" style="width: 100%" >Add More Contact Person</a><br><br><br>
                                            </div>
                                        </div>

                                        <fieldset>
                                             <div class="modal-header">
                                                    <legend>Reference</legend>
                                            </div>
                                            <div class="row m-t-20">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="conPerName">Name</label>
                                                        <input type="text" class="form-control" placeholder="Full Name" name="refPerName" required="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                   <div class="form-group">
                                                        <label for="cell">Phone Number</label>
                                                        <input type="text" class="form-control" name="refCell" required="">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="row m-t-20">
                                            <div class="col-sm-10"></div>
                                            <div class="col-sm-1">
                                               <button type="submit" class="btn btn-success stepy-finish" name="btn">Submit</button> 
                                            </div>
                                            <div class="col-sm-1">                    
                                                <a href="customer.php" class="btn btn-danger stepy-finish" name="btn">Close</a>
                                            </div>
                                        </div>
                                            
                                      
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- End row -->
                    </div> <!-- container -->

                </div> <!-- content -->


<?php include 'userFooter.php'; ?>
