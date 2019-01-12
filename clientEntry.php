<?php  
 include 'Session.php';
 $sn= new Session();
 $sn->init();
    if(isset($_SESSION["is_Admin"]) && ($_SESSION["is_Admin"] == "IS_ACTIVE")){
        $sn->adminPageLoad();
    }
    else if(isset($_SESSION["is_User"]) && ($_SESSION["is_User"] == "IS_ACTIVE")){
       $sn->userPageLoad();
    }
    else{
        header('location:index.php');
    }
include 'allList.php';
// require 'OAuth/PHPmailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'OAuth/PHPMailer-master/PHPMailer-master/src/Exception.php';
require 'OAuth/PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require 'OAuth/PHPMailer-master/PHPMailer-master/src/SMTP.php';


Class CustomerEntry extends Database{
			//cmpany info\
			private $connection;
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

			//contact person info
			private $cntName;
			private $cntCell;
			private $cntEmail;
			private $cntLin;

			//reference person info
			private $refName;
			private $refCell;
			//construct function is for oppening connection\

			public function __construct()
			{
				$this->connection = $this->openConnection();
			}

			public function __destruct(){
				$this->closeConnection();
			}

	//def function is set the data into the variable
		protected function def(){

			//comnpany information
			$this->cmpName = $_POST['cmpName'];
			$this->cmpCell = $_POST['cmpCell'];
			$this->cmpEmail = trim($_POST['cmpEmail']);
			$this->cmpAddress = $_POST['cmpAddress'];
			$this->cmpArea = $_POST['cmpArea'];
			$this->cmpWeb = $_POST['cmpWeb'];
			$this->cmpRevenue = $_POST['cmpRevenue'];
			$this->cmpEstab = $_POST['cmpEstablishment'];
			$this->cmpNumEmp =$_POST['numEmployee'];
			$this->cmpPay=$_POST['payMethod'];

			//contact person info
			$this->cntName=$_POST['cntPerName'];
			$this->cntCell=$_POST['cntCell'];
			$this->cntEmail=$_POST['cntEmail'];
			$this->cntLin=$_POST['cntLin'];

			//reference person info
			$this->refName=$_POST['refPerName'];
			$this->refCell=$_POST['refCell'];


		}
	//encription method
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


/* //old mail
	// mail sending function
	public function sendMail($sub,$des,$eml){
			try {

				$mail = new PHPMailer;
	            $mail->isSMTP();

	            $mail->Host = 'mail.digicart.xyz';             
	            $mail->SMTPAuth = true;                             
	            $mail->Username = 'linecrm@digicart.xyz';
	            $mail->Password = 'Hello@2018';
	            $mail->SMTPSecure = 'ssl'; 
	            $mail->Port = 465; 
	            $mail->setFrom('linecrm@digicart.xyz', 'From Line CRM');
	            $mail->addAddress($eml);     // Add a recipient
	            $mail->addReplyTo($eml);
	            $mail->Subject = $sub;
	            $mail->isHTML(true);
	            $mail->Body= $des;
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

public function sendMail($sub,$des,$eml){
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'mail.digicart.xyz';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'linecrm@digicart.xyz';                 // SMTP username
        $mail->Password = 'Hello@2018';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('linecrm@digicart.xyz', 'From Line CRM');
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

        $mail->send();
        // echo 'Message has been sent';
        return true;
    } catch (Exception $e) {
        // echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        return false;
    }
}
	//random string genartion
	public function random($x){
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

	//inserting commpay information in the Database

	public function customEntry(){
		$this->def();		
			$ne = $this->random(10);
			$pass = $this->scrypt($ne);
			$sub = 'Your LineCRM System Username and Password';
			$des = 'password: '.$ne;
			$this->sendMail($sub,$des,$this->cmpEmail);
			try{


				$insert="INSERT INTO customerinfo_tb (cmpName,cmpCell, cmpEmail,userPassword, cmpAddress, cmpArea, cmpWeb, cmpYearlyRevenue, cmpYearOfEst, cmpNumEmp, cmpPayMethod, refName, refCell, ownerID,LtoC)

				VALUES(:cmpName, :cmpCell, :cmpEmail,:pass,:cmpAddress,:cmpArea,:cmpWeb,:cmpRevenue,:cmpYearOfEst,:cmpNumEmp,:cmpPay,:refName,:refCell,:userId,:ltoc)";

				if($stmt= $this->connection->prepare($insert)){
					$stmt->bindValue(':cmpName', $this->cmpName);
					$stmt->bindValue(':cmpCell', $this->cmpCell);
					$stmt->bindValue(':cmpEmail', $this->cmpEmail);
					$stmt->bindValue(':pass', $pass);
					$stmt->bindValue(':cmpAddress', $this->cmpAddress);
					$stmt->bindValue(':cmpArea', $this->cmpArea);
					$stmt->bindValue(':cmpWeb', $this->cmpWeb);
					$stmt->bindValue(':cmpRevenue', $this->cmpRevenue);
					$stmt->bindValue(':cmpYearOfEst', $this->cmpEstab);
					$stmt->bindValue(':cmpNumEmp', $this->cmpNumEmp);
					$stmt->bindValue(':cmpPay', $this->cmpPay);
					$stmt->bindValue(':refName', $this->refName);
					$stmt->bindValue(':refCell', $this->refCell);
					$stmt->bindValue(':userId', $_SESSION["userId"]);
					$stmt->bindValue(':ltoc', 0);
					
					if($stmt->execute()){
							$sql="SELECT * FROM customerinfo_tb ORDER BY customId WHERE cmpEmail='$this->cmpEmail' DESC LIMIT 1";
							$pre=$this->connection->prepare($sql);
							if($pre->execute()){
								while($row=$pre->fetch()){
									$x = $row["customId"];
								}		

							}
						foreach ($this->cntName as $key => $value) {
							
							$insert="INSERT INTO contactinfo_tb (contactName,contactCell,contactEmail,linkIn,customerId) VALUES(:Name, :Cell, :Email, :Lin, :id)";

							if($stmt= $this->connection->prepare($insert)){
									$stmt->bindValue(':Name', $value);
									$stmt->bindValue(':Cell', $this->cntCell[$key]);
									$stmt->bindValue(':Email', $this->cntEmail[$key]);
									$stmt->bindValue(':Lin', $this->cntLin[$key]);
									$stmt->bindValue(':id', $x);
									$stmt->execute();
							}

						}
						
						$_SESSION["customDone"]='yes';	
					}
				}
			}
			catch(Exception $ex){
				echo $ex->getMessage();
	    		// throw $ex;
			}
			

			
		}

	//Assigning product to customer
	 
	public function customerProduct($cid,$pid,$cost,$title)
	{
				try{
				$insert="INSERT INTO customerproduct_tb (customerId,productId,title,cost) VALUES(:cid, :pid,:title,:cost)";
				if($stmt= $this->connection->prepare($insert)){
					$stmt->bindValue(':cid', $cid);
					$stmt->bindValue(':pid', $pid);				
					$stmt->bindValue(':title', $title);				
					$stmt->bindValue(':cost', $cost);				
					if($stmt->execute()){
							$_SESSION["customProd"]='yes';
					}
				}
			}
			catch(Exception $ex){
				echo $ex->getMessage();
	    		// throw $ex;
			}
	}

	public function leadToCustom($leadId, $productId, $cost,$title)
	{
			$sql="SELECT * FROM leadinfo_tb WHERE leadId=:leadId";
			$pre=$this->connection->prepare($sql);
			$pre->bindValue(':leadId',$leadId);
			if($pre->execute()){
				while($row=$pre->fetch()){
					$mail = $row["cmpEmail"];
				}

				$ne = $this->random(10);
				$pass = $this->scrypt($ne);
				$sub = 'Your LineCRM System Username and Password';
				$des = 'password: '.$ne;
				$this->sendMail($sub,$des,trim($mail));
			}

		try {
		

			$sql="INSERT INTO customerinfo_tb (cmpName,cmpCell,cmpEmail,cmpAddress,cmpArea,cmpWeb,cmpYearlyRevenue,cmpYearOfEst,cmpNumEmp,cmpPayMethod,refName,refCell,ownerId) (SELECT cmpName,cmpCell,cmpEmail,cmpAddress,cmpArea,cmpWeb,cmpYearlyRevenue,cmpYearOfEst,cmpNumEmp,cmpPayMethod,refName,refCell,ownerId FROM leadinfo_tb WHERE leadId=:leadId)";
			$snt=$this->connection->prepare($sql);
			$snt->bindValue(':leadId',$leadId);
			if($snt->execute()){

					$sql="SELECT * FROM customerinfo_tb WHERE cmpEmail = :mail LIMIT 1";
					$pre=$this->connection->prepare($sql);
					$pre->bindValue(':mail', $mail);	
					if($pre->execute()){
						while($row=$pre->fetch()){
							$x = $row["customId"];
						}
						$update="UPDATE customerinfo_tb SET userPassword = '$pass' WHERE customId=:id";
						$uuu=$this->connection->prepare($update);
						$uuu->bindValue(':id', $x);		
						$uuu->execute();
					}

					$update="UPDATE contactinfo_tb SET customerId = :cid, leadId = 0 WHERE leadId=:id";
					$nup=$this->connection->prepare($update);
					$nup->bindValue(':cid', $x);
					$nup->bindValue(':id', $leadId);
					if($nup->execute()){
						$sq="DELETE FROM leadinfo_tb WHERE leadId=:lId ";
						$sn=$this->connection->prepare($sq);
						$sn->bindValue(':lId', $leadId);
						if($sn->execute()){
							$this->customerProduct($x,$productId,$cost,$title);
							// header('location:user/leads.php');
						}
					}
					
			}

		} 
		catch (Exception $e) {
			echo $e->getMessage();
		}
	}

	public function customerNewProduct($cid, $pid, $cost,$title){
			try {
				// echo $cid,$pid;
				$sql="INSERT INTO customerproduct_tb (customerId, productId,title,cost) VALUES(:cid, :pid,:title,:cost)";
				$qur = $this->connection->prepare($sql);
				$qur->bindValue(':cid',$cid);
				$qur->bindValue(':pid',$pid);
				$qur->bindValue(':title',$title);
				$qur->bindValue(':cost',$cost);
				if($qur->execute())
				{
					// echo "ok";
					$_SESSION["productAdd"]='yes';
					return true;
				}



			} catch (Exception $e) {
				echo $e->getMessage();
			}
	}


	//User Entry 

	public function userEntry()
	{
		$name = trim($_POST['fName']);
		$idNum = $_POST['id'];
		$designation = $_POST['designation'];
		$cell = $_POST['cell'];
		$type = $_POST['type'];
		$mail = trim($_POST['mail']);
		$pass = $this->scrypt(trim($_POST['password']));
		$cmpId = $_POST['cmpId'];


		try{
				
				$insert="INSERT INTO user_tb (userName, userPassword, userType, fullName, cell, designation, companyId, idNumber) VALUES(:uname, :pass, :type, :fname, :cell, :desg, :cid, :id)";

				if($stmt= $this->connection->prepare($insert)){
					$stmt->bindValue(':uname', $mail);
					$stmt->bindValue(':pass', $pass);				
					$stmt->bindValue(':type', $type);				
					$stmt->bindValue(':fname', $name);				
					$stmt->bindValue(':cell', $cell);				
					$stmt->bindValue(':desg', $designation);				
					$stmt->bindValue(':cid', $cmpId);				
					$stmt->bindValue(':id', $idNum);				
					if($stmt->execute()){
							$_SESSION["userIn"]='yes';
					}
				}
			}
			catch(Exception $ex){
				echo $ex->getMessage();
	    		// throw $ex;
			}
	}


	//product Entry 

	public function productEntry()
	{
		$name = $_POST['name'];
		$type = $_POST['type'];
		$des = $_POST['description'];

		try{
				
				$insert="INSERT INTO product_tb (productName, description, productType) VALUES(:name, :des, :type)";

				if($stmt= $this->connection->prepare($insert)){
					$stmt->bindValue(':name', $name);
					$stmt->bindValue(':des', $des);				
					$stmt->bindValue(':type', $type);								
					if($stmt->execute()){
							$_SESSION["productIn"]='yes';
							return true;
					}
				}
			}
			catch(Exception $ex){
				echo $ex->getMessage();
	    		// throw $ex;
			}
	}

//adding information in expenditureinfo table
	public function addExpenditure()
	{
		$cpId = $_POST['cpId'];
		$item =  $_POST['item'];
		$quantity = $_POST['quantity'];
		$hours = $_POST['hours'];
		$cost = $_POST['cost'];
		$exdate = $_POST['date'];
		try{
				
				$insert="INSERT INTO expenditure_tb (item,quantity, cost, hours,exdate,cpId) VALUES(:item,:quantity, :cost, :hours,:exdate,:cpId)";

				if($stmt= $this->connection->prepare($insert)){
					$stmt->bindValue(':item', $item);
					$stmt->bindValue(':quantity', $quantity);
					$stmt->bindValue(':cost', $cost);				
					$stmt->bindValue(':hours', $hours);								
					$stmt->bindValue(':exdate', $exdate);								
					$stmt->bindValue(':cpId', $cpId);								
					if($stmt->execute()){
							$_SESSION["expenditureIN"]='yes';
							return true;
					}
				}
			}
			catch(Exception $ex){
				echo $ex->getMessage();
	    		// throw $ex;
			}

	}


//new invoice Entry
	public function addInvoice($frm,$to,$sig,$twrk)
	{
		$all=new newList();
	    $row = $all->limitOne('select * from invoicelist_tb order by id desc limit 1');
	    var_dump($row["invoSerial"]);
	    if($row["invoSerial"]>=1000){
	    	$srl = $row["invoSerial"]+1;
	    }
	    else{
	    	$srl = 1001;
	    }
		try{
				
				$insert="INSERT INTO invoicelist_tb (toWork,invoFrom,invoTo,signature,invoSerial) VALUES(:twrk,:frm,:to,:sig,:srl)";

				if($stmt= $this->connection->prepare($insert)){
					$stmt->bindValue(':twrk', $twrk);
					$stmt->bindValue(':frm', $frm);
					$stmt->bindValue(':to', $to);				
					$stmt->bindValue(':sig', $sig);								
					$stmt->bindValue(':srl', $srl);								
					if($stmt->execute()){
							$_SESSION["invoiceIn"]= 'yes';
							return $srl;
					}
				}
			}
			catch(Exception $ex){
				echo $ex->getMessage();
	    		// throw $ex;
			}

	}
//adding information into invoice info table
	public function addInvoiceInfo()
	{
		$item = $_POST['item'];
		$unit = $_POST['unit'];
		$quantity = $_POST['quantity'];
		$cost = $_POST['cost'];
		$ili = $_POST['ILI'];
		try{
				
				$insert="INSERT INTO invoicesinfo_tb (ILI,work,unit,quantity,unitCost) VALUES(:ili,:item,:unit,:quantity,:cost)";

				if($stmt= $this->connection->prepare($insert)){
					$stmt->bindValue(':ili', $ili);
					$stmt->bindValue(':item', $item);
					$stmt->bindValue(':unit', $unit);
					$stmt->bindValue(':quantity', $quantity);
					$stmt->bindValue(':cost', $cost);							
					if($stmt->execute()){
							$_SESSION["invoceInfoIn"]='yes';
							return true;
					}
				}
			}
			catch(Exception $ex){
				echo $ex->getMessage();
	    		// throw $ex;
			}

	}

//adding note
	public function addNote()
	{
		$item = $_POST['Note'];
		$ili = $_POST['ILI'];
		try{
				
				$insert="INSERT INTO note_tb (note,invoId) VALUES(:note,:ili)";

				if($stmt= $this->connection->prepare($insert)){
					$stmt->bindValue(':note', $item);
					$stmt->bindValue(':ili', $ili);							
					if($stmt->execute()){
							$_SESSION["invoceInfoIn"]='yes';
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

	public function companyEntry()
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
		$logo = 'logo';
		$logo = $this->upFile($logo,'companylogo/',$name);

		try{
				
				$insert="INSERT INTO companyinfo_tb (companyName, cmpCell, cmpEmail,web,address,logoname,serverhost,username,password,smtpPort,serverSSL) VALUES(:name, :cell, :mail, :web, :add, :logo,:host,:username,:pass,:port,:ssl)";

				if($stmt= $this->connection->prepare($insert)){
					$stmt->bindValue(':name', $name);
					$stmt->bindValue(':cell', $cell);				
					$stmt->bindValue(':mail', $mail);								
					$stmt->bindValue(':web', $web);								
					$stmt->bindValue(':add', $add);								
					$stmt->bindValue(':logo', $logo);								
					$stmt->bindValue(':host', $host);								
					$stmt->bindValue(':username', $username);								
					$stmt->bindValue(':pass', $pass);								
					$stmt->bindValue(':port', $port);								
					$stmt->bindValue(':ssl', $ssl);								
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


// Signature Entry
	public function SignatureEntry()
	{
		$name = $_POST['signame'];
		$dsg = $_POST['designation'];
		$sig = "sig";
		$sig = $this->upFile($sig,'signature/',$name);

		try{
				
				$insert="INSERT INTO signature_tb (name, designation, signame) VALUES(:name, :des, :type)";

				if($stmt= $this->connection->prepare($insert)){
					$stmt->bindValue(':name', $name);
					$stmt->bindValue(':des', $dsg);				
					$stmt->bindValue(':type', $sig);								
					if($stmt->execute()){
							$_SESSION["productIn"]='yes';
							return true;
					}
				}
			}
			catch(Exception $ex){
				echo $ex->getMessage();
	    		// throw $ex;
			}
	} 

//password resetting 

	public function passwordReset($pass,$id)
	{
		
		$sql="UPDATE user_tb SET userPassword = :pass WHERE userId = :id";
		$pre = $this->connection->prepare($sql);
		$pre->bindValue(':pass',$this->scrypt($pass));
		$pre->bindValue(':id', $id);
		if($pre->execute()){
			return true;
		}
	}
//invoice send information
	public function invoSendStatus($serial)
	{
			$sql="UPDATE invoicelist_tb SET sendStatus = 1 WHERE invoSerial= :inser";
			$pre = $this->connection->prepare($sql);
			$pre->bindValue(':inser',$serial);
			if($pre->execute()){
				return true;
			}
	}

}
//END OF CLASS


//Actions of all buttons from customer and leads

if(isset($_REQUEST["btn"])){

	//inserting the customer information
	$object = new CustomerEntry();
	$object->customEntry();

	//after inserting customer into table then getting the customer id and with the id prodcut is being added
	$all=new newList();
	$var="SELECT * FROM customerinfo_tb WHERE cmpEmail = :id";
    $par=':id';
    $row = $all->sqlFun($var,$par,$_POST['cmpEmail']);
    $cm=$row['customId'];
	$prod=$_POST['product'];
	$cost=$_POST['cost'];
	$title=$_POST['title'];
	$object->customerProduct($cm,$prod,$cost,$title);

	unset($object);
	unset($all);
	header('location:user/customer.php');
}

//lead is converting to customer
if(isset($_REQUEST["leadToCutom"])){
	$proId= $_POST['product'];
	$leadId= $_POST['ldid'];
	$title= $_POST['title'];
	$cost= $_POST['cost'];
	$obj = new CustomerEntry();
	$obj->leadToCustom($leadId,$proId,$cost,$title);
	unset($obj);
	header('location:user/customer.php');


}

//cutomer is being added with new products
if (isset($_REQUEST["customToProd"])) {
	$obj=new CustomerEntry();
	$obj->customerNewProduct($_POST['cid'],$_POST['product'],$_POST['cost'],$_POST['title']);
	unset($obj);
	header('location:user/customer.php');
	// echo $_POST['title'];
	// echo $_POST['cid'];
}

//User Entry
if (isset($_REQUEST["userEntry"])) {
	$obj=new CustomerEntry();
	$obj->userEntry();
	unset($obj);
	header('location:user/users.php');

}

//User Entry
if (isset($_REQUEST["productEntry"])) {


	$obj=new CustomerEntry();
	if($obj->productEntry()){
		unset($obj);
		header('location:user/products.php');	
	}
	
	unset($obj);

}

//expenditure adding into expenditure table

if (isset($_REQUEST["addExpenditure"])) {
	$cpId = $_POST['cpId'];
	$obj=new CustomerEntry();
	if($obj->addExpenditure()){
		unset($obj);
		header('location:user/addExpenditure.php?xkpnt='.$cpId.'&exp=true');	
	}
	
	unset($obj);
}

// adding company into table

if (isset($_REQUEST["compBtn"])) {
	$obj=new CustomerEntry();
	if($obj->companyEntry()){
		unset($obj);
		header('location:user/setup.php');	
	}
	
	unset($obj);
}

// adding company into table

if (isset($_REQUEST["sigbtn"])) {
	$obj=new CustomerEntry();
	if($obj->SignatureEntry()){
		unset($obj);
		header('location:user/setup.php');	
	}
	
	unset($obj);
}

//reseting password
if (isset($_REQUEST["resetPa"])) {
	$pass = $_POST['pass'];
	$obj=new CustomerEntry();
	if($obj->passwordReset($pass, $_SESSION["userId"])){
		unset($obj);
		header('location:user/myProfile.php');	
	}
	
	unset($obj);
}
//new invoice Creation
if (isset($_REQUEST["crtInv"])) {
	if (isset($_POST['from']) && isset($_POST['to']) && isset($_POST['sig'])) {
		$frm = $_POST['from'];
		$to = $_POST['to'];
		$sig = $_POST['sig'];
		$twrk = $_POST['towork'];
		$obj=new CustomerEntry();
		$srl = $obj->addInvoice($frm,$to,$sig,$twrk);
		$srl = $obj->scrypt($srl);
		unset($obj);
		header('location:user/createInvoice.php?new&ser='.$srl);
	} else {
		header('location:user/invoicePage.php');
	}
	

}

//new invoice information creation
if (isset($_REQUEST["addfield"])) {
	$obj=new CustomerEntry();
	$ili = $_POST['ILI'];
	$obj->addInvoiceInfo();
	$obj1 = new newList();
    $sql="SELECT * FROM invoicelist_tb WHERE id = :id ORDER BY id DESC";
    $par =":id";
    $id = $ili;
    $row = $obj1->sqlFun($sql,$par,$id);
    $ili = $obj->scrypt($row["invoSerial"]);
	unset($obj);
	unset($obj1);
	header('location:user/createInvoice.php?new&ser='.$ili);
}


//new note
if (isset($_REQUEST["addnote"])) {
	$obj=new CustomerEntry();
	$ili = $_POST['ILI'];
	$obj->addNote();
	$obj1 = new newList();
    $sql="SELECT * FROM invoicelist_tb WHERE id = :id ORDER BY id DESC";
    $par =":id";
    $id = $ili;
    $row = $obj1->sqlFun($sql,$par,$id);
    $ili = $obj->scrypt($row["invoSerial"]);
	unset($obj);
	unset($obj1);
	header('location:user/createInvoice.php?new&ser='.$ili);
}