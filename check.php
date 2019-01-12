<?php 
include 'allList.php';
/**
 * 
 */
class check extends Database
{
	
	protected $conn;
	function __construct()
	{
		$this->conn=$this->openConnection();
	}


	function __destruct(){
		$this->closeConnection();
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


}

$chk = new check();
$chk->checkLastUpdateTicket();