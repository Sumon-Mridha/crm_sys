<?php 
require 'Database.php';

class newList extends Database
{
	private $conn;
	
	function __construct()
	{
		$this->conn=$this->openConnection();
	}


//table name and return whole table

	public function all($tb)
	{
		try {
			$data = array();
			$sql="SELECT * FROM ".$tb." ";
			$pre=$this->conn->prepare($sql);
			if($pre->execute()){
				while($row=$pre->fetch()){
					$data[]=$row;
				}	
				return $data;
		}
			
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		
	}


//sql and return whole table mainly for join query

	public function allSql($sql)
	{
		try {
			$data = array();
			$pre=$this->conn->prepare($sql);
			if($pre->execute()){
				while($row=$pre->fetch()){
					$data[]=$row;
				}	
				return $data;
		}
			
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		
	}


//query as string, PDO(ref name), query id and return 1 row
	public function sqlFun($sql,$par,$id)
	{
		try {
			$data = array();
			$pre=$this->conn->prepare($sql);
			$pre->bindValue( $par,$id);
			if($pre->execute()){
				while($row=$pre->fetch()){
					return $row;
				}		

			}			
		} catch (Exception $e) {
			echo $e->getMessage();
		}

	}

//query as string, PDO(ref name), query id and return 1 row
	public function limitOne($sql)
	{
		try {
			$pre=$this->conn->prepare($sql);
			if($pre->execute()){
				while($row=$pre->fetch()){
					return $row;
				}		

			}			
		} catch (Exception $e) {
			echo $e->getMessage();
		}

	}


//query as string, PDO(ref name), query id and return multiple rows

	public function Fun($sql,$par,$id)
	{
		try {
			$data = array();
			$pre=$this->conn->prepare($sql);
			$pre->bindValue($par,$id);
			if($pre->execute()){
				while($row=$pre->fetch()){
					$data[]=$row;
				}	
				return $data;	

			}			
		} catch (Exception $e) {
			echo $e->getMessage();
		}

	}



//return all proposal with it's leads and customers
	public function allProp()
	{
		$data = array();
		$sql="SELECT proposalId,propName,propTitle,propSerial,status,cusName,cusEmail,cmpName lname, cmpEmail lemail, pdatetime FROM (SELECT proposalId,propName,propTitle,propSerial,status,pdatetime,leadId,cmpName cusName,cmpEmail cusEmail FROM proposal_tb LEFT JOIN customerinfo_tb ON proposal_tb.customId=customerinfo_tb.customId ORDER BY proposal_tb.proposalId DESC) tb LEFT JOIN leadinfo_tb lt ON tb.leadId=lt.leadId";
		
		$dsn=$this->conn->prepare($sql);
			if($dsn->execute()){
				while($row=$dsn->fetch()){
					$data[]=$row;
				}
				return $data;
			}

	}

//return all products
	public function allProducts()
	{
		$sql="SELECT * FROM (SELECT * FROM customerproduct_tb p LEFT JOIN customerinfo_tb c ON p.customerId=c.customId) n JOIN product_tb pt ON n.productId=pt.productId ORDER BY cpdatetime DESC ";
		
		$dsn=$this->conn->prepare($sql);
			if($dsn->execute()){
				while($row=$dsn->fetch()){
					$data[]=$row;
				}	
				return $data;
			}
	}

	function __destruct(){
		$this->closeConnection();
	}

}


if(isset($_GET['key']) && $_GET['key']=='expen'){
	$cmpID = $_GET['companyid'];
	$obj = new newList();
	$sql = "SELECT * FROM product_tb p LEFT JOIN customerproduct_tb c ON p.productId = c.productId WHERE c.customerId = :id ORDER BY c.cpId DESC";
	$par = ":id";
	$id = $cmpID;
	$row = $obj->Fun($sql,$par,$id);
	// echo $id;
	$jsn = json_encode($row);
	if(!empty($row)){
		echo $jsn;
	}
	
	
}

if(isset($_GET['key']) && $_GET['key']=='setup'){
	$cmpID = $_GET['companyid'];
	$obj = new newList();
	$sql = "SELECT * FROM companyinfo_tb WHERE cmpId = :id";
	$par = ":id";
	$id = $cmpID;
	$row = $obj->sqlFun($sql,$par,$id);
	$jsn = json_encode($row);
	if(!empty($row)){
		echo $jsn;
	}
	
	
}