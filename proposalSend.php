<?php
include 'allList.php';
// require 'OAuth/PHPmailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'OAuth/PHPMailer-master/PHPMailer-master/src/Exception.php';
require 'OAuth/PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require 'OAuth/PHPMailer-master/PHPMailer-master/src/SMTP.php';
include 'Session.php';
$sn= new Session();
$sn->init();
class fileUploadDb extends Database{
	private $conn;
	
	function __construct()
	{
		$this->conn= $this->openConnection();
	}

		// random function is for creating random string
	function random($x){
		$str = null;
		for($i=0;$i<$x;$i++)
		{
			if($i*3%5==0){
				$c = chr(65+(rand(100,10000)%26));
				$str =	$str.$c;
			}
			else{
				$c = chr(97+(rand(100,10000)%26));
				$str =	$str.$c;
			}
		}
		return $str;
	}

	public function lastRow()
	{
		$sql="SELECT * FROM proposal_tb ORDER BY proposalId DESC LIMIT 1";
		$dsn=$this->conn->prepare($sql);
		if($dsn->execute()){
				while($row=$dsn->fetch()){
					return $row;
				}		

			}
	}


	public function upFile($val,$path)
	{
		date_default_timezone_set("Asia/Dhaka");
		$target_dir="uploads/".$path;
		$fileName=$_FILES[$val]["name"];
		$file_tmp=$_FILES[$val]["tmp_name"];
		$exp = explode(".",$fileName);
		$type = end($exp);
		$type = strtolower($type);
		$arr = ['pdf'];
		// echo $type;
		$date=date('d-m-Y').'.'.strftime("%H-%M");
		$newName=$date.'.'.$this->random(15).'.'.$type;
		// echo $newName;
		// rename($fileName,$newName);
		if (in_array($type, $arr)) {
				$target_file = $target_dir.$newName; 
				if(move_uploaded_file($file_tmp, $target_file)){
					return $newName;
				}
		
		} else {
			echo "error";
		}
	}

	public function prosposalInsert($name,$id,$type,$title,$serial,$cid,$des){
		if($type=='c'){

			$sql="INSERT INTO proposal_tb (propName,customId,propTitle,description,propSerial,companyId) VALUES(:name,:id,:title,:des,:srl,:cid)";
		}
		else{
			$sql="INSERT INTO proposal_tb (propName,leadId,propTitle,description,propSerial,companyId) VALUES(:name,:id,:title,:des,:srl,:cid)";
		}
		
		$dsn = $this->conn->prepare($sql);
		$dsn->bindValue(':name',$name);
		$dsn->bindValue(':id',$id);
		$dsn->bindValue(':title',$title);
		$dsn->bindValue(':des',$des);
		$dsn->bindValue(':srl',$serial);
		$dsn->bindValue(':cid',$cid);
		if($dsn->execute()){
			return "done";
		}

	}

	function __destruct(){
			$this->closeConnection();
		}

}

//end of the class
/*
// mail sending function
	function sendMail($sub,$des,$eml,$file='',$cmpID){

	$obj = new newList();
	$sql = "SELECT * FROM companyinfo_tb WHERE cmpId = :id";
	$par = ":id";
	$id = $cmpID;
	$row = $obj->sqlFun($sql,$par,$id);
	
		try {

			$mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = trim($row["serverhost"]);             
            $mail->SMTPAuth = true;                             
            $mail->Username = trim($row["username"]);
            $mail->Password = trim($row["password"]);
            $mail->SMTPSecure = trim($row["serverSSL"]); 
            $mail->Port = trim($row["smtpPort"]); 
            $mail->setFrom(trim($row["username"]), 'From Line CRM');
            $mail->addAddress($eml);     // Add a recipient
            $mail->addReplyTo($eml);
            $mail->Subject = $sub;
            $mail->isHTML(true);
            $mail->Body= $des;
            if ($file!='') {
            	$mail->addAttachment($file);
            }
            
			if($mail-> send()){
				return true;
			}
			else
				return false;

		} catch (Exception $e) {
			echo $e->getMessage();
		}
		

	}

*/
function sendMail($sub,$des,$eml,$file='',$cmpID){
	$obj = new newList();
	$sql = "SELECT * FROM companyinfo_tb WHERE cmpId = :id";
	$par = ":id";
	$id = $cmpID;
	$row = $obj->sqlFun($sql,$par,$id);
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = trim($row["serverhost"]);  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = trim($row["username"]);                 // SMTP username
        $mail->Password = trim($row["password"]);                           // SMTP password
        $mail->SMTPSecure = trim($row["serverSSL"]);                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = trim($row["smtpPort"]);                                    // TCP port to connect to

        //Recipients
        $mail->setFrom(trim($row["username"]), 'From Line CRM');
        $mail->addAddress(trim($eml),'');     // Add a recipient
        // $mail->addAddress('ellen@example.com');               // Name is optional
        $mail->addReplyTo(trim($eml),'');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $sub;
        $mail->Body    = $des;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        if ($file!='') {
                $mail->addAttachment($file);
            }
        $mail->send();
        // echo 'Message has been sent';
        return true;
    } catch (Exception $e) {
        // echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        return false;
    }
}

