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
// require 'Database.php';
    include 'allList.php';
    include 'OAuth/Security.php';

/**
 * Delete information
 */
class delete extends Database {

		protected $con;

		public function __construct()
		{
			$this->con = $this->openConnection();
		}

		public function __destruct(){
			$this->closeConnection();
		}

// Delete compnay information by compnay id
		public function deleteCompnayById($id)
		{
			$sql = "DELETE FROM customerinfo_tb WHERE customId = :id";
			$dns = $this->con->prepare($sql);
			$dns->bindValue(':id',$id);
			if($dns->execute()){
				$sql = "DELETE FROM customerproduct_tb WHERE customerId = :id";
				$dns = $this->con->prepare($sql);
				$dns->bindValue(':id',$id);
				if($dns->execute()){
					if($this->proposalDeleteByCid($id,'c')){
						return true;
					}
				}
			}

		}

// Delete lead information by lead Id
		public function deleteLeadById($id)
		{
			$sql = "DELETE FROM leadinfo_tb WHERE leadId = :id";
			$dns = $this->con->prepare($sql);
			$dns->bindValue(':id',$id);
			if($dns->execute()){
				if($this->proposalDeleteByCid($id,'l')){
						return true;
					}
			}
		}

// Delete proposal information by compnay id
		public function proposalDeleteByCid($id,$type)
		{
			if($type == 'c'){
				$sql="SELECT * FROM proposal_tb WHERE customId = '$id'";
				$sql1 = "DELETE FROM proposal_tb WHERE customId = :id";
			}
			else{
				$sql="SELECT * FROM proposal_tb WHERE leadId = '$id'";
				$sql1 = "DELETE FROM proposal_tb WHERE leadId = :id";
			}
			
			$pre=$this->con->prepare($sql);
			if($pre->execute()){
				while($row=$pre->fetch()){
					echo $row["propName"];
					$file='uploads/proposals/'.$row["propName"];
					unlink($file);
				}

				
				$dns = $this->con->prepare($sql1);
				$dns->bindValue(':id',$id);
				if($dns->execute()){
					return true;
				}
				
			}
		}


// delete proposal information by proposal Id
		public function deleteProposalById($id)
		{
			$sql="SELECT * FROM proposal_tb WHERE proposalId = '$id'";
			$pre=$this->con->prepare($sql);
			if($pre->execute()){
				while($row=$pre->fetch()){
					echo $row["propName"];
					$file='uploads/proposals/'.$row["propName"];
					unlink($file);
				}

				$sql = "DELETE FROM proposal_tb WHERE proposalId = :id";
				$dns = $this->con->prepare($sql);
				$dns->bindValue(':id',$id);
				if($dns->execute()){
					return true;
				}
				
			}
		}

// delete product information by product id 
		public function deleteProductById($id)
		{
			$sql = "DELETE FROM product_tb WHERE productId = :id";
			$dns = $this->con->prepare($sql);
			$dns->bindValue(':id',$id);
			if($dns->execute()){
				$sql = "DELETE FROM customerproduct_tb WHERE productId = :id";
				$dns = $this->con->prepare($sql);
				$dns->bindValue(':id',$id);
				if($dns->execute()){
					return true;	
				}
			}
		}

// Delete user information by user Id
		public function deleteUserById($id)
		{
			$sql = "DELETE FROM user_tb WHERE userId = :id";
			$dns = $this->con->prepare($sql);
			$dns->bindValue(':id',$id);
			if($dns->execute()){
				return true;
			}
		}

// Delete customer wise product information by cpID
		public function deleteCpById($id)
		{
			$sql = "DELETE FROM customerproduct_tb WHERE cpId = :id";
			$dns = $this->con->prepare($sql);
			$dns->bindValue(':id',$id);
			if($dns->execute()){
				return true;
			}
		}

// Delete expenditure information by exId
		public function deleteExById($id)
		{
			$sql = "DELETE FROM expenditure_tb WHERE exId = :id";
			$dns = $this->con->prepare($sql);
			$dns->bindValue(':id',$id);
			if($dns->execute()){
				return true;
			}
		}
// Delete company information by Id
		public function deleteComById($id)
		{
			$sql = "DELETE FROM companyinfo_tb WHERE cmpId = :id";
			$dns = $this->con->prepare($sql);
			$dns->bindValue(':id',$id);
			if($dns->execute()){
				return true;
			}
		}

// Delete ticket information by Id
		public function deleteTicketById($id)
		{
			$sql = "DELETE FROM ticketlist_tb WHERE tId = :id";
			$dns = $this->con->prepare($sql);
			$dns->bindValue(':id',$id);
			if($dns->execute()){
				$sql = "DELETE FROM ticketsinfo_tb WHERE tId = :id";
				$dns = $this->con->prepare($sql);
				$dns->bindValue(':id',$id);
				if($dns->execute()){
					return true;
				}
				
			}
		}

		
// Delete invoice information 
		public function deleteInvoInfoById($id)
		{
			$sql = "DELETE FROM invoicesinfo_tb WHERE id = :id";
			$dns = $this->con->prepare($sql);
			$dns->bindValue(':id',$id);
			if($dns->execute()){
				return true;
			}
		}

// Delete note
		public function deleteNoteById($id)
		{
			$sql = "DELETE FROM note_tb WHERE id = :id";
			$dns = $this->con->prepare($sql);
			$dns->bindValue(':id',$id);
			if($dns->execute()){
				return true;
			}
		}

// Delete invoice
		public function deleteInvoById($id)
		{
			$sql = "DELETE FROM invoicelist_tb WHERE id = :id";
			$dns = $this->con->prepare($sql);
			$dns->bindValue(':id',$id);
			if($dns->execute()){
				$sql = "DELETE FROM invoicesinfo_tb WHERE ILI = :id";
				$dns = $this->con->prepare($sql);
				$dns->bindValue(':id',$id);
				if($dns->execute()){
					return true;
				}
			}
		}

		
}
// end of the class



