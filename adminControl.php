<?php
  include 'Session.php';
  $sna= new Session();
  $sna->init();
    if(isset($_SESSION["is_Admin"]) && ($_SESSION["is_Admin"] == "IS_ACTIVE")){
        $sna->adminPageLoad();
    }
    else{
        header('location:index.php');
    }

require 'Database.php';
/**
 * Update class
 */
class update extends Database
{
		protected $conn;

		function __construct()
		{
			$this->conn =$this->openConnection();
		}
		function __destruct()
		{
			$this->closeConnection();
		}
	//random string genartion
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

		public function productUpdate()
		{
			$name = $_POST['name'];
			$type = $_POST['type'];
			$des = $_POST['description'];
			$id = $_POST['id'];

			$sql="UPDATE product_tb SET productName = :name, description = :des, productType = :type WHERE productId = :pid";
			$pre = $this->conn->prepare($sql);
			$pre->bindValue(':name',$name);
			$pre->bindValue(':des', $des);
			$pre->bindValue(':type', $type);
			$pre->bindValue(':pid', $id);
			if($pre->execute()){
				return true;
			}
		}

		public function customerInofUpdate($id)
		{
			$name = $_POST['cmpName']; 
			$cell = $_POST['cmpCell'];
			$email = trim($_POST['cmpEmail']);
			$address = $_POST['cmpAddress'];
			$area = $_POST['cmpArea'];
			$rev = $_POST['cmpRevenue'];
			$est = $_POST['cmpEstablishment'];
			$num = $_POST['numEmployee'];
			$method = $_POST['payMethod'];
			$web = $_POST['cmpWeb'];
			$rname = $_POST['refPerName'];
			$rcell = $_POST['refCell'];


			$sql="UPDATE customerinfo_tb SET cmpName = :name, cmpCell = :cell, cmpEmail = :email, cmpAddress = :add, cmpArea = :area, cmpWeb = :web, cmpYearlyRevenue = :rev, cmpYearOfEst = :est, cmpNumEmp = :num, cmpPayMethod = :method, refName = :rname, refCell = :rcell WHERE customId = :id";
			$pre = $this->conn->prepare($sql);
			$pre->bindValue(':name',$name);
			$pre->bindValue(':cell', $cell);
			$pre->bindValue(':email', $email);
			$pre->bindValue(':add', $address);
			$pre->bindValue(':area', $area);
			$pre->bindValue(':web', $web);
			$pre->bindValue(':rev', $rev);
			$pre->bindValue(':est', $est);
			$pre->bindValue(':num', $num);
			$pre->bindValue(':method', $method);
			$pre->bindValue(':rname', $rname);
			$pre->bindValue(':rcell', $rcell);
			$pre->bindValue(':id', $id);
			if($pre->execute()){
					$x= sizeof($_SESSION["tracker"]);
					$y = $_SESSION["tracker"];
					for($i=0; $i<$x; $i++){
						$name = 'cntPerName'.$i;
						$cell = 'cntCell'.$i;
						$email = 'cntEmail'.$i;
						$link = 'cntLin'.$i;
						$sql="UPDATE contactinfo_tb SET contactName = :name, contactCell = :cell, contactEmail = :email, linkIn = :link WHERE contactId = :id AND customerId = :cid";
						$pre = $this->conn->prepare($sql);
						$pre->bindValue(':name',$_POST[$name]);
						$pre->bindValue(':cell', $_POST[$cell]);
						$pre->bindValue(':email', $_POST[$email]);
						$pre->bindValue(':link', $_POST[$link]);
						$pre->bindValue(':id', $y[$i]);
						$pre->bindValue(':cid', $id);
						$pre->execute();
					}

			}
			unset($_SESSION["tracker"]);

		}


	//lead information update

