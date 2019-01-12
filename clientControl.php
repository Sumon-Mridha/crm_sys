<?php 
  include 'Session.php';
  $sna= new Session();
  $sna->init();
    if(isset($_SESSION["is_Client"]) && ($_SESSION["is_Client"] == "IS_ACTIVE")){
        $sna->clientPageLoad();
    }
    elseif (isset($_SESSION["is_Admin"]) && ($_SESSION["is_Admin"] == "IS_ACTIVE")){
    	$sna->adminPageLoad();
    }
    else{
        header('location:index.php');
    }
    include 'allList.php';
// require 'Database.php';

//Client activity
class clientControl extends Database
{
	protected $conn;
	function __construct()
	{
		$this->conn=$this->openConnection();
	}


	function __destruct(){
		$this->closeConnection();
	}

	public function scrypt( $string, $action = 'E') 
	{
	    $secret_key = "XoLQDFmBkyKj0fDFEUZCcQ6nExEbWiKr";
	    $secret_iv = 'S5ibpaW8DFwj2EKnOI73bfIdoJEfcdpa';

	    $output = false;
	    $encrypt_method = "AES-256-CBC";
	    $key = hash( 'sha256', $secret_key );
	    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

	    if( $action == 'E' ) 
	    {
	        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
	    }

	    else if( $action == 'D' )
	    {
	        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
	    }

	    return $output;
	}

	public function proposalStatusUpdate($id,$status)
	{
		if($status == 'true'){
			$sql="UPDATE proposal_tb SET status = 'Accepted' WHERE proposalId = :pid";
		}
		if($status == 'false'){
			$sql="UPDATE proposal_tb SET status = 'Rejected' WHERE proposalId = :pid";
		}
		
		$pre = $this->conn->prepare($sql);
		$pre->bindValue(':pid', $id);
		if($pre->execute()){
			return true;
		}
	}
//random function
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

//uploading attachments for tickets
	public function upFile($val,$path)
	{
		$data = array();
		date_default_timezone_set("Asia/Dhaka");
		if (isset($_FILES[$val]["name"])) {
					foreach ($_FILES[$val]["name"] as $key => $fileName) {
				$target_dir="uploads/".$path;
				$file_tmp=$_FILES[$val]["tmp_name"][$key];
				$exp = explode(".",$fileName);
				$type = end($exp);
				$type = strtolower($type);
				$date=date('d-m-Y').'_'.strftime("%H-%M");
				$newName=$date.'_'.$this->random(5).'.'.$type;
				$target_file = $target_dir.$newName; 

				if(move_uploaded_file($file_tmp, $target_file)){
					$data[] = $newName;
				}
		
			}
		}
		else
			return 0;
		

		return $data;
	}

//concatnating function

	public function concaArray($arry)
	{
		$str = '';
		$len = sizeof($arry);
		for ($i=0; $i < $len; $i++) { 
			if($i==$len-1){
				$str.=$arry[$i];
				return $str;
			}
			$str.=$arry[$i].',';
		}
	}

//inserting New Ticket
	public function insertNewTicket()
	{
		$cpid = $_POST['cpid'];
		$prt = $_POST['priority'];
		$sts = 'Queued';
		$objList = new newList();
		$sql="SELECT * FROM ticketlist_tb ORDER BY tId DESC LIMIT 1";
		$row = $objList->limitOne($sql);
		$srl = $row["tSerial"];
		if(empty($row["tSerial"])){
			$srl = 1000;
		}
		$srl = $srl+1;
		$sql="INSERT INTO ticketlist_tb (tSerial,priority,status,cpId) VALUES(:srl,:prt,:sts,:cpid)";

		$dsn = $this->conn->prepare($sql);
		$dsn->bindValue(':srl',$srl);
		$dsn->bindValue(':prt',$prt);
		$dsn->bindValue(':sts',$sts);
		$dsn->bindValue(':cpid',$cpid);
		if($dsn->execute()){
			$sql="SELECT * FROM ticketlist_tb ORDER BY tId DESC LIMIT 1";
			$row = $objList->limitOne($sql);
			return $row["tId"];
		}

	}

//inserting ticke conversession
	public function insertCon($tid,$file)
	{	if($file == 0){
			$file='';
		}
			$sub= $_POST['ticketSubject'];
			$msg = $_POST['desce'];
			if (isset($_SESSION["is_Admin"]) && $_SESSION["is_Admin"] = "IS_ACTIVE") {
				$actor = 'Admin_'.$_SESSION["userId"];
			}else{
				$actor = 'Client_'.$_SESSION["userId"];
			}
		$sql="INSERT INTO ticketsinfo_tb (tId,subject,message,file,actor) VALUES(:tid,:sub,:msg,:file,:actor)";
		if ($dsn = $this->conn->prepare($sql)) {
			$dsn->bindValue(':tid',$tid);
			$dsn->bindValue(':sub',$sub);
			$dsn->bindValue(':msg',$msg);
			$dsn->bindValue(':file',$file);
			$dsn->bindValue(':actor',$actor);
			if($dsn->execute()){
				return "done";
			}
		}

	}