//Deleting customer information including poroposal, products.
if (isset($_REQUEST["customerDeleteButton"])) {
	$id = $_POST['cusotmerid'];
	$object = new delete();
	if($object->deleteCompnayById($id)){
		header('location:user/customer.php');
	}
}

//Deleting product information including customer product.
if (isset($_REQUEST["productDeleteButton"])) {
	$id = $_POST['productid'];

	echo $id;
	$object = new delete();
	if($object->deleteProductById($id)){
		header('location:user/products.php');
	}
}

//Deleting proposal information including customer and lead.
if (isset($_REQUEST["proposalDeleteButton"])) {
	$id = $_POST['proposalid'];

	$object = new delete();
	if($object->deleteProposalById($id)){
		header('location:user/Proposal.php');
	}
}

//Deleting customer information including poroposal
if (isset($_REQUEST["leadDeleteButton"])) {
	$id = $_POST['leadid'];

	echo $id;
	$object = new delete();
	if($object->deleteleadById($id)){
		header('location:user/leads.php');
	}
}


//Deleting user information
if (isset($_REQUEST["userDeleteButton"])) {
	$id = $_POST['uid'];

	// echo $id;
	$object = new delete();
	if($object->deleteUserById($id)){
		header('location:user/users.php');
	}
}

//Deleting customer wise product information
if (isset($_REQUEST["cpidDelete"])) {
	$id = $_POST['cpid'];
	// echo $id;
	$object = new delete();
	if($object->deleteCpById($id)){
		header('location:user/users.php');
		// echo "done";
	}
}

//Deleting customer product wise information
if (isset($_GET['btn'])) {
	$id = $_GET['id'];
	$cpid = $_GET['xkpnt'];
	echo $id;
	echo $cpid;
	$object = new delete();
	if($object->deleteCpById($id)){
		header('location:user/users.php');
		// echo "done";
	}
}


//Deleting expenditure wise product information
if (isset($_GET["del"]) && isset($_GET["ex"])) {

	$id = $_GET['ex'];
	$id = explode(' ', $id);
	$exid = $id[0];
	$cpid = $id[1];
	$object = new delete();
	$object->deleteExById($id[0]);
	header('location:user/addExpenditure.php?xkpnt='.$id[1].'&exp=true');

}

//Deleting company information
if (isset($_GET["key"]) && $_GET["key"]=='del') {
	echo "ok";
	$id = $_GET['id'];
	$object = new delete();
	$object->deleteComById($id);
	header('location:user/setup.php');

}

//Deleting ticket information
if (isset($_GET["key"]) && $_GET["key"]=='delt') {
	echo "ok";
	$id = $_GET['tid'];
	$object = new delete();
	$object->deleteTicketById($id);
	header('location:user/tickets.php');

}

//Deleting invoice information
if (isset($_REQUEST["IID"])) {
	$ili = $_POST['ili'];
	$id = $_POST['id'];
	// echo $id;
	$object = new delete();
	$object->deleteInvoInfoById($id);

	$obj1 = new newList();
    $sql="SELECT * FROM invoicelist_tb WHERE id = :id LIMIT 1";
    $par =":id";
    $id = $ili;
    $row = $obj1->sqlFun($sql,$par,$id);
    $ili = scrypt($row["invoSerial"]);
	unset($object);
	unset($obj1);
	header('location:user/createInvoice.php?new&ser='.$ili);
		// header('location:user/users.php');
}


//Deleting note
if (isset($_REQUEST["notedel"])) {
	$ili = $_POST['ili'];
	$id = $_POST['id'];
	// echo $id;
	$object = new delete();
	$object->deleteNoteById($id);

	$obj1 = new newList();
    $sql="SELECT * FROM invoicelist_tb WHERE id = :id LIMIT 1";
    $par =":id";
    $id = $ili;
    $row = $obj1->sqlFun($sql,$par,$id);
    $ili = scrypt($row["invoSerial"]);
	unset($object);
	unset($obj1);
	header('location:user/createInvoice.php?new&ser='.$ili);
		// header('location:user/users.php');
}

//Deleting invoice
if (isset($_REQUEST["InvoD"])) {
	$id = $_POST['id'];
	// echo $id;
	$object = new delete();
	if($object->deleteInvoById($id)){
		header('location:user/invoicePage.php');
	}
}

// header('location:index.php');
