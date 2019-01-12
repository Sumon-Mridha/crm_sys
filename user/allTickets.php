
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
                                    <h4 class="page-title float-left">Tickets</h4>

                                    <ol class="breadcrumb float-right">
                                    
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->  
                        <div id="expenditure" class="card-box">
                            <div class="row m-t-20">
                                <div class="col-sm-12">
                                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                           <thead>
                                               <tr>
                                                <th>No.</th>
                                                <th>Serial</th>
                                                <th>Company Name</th>
                                                <th>Priority</th>
                                                <th>Title</th>
                                                <th>Status</th>
                                                <th>Last Updated</th>
                                                <th>Action</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                            <?php $cnt = 1;  foreach ($tkt1 as $key) { ?>
                                              <tr>
                                                 <td><?php echo $cnt; ?></td>
                                                 <td><?php echo $key["tSerial"]; ?></td>
                                                 <td><?php echo $key["cmpName"]; ?></td>
                                                 <td><?php echo $key["priority"]; ?></td>
                                                 <td><?php echo $key["title"]; ?></td>
                                                 <td>
                                                  <form action="tickets.php?page=convTicket" method="post">
                                                   <input type="hidden" name="check" value="<?php echo $key["tId"].'_'.$key["status"] ?>">
                                                  <?php $st = $key["status"]; 
                                                  if ($st == 'Queued') {
                                                      echo '<button type="submit" class="btn btn-warning btn-sm" name="conTicket">'.$key["status"].'</button>';
                                                    }
                                                   elseif ($st == 'Answered') {
                                                      echo '<button type="submit" class="btn btn-success btn-sm" name="conTicket">'.$key["status"].'</button>';
                                                   }
                                                   else{
                                                      echo '<button class="btn btn-inverse btn-sm" name="conTicket" disabled>'.$key["status"].'</button>';
                                                   }
                                                  ?>
                                                  </form>
                                                 </td>
                                                 <td><?php  $date = explode(' ', $key["seen"]); echo 'DATE: '. $date[0]; echo '<br>TIME: '. $date[1];?></td>
                                                 <td>
                                                   <button class="btn btn-danger btn-sm" onclick="del(<?php echo $key["tId"] ?>)">Delete</button>
                                                 </td>
                                               </tr>
                                            <?php $cnt++; } ?>
                                            <?php foreach ($tkt2 as $key) { ?>
                                              <tr>
                                                 <td><?php echo $cnt; ?></td>
                                                 <td><?php echo $key["tSerial"]; ?></td>
                                                 <td><?php echo $key["cmpName"]; ?></td>
                                                 <td><?php echo $key["priority"]; ?></td>
                                                 <td><?php echo $key["title"]; ?></td>
                                                 <td>
                                                  <form action="tickets.php?page=convTicket" method="post">
                                                   <input type="hidden" name="check" value="<?php echo $key["tId"].'_'.$key["status"] ?>">
                                                  <?php $st = $key["status"]; 
                                                      echo '<button type="submit" class="btn btn-inverse btn-sm" name="conTicket">'.$key["status"].'</button>';
                                                  ?>
                                                  </form>
                                                 </td>
                                                 <td><?php  $date = explode(' ', $key["seen"]); echo $date[0]; ?></td>
                                                 <td>
                                                   <button class="btn btn-danger btn-sm" onclick="del(<?php echo $key["tId"] ?>)">Delete</button>
                                                 </td>
                                               </tr>
                                            <?php $cnt++; } ?>
                                           </tbody>
                                       </table>
                                </div>
                            </div> 
                        </div>
                </div> <!-- container -->
            </div> <!-- content -->

<script type="text/javascript">
  function del(tid) {
    location.href='../delete.php?key=delt&tid='+tid;
  }

</script>