	public function ticketUpdate($id,$type)
	{


		try{
			if ($type == 'close') {
				date_default_timezone_set('Asia/Dhaka');
				$seen = 'Closed';
				$insert="UPDATE ticketlist_tb SET status = :seen WHERE tId = :id";
			}
			else{
				date_default_timezone_set('Asia/Dhaka');
				$seen = date("Y-m-d h:i:sa");
				if (isset($_SESSION["is_Admin"]) && ($_SESSION["is_Admin"] == "IS_ACTIVE")){
					$insert="UPDATE ticketlist_tb SET seen = :seen, status='Answered' WHERE tId = :id";
				}else{
					$insert="UPDATE ticketlist_tb SET seen = :seen, status='Queued' WHERE tId = :id";
				}
				
			}
				

				if($stmt= $this->conn->prepare($insert)){
					$stmt->bindValue(':seen', $seen);							
					$stmt->bindValue(':id', $id);							
					if($stmt->execute()){
							$_SESSION["ticketUpdate"]='yes';
					}
				}
			}
			catch(Exception $ex){
				echo $ex->getMessage();
	    		// throw $ex;
			}
		
	}

//check last update ticket is expired or not if expired then autometically update ticket status
	function checkLastUpdateTicket()
	{
		$objList = new newList();
		$sql= "SELECT tId,seen FROM ticketlist_tb t WHERE NOT status = 'Closed'";
		$seen = $objList->allSql($sql);
		foreach ($seen as $key) {
			date_default_timezone_set('Asia/Dhaka');
			$strStart = $key["seen"]; 
	   		$strEnd   = date("Y-m-d h:i:sa"); 
			$dteStart = new DateTime($strStart); 
			$dteEnd   = new DateTime($strEnd); 
			$dteDiff  = $dteStart->diff($dteEnd); 
			// echo $dteDiff->format("%Y-%M-%D %H:%I:%S")."<br>";
			if($dteDiff->format("%d")>=2){
				$this->ticketUpdate($key["tId"],$type='close');
			}
			
		}


	}



	public function passwordReset($pass,$id)
	{
		
		$sql="UPDATE customerinfo_tb SET userPassword = :pass WHERE customId = :id";
		$pre = $this->conn->prepare($sql);
		$pre->bindValue(':pass',$this->scrypt($pass));
		$pre->bindValue(':id', $id);
		if($pre->execute()){
			return true;
		}
	}


//end of class
}



  $cl = new clientControl();
  $cl->checkLastUpdateTicket();

//updating proposal status by customer
if (isset($_GET['acp']) && isset($_GET['pro'])) {
	$id = $_GET['pro'];
	$sts = $_GET['acp'];
	if($sts == 'true' || $sts == 'false'){
		
		$obj = new clientControl();
		$obj->proposalStatusUpdate($id,$sts);
		header('location:client/Dashboard.php?page=proposals');
	}
	
}


//opening new ticket
if (isset($_POST['openNew'])) {
	$val = 'attach';
	$path = 'attachments/';
	$obj = new clientControl();

	if ($tid = $obj->insertNewTicket()) {
		$data = $obj->upFile($val,$path);
		if ($data!=0) {
			$name = $obj->concaArray($data);
		}else{
			$name = $data;
		}
	 	$obj->insertCon($tid, $name);
	 	$_SESSION["conversessionID"] = $tid;
	 	header('location:client/Dashboard.php?page=convTicket');
	 } 
}

if (isset($_REQUEST['Answer'])) {
	$tid = $_POST['ticketid'];
	$_SESSION["conversessionID"] = $tid;
	$val = 'attach';
	$path = 'attachments/';
	$obj = new clientControl();
	$data = $obj->upFile($val,$path);
		if ($data!=0) {
			$name = $obj->concaArray($data);
		}else{
			$name = $data;
		}
	 	$obj->insertCon($tid, $name);
	 	$obj->ticketUpdate($tid,$type="open");

	 	if (isset($_SESSION["is_Admin"]) && ($_SESSION["is_Admin"] == "IS_ACTIVE")){
    		header('location:user/tickets.php?page=convTicket');
    	}
    	else
	 		header('location:client/Dashboard.php?page=convTicket');
} 
//reseting password
if (isset($_REQUEST["resetPa"])) {
	$pass = $_POST['pass'];
	$obj=new clientControl();
	if($obj->passwordReset($pass, $_SESSION["userId"])){
		echo "ok";
		unset($obj);
		header('location:client/Dashboard.php?page=myProfile');	
	}
	
	unset($obj);
}


//sending back to the index page if there is no activity occured
// header('location:index.php');