		public function leadInofUpdate($id)
		{
			$name = $_POST['cmpName']; 
			$cell = $_POST['cmpCell'];
			$email = trim($_POST['cmpEmail']);
			$address = $_POST['cmpAddress'];
			$area = $_POST['cmpArea'];
			$rev = $_POST['cmpRevenue'];
			$est = $_POST['cmpEstablishment'];
			$num = $_POST['numEmployee'];
			$method = $_POST['payMethod'];
			$web = $_POST['cmpWeb'];
			$rname = $_POST['refPerName'];
			$rcell = $_POST['refCell'];
			$tag = $_POST['tag'];


			$sql="UPDATE leadinfo_tb SET cmpName = :name, cmpCell = :cell, cmpEmail = :email, cmpAddress = :add, cmpArea = :area, cmpWeb = :web, cmpYearlyRevenue = :rev, cmpYearOfEst = :est, cmpNumEmp = :num, cmpPayMethod = :method, tag = :tag, refName = :rname, refCell = :rcell WHERE leadId = :id";
			$pre = $this->conn->prepare($sql);
			$pre->bindValue(':name',$name);
			$pre->bindValue(':cell', $cell);
			$pre->bindValue(':email', $email);
			$pre->bindValue(':add', $address);
			$pre->bindValue(':area', $area);
			$pre->bindValue(':web', $web);
			$pre->bindValue(':rev', $rev);
			$pre->bindValue(':est', $est);
			$pre->bindValue(':num', $num);
			$pre->bindValue(':method', $method);
			$pre->bindValue(':tag', $tag);
			$pre->bindValue(':rname', $rname);
			$pre->bindValue(':rcell', $rcell);
			$pre->bindValue(':id', $id);
			if($pre->execute()){
					$x= sizeof($_SESSION["tracker"]);
					$y = $_SESSION["tracker"];
					for($i=0; $i<$x; $i++){
						$name = 'cntPerName'.$i;
						$cell = 'cntCell'.$i;
						$email = 'cntEmail'.$i;
						$link = 'cntLin'.$i;
						$sql="UPDATE contactinfo_tb SET contactName = :name, contactCell = :cell, contactEmail = :email, linkIn = :link WHERE contactId = :id AND leadId = :cid";
						$pre = $this->conn->prepare($sql);
						$pre->bindValue(':name',$_POST[$name]);
						$pre->bindValue(':cell', $_POST[$cell]);
						$pre->bindValue(':email', $_POST[$email]);
						$pre->bindValue(':link', $_POST[$link]);
						$pre->bindValue(':id', $y[$i]);
						$pre->bindValue(':cid', $id);
						$pre->execute();
					}

			}
			unset($_SESSION["tracker"]);

		}


	//User Entry 
	public function userUpdate($id)
	{
		$name = $_POST['fName'];
		$idNum = $_POST['id'];
		$designation = $_POST['designation'];
		$cell = $_POST['cell'];
		$type = $_POST['type'];
		$mail = trim($_POST['mail']);
		$cmpId = $_POST['cmpId'];
		// echo $name,$idNum,$designation,$cell,$type,$mail,$cmpId;


		try{
				
				$insert="UPDATE user_tb SET userName = :uname, userType = :type, fullName = :fname, cell = :cell, designation = :desg, companyId = :cid, idNumber = :id WHERE userId = :uid";

				if($stmt= $this->conn->prepare($insert)){
					$stmt->bindValue(':uname', $mail);				
					$stmt->bindValue(':type', $type);				
					$stmt->bindValue(':fname', $name);				
					$stmt->bindValue(':cell', $cell);				
					$stmt->bindValue(':desg', $designation);				
					$stmt->bindValue(':cid', $cmpId);				
					$stmt->bindValue(':id', $idNum);				
					$stmt->bindValue(':uid', $id);				
					if($stmt->execute()){
							$_SESSION["userUpdate"]='yes';
					}
				}
			}
			catch(Exception $ex){
				echo $ex->getMessage();
	    		// throw $ex;
			}
		
	}

	//expenditure update 
	public function updateExpenditure($id)
	{
		$item =  $_POST['item'];
		$quantity = $_POST['quantity'];
		$hours = $_POST['hours'];
		$cost = $_POST['cost'];
		$exdate = $_POST['date'];

		try{
				
				$insert="UPDATE expenditure_tb SET item = :item, quantity = :quantity,  cost = :cost, hours = :hours, exdate = :exdate WHERE exId = :id";

				if($stmt= $this->conn->prepare($insert)){
					$stmt->bindValue(':item', $item);
					$stmt->bindValue(':quantity', $quantity);
					$stmt->bindValue(':cost', $cost);				
					$stmt->bindValue(':hours', $hours);								
					$stmt->bindValue(':exdate', $exdate);								
					$stmt->bindValue(':id', $id);								
					if($stmt->execute()){
							$_SESSION["expenditureUP"]='yes';
							return true;
					}
				}
			}
			catch(Exception $ex){
				echo $ex->getMessage();
	    		// throw $ex;
			}

	}
	//uploading logo for company
	public function upFile($val,$path,$cmp)
	{

		date_default_timezone_set("Asia/Dhaka");
		$target_dir="uploads/".$path;
		if (!isset($_FILES[$val]["name"]) || $_FILES[$val]["name"]=="") {
			return null;
		}
		var_dump($_FILES[$val]["name"]);
		$fileName=$_FILES[$val]["name"];
		$file_tmp=$_FILES[$val]["tmp_name"];
		$exp = explode(".",$fileName);
		$type = end($exp);
		$type = strtolower($type);
		$arr = ['jpg','jpeg','png'];
		$date=date('d-m-Y').'.'.strftime("%H-%M");
		$newName=$date.'_'.$this->random(5).'_'.$cmp.'.'.$type;
		if (in_array($type, $arr)) {
				$target_file = $target_dir.$newName; 
				if(move_uploaded_file($file_tmp, $target_file)){
					return $newName;
				}
		
		} else {
			echo "error";
		}
	}

