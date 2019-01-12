<?php
include '../OAuth/Security.php';
 function viewPdf($filename)
    {
        $path = '../uploads/invoices/'.$filename.'';
        header('Content-type:application/pdf');
        header('Content-Disposition:inline; filename="'.$filename.'"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges:bytes');
        @readfile($path);
    }
if (isset($_GET['new']) && $_GET['ser']) {
	$serial = scrypt($_GET['ser'],'D');
	viewPdf($serial.'.pdf');
}
else
	header('location:../index.php');

