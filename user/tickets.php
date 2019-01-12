<?php 
include 'adminHeader.php';
include '../check.php';
$obj=new newList();
$sql= "SELECT cm.cmpName,n.tId,n.tSerial,n.priority,n.status,n.seen,n.customerId,n.title FROM (SELECT t.tId,t.tSerial,t.priority,t.status,t.seen,c.customerId,c.title FROM ticketlist_tb t LEFT JOIN customerproduct_tb c ON t.cpId = c.cpId WHERE NOT t.status = 'Closed') n LEFT JOIN customerinfo_tb cm ON n.customerId=cm.customId ORDER BY n.status DESC,n.tSerial DESC  ";
$tkt1 = $obj->allSql($sql);
$sql="SELECT cm.cmpName,n.tId,n.tSerial,n.priority,n.status,n.seen,n.customerId,n.title FROM (SELECT t.tId,t.tSerial,t.priority,t.status,t.seen,c.customerId,c.title FROM ticketlist_tb t LEFT JOIN customerproduct_tb c ON t.cpId = c.cpId WHERE t.status = 'Closed') n LEFT JOIN customerinfo_tb cm ON n.customerId=cm.customId ORDER BY n.tId DESC";
$tkt2 = $obj->allSql($sql);
// $row=$obj->all("");

if (isset($_GET['page'])) {
    include '../client/'.$_GET['page'].'.php';
}else
    include 'allTickets.php'; 

 include 'userFooter.php'; ?>
