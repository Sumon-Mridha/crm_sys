                                <form id="default-wizard"  action="../leadEntry.php" method="POST">
                                         <div class="modal-body">

                                        <fieldset>
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
                                                        <label for="companyName">E-mail</label>
                                                        <input type="email" class="form-control" placeholder="" name="cmpEmail" required="">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="companyName">Company Cell</label>
                                                        <input type="text" class="form-control" placeholder="" name="cmpCell" required="01" maxlength="11" minlength="11">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="address">Address</label>
                                                        <textarea class="form-control" rows="3"name="cmpAddress" required=""></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="area">Area</label>
                                                        <input type="text" class="form-control" placeholder="City" name="cmpArea" required="">
                                                    </div>


                                                    
                                                    
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="webAddress">Web Address</label>
                                                        <input type="text" class="form-control" placeholder="" name="cmpWeb" required="">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="revenue">Yearly Revenue</label>
                                                        <input type="number" class="form-control" placeholder="" name="cmpRev">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="establishment">Year of Establishment</label>
                                                        <input type="text" class="form-control" placeholder="" name="cmpEst">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="numEmployee">Number of Employees</label>
                                                        <input type="number" class="form-control" placeholder="" name="cmpEmp">
                                                    </div>
                                                     <div class="form-group">
                                                        <label for="numEmployee">Payment Method</label>
                                                        <select class="selectpicker show-tick" name="cmpPay">
                                                            <option value="Monthly">Monthly</option>
                                                            <option value="Ad Hoc">Ad Hoc</option>
                                                        </select>
                                                    </div>                                                   
                                                    <div class="form-group">
                                                        <label for="tagPlaces">Tag Places</label>
                                                        <div class="tags-default">
                                                            <input type="text"  class="form-control" data-role="tagsinput" placeholder="add tags" name="tag">
                                                        </div>
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
                                                            <input id="cell" type="text" class="form-control" name="cntCell[]" required="01" maxlength="11" minlength="11">
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
                                                 <a id="add" class="btn btn-success" style="width: 100%" >Add More Contact Person</a>
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
                                                        <input type="text" class="form-control" placeholder="Full Name" name="refName">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                   <div class="form-group">
                                                        <label for="cell">Phone Number</label>
                                                        <input type="text" class="form-control" name="refCell" required="01" maxlength="11" minlength="11">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>

                                       <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-info waves-effect waves-light" name="btna">Save</button>
                                                </div>
                                       </div>
                                    </form>