//pdf viewing function

 function viewPdf($filename)
    {
        
        $path = 'uploads/proposals/'.$filename.'';
        header('Content-type:application/pdf');
        header('Content-Disposition:inline; filename="'.$filename.'"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges:bytes');
        @readfile($path);
    }


if(isset($_REQUEST["open"])){
    // echo $_GET['openx'];
   viewPdf($_GET['openx']);
   unset($_GET['openx']);
   unset($_REQUEST["open"]);
}



if(isset($_REQUEST["proposalsend"])){


	echo "<p>Please wait a moment. Your request is processing....!!</p>";
	$val = "proposal";
	$path= "proposals/";
	$obj=new fileUploadDb();
	$file=$obj->upFile($val,$path);
	$num=$obj->lastRow();
	if($num["propSerial"]==0){
		$serial=$num["propSerial"]+100;	
	}
	else{
		$serial=$num["propSerial"];
		$serial=$serial+1;
	}
	
	$title=$_POST['title'];
	$des=$_POST['desce'];
	//form which company proposal is sending
	$companyId=$_POST['compnayId'];
// 	var_dump($file); 

	if (isset($_POST['custom'])) {
	 	$cid =$_POST['custom'];
	 	$type='c';
	 	// echo $des.'<br>';
	 	if($obj->prosposalInsert($file,$cid,$type,$title,$serial,$companyId,$des)=='done'){
	 		$list = new newList();
	 		$sql="SELECT * FROM customerinfo_tb WHERE customId=:id";
	 		$row = $list->sqlFun($sql,':id',$cid);
	 		$eml=trim($row["cmpEmail"]);
	 		sendMail($title,$des,$eml,'uploads/proposals/'.$file,$companyId);
	 		$_SESSION["ok"] = 'done';
	 		unset($_POST['custom']);
	 		// header('location:user/proposal.php');
	 		 // echo $type.'<br>';
	 	}

	 } 
	 if(isset($_POST['led'])) {
	 	$lid = $_POST['led'];
	 	$type='l';
	 	// echo "hello";
	 	if($obj->prosposalInsert($file,$lid,$type,$title,$serial,$companyId,$des)=='done'){
	 		$list = new newList();
	 		$sql="SELECT * FROM leadinfo_tb WHERE leadId=:id";
	 		$row = $list->sqlFun($sql,':id',$lid);
	 		$eml=trim($row["cmpEmail"]);
	 		sendMail($title,$des,$eml,'uploads/proposals/'.$file,$companyId);
	 		 $_SESSION["ok"] = 'done';
	 		 unset($_POST['led']);
	 		 // header('location:user/proposal.php');
	 		 // echo $type.'<br>';
	 	}
	 	// echo $lid;
	 }
	// echo $_POST[''];
	// echo $_POST[''];

}

if (isset($_GET['acp']) && isset($_GET['pro'])) {
	$id = $_GET['pro'];
	echo $id;
}
// var_dump($_SESSION["invoiceAr"]);
if (isset($_SESSION["invoiceAr"]) && isset($_SESSION["open"]) && $_SESSION["open"]=='yes') {
	$data = $_SESSION["invoiceAr"];
	$_SESSION["invoiceAr"] = null;
	$_SESSION["open"] = null;
	$sub='Invoice On '.$data["towork"];
	$file = 'uploads/invoices/'.$data["serial"].'.pdf';
	$des =' ';
	sendMail($sub,$des,$data["email"],$file,$data["cmpID"]);
	header('location:user/invoicePage.php');
}

?>

<script type="text/javascript">
setTimeout(myFunction, 5000)
function myFunction() {
    location.href='index.php';
}
</script>