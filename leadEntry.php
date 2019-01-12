<?php
include 'Session.php';
$sn= new Session();
$sn->init();
$sn->userPageLoad();
require 'Database.php';

/**
 * This class is for inserting leads into the database
 */
class leadEntry extends Database{

		//company info
		private $cmpName;
		private $cmpCell;
		private $cmpEmail;
		private $cmpAdderss;
		private $cmpArea;
		private $cmpWeb;
		private $cmpRevenue;
		private $cmpEstab;
		private $cmpNumEmp;
		private $cmpPay;
		private $tag;

		//contact person info
		private $cntName;
		private $cntCell;
		private $cntEmail;
		private $cntLin;
		
		//reference person info
		private $refName;
		private $refCell;

	
	function __construct()
	{
		//company info
		$this->cmpName = $_POST['cmpName'];
		$this->cmpCell = $_POST['cmpCell'];
		$this->cmpEmail = trim($_POST['cmpEmail']);
		$this->cmpAddress = $_POST['cmpAddress'];
		$this->cmpArea = $_POST['cmpArea'];
		$this->cmpWeb = $_POST['cmpWeb'];
		$this->cmpRevenue = $_POST['cmpRev'];
		$this->cmpEstab = $_POST['cmpEst'];
		$this->cmpNumEmp=$_POST['cmpEmp'];
		$this->cmpPay=$_POST['cmpPay'];
		$this->tag=$_POST['tag'];

		//contact person info
		$this->cntName=$_POST['cntPerName'];
		$this->cntCell=$_POST['cntCell'];
		$this->cntEmail=$_POST['cntEmail'];
		$this->cntLin=$_POST['cntLin'];

		//reference person info
		$this->refName=$_POST['refName'];
		$this->refCell=$_POST['refCell'];
	}

	public function hallo ()
	{
		try{
			$con = $this->openConnection();
			$insert="INSERT INTO leadinfo_tb (cmpName,cmpCell, cmpEmail, cmpAddress, cmpArea, cmpWeb, cmpYearlyRevenue, cmpYearOfEst, cmpNumEmp, cmpPayMethod, tag, refName, refCell, ownerID)

			VALUES(:cmpName, :cmpCell, :cmpEmail,:cmpAddress,:cmpArea,:cmpWeb,:cmpRevenue,:cmpYearOfEst,:cmpNumEmp,:cmpPay, :tag, :refName,:refCell,:userId)";

			if($stmt= $con->prepare($insert)){
				$stmt->bindValue(':cmpName', $this->cmpName);
				$stmt->bindValue(':cmpCell', $this->cmpCell);
				$stmt->bindValue(':cmpEmail', $this->cmpEmail);
				$stmt->bindValue(':cmpAddress', $this->cmpAddress);
				$stmt->bindValue(':cmpArea', $this->cmpArea);
				$stmt->bindValue(':cmpWeb', $this->cmpWeb);
				$stmt->bindValue(':cmpRevenue', $this->cmpRevenue);
				$stmt->bindValue(':cmpYearOfEst', $this->cmpEstab);
				$stmt->bindValue(':cmpNumEmp', $this->cmpNumEmp);
				$stmt->bindValue(':cmpPay', $this->cmpPay);
				$stmt->bindValue(':tag', $this->tag);

				$stmt->bindValue(':refName', $this->refName);
				$stmt->bindValue(':refCell', $this->refCell);
				$stmt->bindValue(':userId', $_SESSION["userId"]);
				
				if($stmt->execute()){
						$sql="SELECT * FROM leadinfo_tb ORDER BY leadId DESC LIMIT 1";
						$pre=$this->con->prepare($sql);
						if($pre->execute()){
							while($row=$pre->fetch()){
								$x = $row["leadId"];
							}		

						}
					foreach ($this->cntName as $key => $value) {
						
						$insert="INSERT INTO contactinfo_tb (contactName,contactCell,contactEmail,linkIn,leadId) VALUES(:Name, :Cell, :Email, :Lin, :id)";

						if($stmt= $this->con->prepare($insert)){
								$stmt->bindValue(':Name', $value);
								$stmt->bindValue(':Cell', $this->cntCell[$key]);
								$stmt->bindValue(':Email', $this->cntEmail[$key]);
								$stmt->bindValue(':Lin', $this->cntLin[$key]);
								$stmt->bindValue(':id', $x);
								$stmt->execute();
						}

					}

					$_SESSION["leadDone"]='yes';
					
					
				}
			}
		}
		catch(Exception $ex){
			echo $ex->getMessage();
    		// throw $ex;
		}

	}


}

if(isset($_REQUEST["btna"])){

	$object = new leadEntry();
	$object->hallo();
	header('location:user/leads.php');
}

?>