                                <div id="con-close-modal" class="modal fade" tabindex="-1" role="form" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                                <h4 class="modal-title">NEW PRODUCT FORM</h4>
                                            </div>
                                            <form id="default-wizard"  action="../clientEntry.php" method="POST">
                                                <div class="modal-body">
                                                    <div class="modal-header">
                                                        <legend>Product Information</legend>
                                                    </div>

                                                    <div class="row m-t-20">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Name</label>
                                                                <input type="text" class="form-control" placeholder="" name="name" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label>Type</label>
                                                                <input type="text" class="form-control" placeholder="" name="type" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Description</label>
                                                               <textarea class="form-control" rows="3" name="description"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-info waves-effect waves-light" name="productEntry">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>  
                                        </div>
                                    </div>
                                </div>