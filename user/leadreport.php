<?php 
include 'adminHeader.php';
include '../allList.php';
$obj=new newList();
$sql= "SELECT cmpName,cdatetime FROM customerinfo_tb WHERE LtoC = 1 ORDER BY cdatetime";
$tkt1 = $obj->allSql($sql);
$tkt2 = $obj->limitOne('SELECT MAX(cdatetime) mx, MIN(cdatetime)mn FROM customerinfo_tb');
// $row=$obj->all("");
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
                                    <h4 class="page-title float-left">Lead To Customer</h4>

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
                                                <th>Year</th>
                                                <th>January</th>
                                                <th>February</th>
                                                <th>March</th>
                                                <th>April</th>
                                                <th>May</th>
                                                <th>June</th>
                                                <th>July</th>
                                                <th>August</th>
                                                <th>September</th>
                                                <th>October</th>
                                                <th>November</th>
                                                <th>December</th>
                                           </thead>

<?php
    $month = array();
    foreach ($tkt1 as $key) {
        $ndate = explode(' ', $key["cdatetime"]);
        $date = explode('-', $ndate[0]);
        if (empty($month[$date[0]][$date[1]])) {
            $month[$date[0]][(int)$date[1]] = 1;
        }
        else{
            $month[$date[0]][$date[1]] += 1;
        }
    }
    $ndate = explode(' ', $tkt2["mx"]);
    $mx = explode('-', $ndate[0]);

    $ndate = explode(' ', $tkt2["mn"]);
    $mn = explode('-', $ndate[0]);

    for ($i=$mn[0]; $i <= $mx[0]; $i++) {
        echo "<tr>";
        echo '<td>'.$i.'</td>';
          for ($j=1; $j <=12 ; $j++) {
            if (empty($month[$i][$j])) {
               echo '<td>0</td>';
            }
            else
                echo '<td>'.$month[$i][$j].'</td>';
          }
        echo "</tr>";
    }
?>
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
<?php
 include 'userFooter.php'; ?>
