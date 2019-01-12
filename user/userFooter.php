
                <footer class="footer text-right">
                    CRM SYSTEM © ThemeLine Comunication.
                </footer>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
        <!-- jQuery  -->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/popper.min.js"></script><!-- Popper for Bootstrap -->
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/metisMenu.min.js"></script>
        <script src="../assets/js/waves.js"></script>
        <script src="../assets/js/jquery.slimscroll.js"></script>

        <script src="../assets/plugins/switchery/switchery.min.js"></script>
        <script src="../assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js"></script>
        <script src="../assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/bootstrap-select/js/bootstrap-select.js" type="text/javascript"></script>
        <script src="../assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

        <script type="text/javascript" src="../assets/plugins/autocomplete/jquery.mockjax.js"></script>
        <script type="text/javascript" src="../assets/plugins/autocomplete/jquery.autocomplete.min.js"></script>
        <script type="text/javascript" src="../assets/plugins/autocomplete/countries.js"></script>
        <script type="text/javascript" src="../assets/pages/jquery.autocomplete.init.js"></script>

        <!-- Required datatable js -->
        <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="../assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.bootstrap4.min.js"></script>
        <script src="../assets/plugins/datatables/jszip.min.js"></script>
        <script src="../assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="../assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="../assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="../assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="../assets/plugins/datatables/responsive.bootstrap4.min.js"></script>

        <!-- Init Js file -->
        <script type="text/javascript" src="../assets/pages/jquery.form-advanced.init.js"></script>

        <!-- App js -->
        <!-- <script src="../assets/js/jquery.core.js"></script> -->
        <script src="../assets/js/jquery.app.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').DataTable();

                //Buttons examples
                var table = $('#datatable-buttons').DataTable({
                    lengthChange: true,
                    buttons: [
                    {
                    extend: 'pdf',
                    text: 'Export as PDF'
                },

                    ]
                });

                table.buttons().container()
                        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
            } );

        </script>

        <!--Wysiwig js-->
        <script src="../assets/plugins/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                if($("#desc").length > 0){
                    tinymce.init({
                        selector: "textarea#desc",
                        theme: "modern",
                        height:100,
                        plugins: [
                            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                            "save table contextmenu directionality emoticons template paste textcolor"
                        ],
                        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ",
                        style_formats: [
                            {title: 'Bold text', inline: 'b'},
                            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                            {title: 'Example 1', inline: 'span', classes: 'example1'},
                            {title: 'Example 2', inline: 'span', classes: 'example2'},
                            {title: 'Table styles'},
                            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                        ]
                    });
                }
            });
        </script>

        <!-- add more contact js -->
<script type="text/javascript">
        $(document).ready(function(){
            var x= 0;
            var html='<div class="row m-t-20"><legend><h6> New Contact <a id="remove" class="btn btn-danger btn-sm">X</a></h6></legend><div class="col-sm-6"><div class="form-group"><label for="conPerName">Name</label><input id="childname" type="text" class="form-control" placeholder="Full Name" name="cntPerName[]" required=""></div><div class="form-group"><label for="cell">Phone Number</label><input id="childcell" type="text" class="form-control" name="cntCell[]" required=""></div></div><div class="col-sm-6"><div class="form-group"><label for="aboutme">E-mail</label><input id="childmail" type="email" class="form-control" name="cntEmail[]" required=""></div><div class="form-group"><label>Linkdin</label><div class="input-group"><span class="input-group-addon"></span><input id="childurl" type="text" class="form-control" placeholder="Linkdin url" name="cntLin[]"></div></div></div></div>';
        
                $("#add").click(function() {
                    $("#container").append(html);  
                });

                $("#container").on('click','#remove',function(){
                    $(this).closest('div').remove();
                });

            });
</script>

    </body>
</html>
<style type="text/css">
    
    a.btn.btn-secondary.buttons-pdf.buttons-html5 {
    margin-left: 30px;
    background-color: blueviolet;
    color: #fff;
    }
/*navigation bar*/
/*    .navbar-custom {
        background-color: #7bc0c7;
    }*/
    ul.list-inline.menu-left.mb-0 {
    display: none;
    }
/*left panel*/
/*    div#remove-scroll {
    background-color: blue;
    }*/
    .page-title-box {
    background-color: #ffffff;
    }
</style>