	public function companyEntryUpdate()
	{
		$name = $_POST['CompanyName'];
		$cell = $_POST['Cell'];
		$mail = $_POST['Email'];
		$web = $_POST['web'];
		$add = $_POST['Address'];
		$host = $_POST['host'];
		$port = $_POST['port'];
		$ssl = $_POST['ssl'];
		$username = $_POST['username'];
		$pass = $_POST['pass'];
		$id = $_POST['cmpids'];
		$logo = 'cmplogo';
		$logo = $this->upFile($logo,'companylogo/',$name);
		// var_dump($logo);
		
		try{
			if (empty($logo)) {
				$insert="UPDATE companyinfo_tb SET companyName = :name, cmpCell = :cell, cmpEmail = :mail, web = :web, address = :add, serverhost = :host, username = :username, password =:pass, smtpPort = :port, serverSSL= :ssl WHERE cmpId = :id";

			}else{
				$insert="UPDATE companyinfo_tb SET companyName = :name, cmpCell = :cell, cmpEmail = :mail, web = :web, address = :add, logoname = :logo, serverhost = :host, username = :username, password =:pass, smtpPort = :port, serverSSL= :ssl WHERE cmpId = :id";
			}
				
				

				if($stmt= $this->conn->prepare($insert)){
					$stmt->bindValue(':name', $name);
					$stmt->bindValue(':cell', $cell);				
					$stmt->bindValue(':mail', $mail);								
					$stmt->bindValue(':web', $web);								
					$stmt->bindValue(':add', $add);	
					if (!empty($logo)) {
						$stmt->bindValue(':logo', $logo);							
					}							
													
					$stmt->bindValue(':host', $host);								
					$stmt->bindValue(':username', $username);								
					$stmt->bindValue(':pass', $pass);								
					$stmt->bindValue(':port', $port);								
					$stmt->bindValue(':ssl', $ssl);								
					$stmt->bindValue(':id', $id);								
					if($stmt->execute()){
							$_SESSION["cmpIn"]='yes';
							return true;
					}
				}
			}
			catch(Exception $ex){
				echo $ex->getMessage();
	    		// throw $ex;
			}
			
	}


}
//end of the class



// product update
if(isset($_REQUEST["productUpdate"])){
	$obj = new update();
	$obj->productUpdate();
	header('location:user/products.php');
}


//customer update
if (isset($_REQUEST["customerInofUpdate"])){
	$id= $_POST['cusID'];
	$obj = new update();
	$obj->customerInofUpdate($id);
	header('location:user/customer.php');
}

//lead update
if (isset($_REQUEST["leadInofUpdate"])){
	$id= $_POST['ldID'];
	$obj = new update();
	$obj->leadInofUpdate($id);
	header('location:user/leads.php');
}


//user update
if (isset($_REQUEST["userUpdateForm"])){
	$id= $_POST['userid'];
	$obj = new update();
	$obj->userUpdate($id);
	header('location:user/users.php');
	// echo $id;
}


//updating customer wise product information
if (isset($_REQUEST["upex"])) {

	$id = $_POST['exid'];
	$id = explode(' ', $id);
	$exid = $id[0];
	$cpid = $id[1];
	$object = new update();
	$object->updateExpenditure($id[0]);
	header('location:user/addExpenditure.php?xkpnt='.$id[1].'&exp=true');

}

//updating company information
if (isset($_REQUEST["cmpUpbtn"])) {
	$object = new update();
	$object->companyEntryUpdate();
	header('location:user/setup.php');

}


//unseting all object
if (isset($obj)) {
	unset($obj);
}
?>
<script type="text/javascript">
// setTimeout(myFunction, 5000)
function myFunction() {
    location.href='index.php';
}
</script>