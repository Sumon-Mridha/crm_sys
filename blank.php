<?php 

//pdf viewing function

 function viewPdf($filename)
    {
        
        $path = 'uploads/attachments/'.$filename;
        header('Content-type:application/octet-stream');
        header('Content-Disposition:inline; filename="'.$filename.'"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges:bytes');
        @readfile($path);
    }
    
if (isset($_REQUEST['openAt']) && isset($_POST['opena'])) {
	$filename = $_POST['opena'];
	viewPdf($filename);
	echo "<script>window.close();</script>";
	// header('location:uploads/attachments/'.$filename);
}
else
	header('location:index.php');