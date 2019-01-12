<?php 
$cust_ticket = new newList();
//queued and answede
$sql= "SELECT * FROM ticketlist_tb t LEFT JOIN customerproduct_tb c ON t.cpId = c.cpId WHERE c.customerId = :id AND NOT t.status = 'Closed' ORDER BY t.status ASC,t.tSerial DESC ";
$tkt1 = $cust_ticket->Fun($sql,':id',$_SESSION["userId"]);

//closed tickets
$sql= "SELECT * FROM ticketlist_tb t LEFT JOIN customerproduct_tb c ON t.cpId = c.cpId WHERE c.customerId = :id AND t.status = 'Closed' ORDER BY t.tId DESC ";
$tkt2 = $cust_ticket->Fun($sql,':id',$_SESSION["userId"]);
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
                                  <div class="row m-t-20">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4">
                                      <label><font size="6">My Support Tickets</font></label>
                                    </div>
                                    <div class="col-sm-4"></div>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->  

                        <div class="card-box">

                            <div class="row m-t-20">
                                <div class="col-sm-12">
                                       <table id="demo-foo-filtering" class="table table-striped table-bordered toggle-circle m-b-0" data-page-size="7">
                                           <thead>
                                               <tr>
                                                <th>No.</th>
                                                <th>Serial</th>
                                                <th>Priority</th>
                                                <th>Title</th>
                                                <th>Status</th>
                                                <th>Last Updated</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                            <?php $cnt = 1;  foreach ($tkt1 as $key) { ?>
                                              <tr>
                                                 <td><?php echo $cnt; ?></td>
                                                 <td><?php echo $key["tSerial"]; ?></td>
                                                 <td><?php echo $key["priority"]; ?></td>
                                                 <td><?php echo $key["title"]; ?></td>
                                                 <td>
                                                  <form action="Dashboard.php?page=convTicket" method="post">
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
                                               </tr>
                                            <?php $cnt++; } ?>
                                            <?php foreach ($tkt2 as $key) { ?>
                                              <tr>
                                                 <td><?php echo $cnt; ?></td>
                                                 <td><?php echo $key["tSerial"]; ?></td>
                                                 <td><?php echo $key["priority"]; ?></td>
                                                 <td><?php echo $key["title"]; ?></td>
                                                 <td>
                                                  <form action="Dashboard.php?page=convTicket" method="post">
                                                   <input type="hidden" name="check" value="<?php echo $key["tId"].'_'.$key["status"] ?>">
                                                  <?php $st = $key["status"]; 
                                                      echo '<button type="submit" class="btn btn-inverse btn-sm" name="conTicket">'.$key["status"].'</button>';
                                                  ?>
                                                  </form>
                                                 </td>
                                                 <td><?php  $date = explode(' ', $key["datetime"]); echo $date[0]; ?></td>
                                               </tr>
                                            <?php $cnt++; } ?>
                                           </tbody>
                                       </table>
                                </div>
                        </div>

                     </div>
                </div> <!-- container -->
            </div> <!-- content -->

<style type="text/css">
  .dt-buttons.btn-group {
    display: none;
}
</style>