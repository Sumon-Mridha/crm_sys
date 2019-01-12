<?php
require '../OAuth/fpdf181/fpdf.php';
require '../OAuth/Security.php';
require '../clientEntry.php';
 $sn= new Session();
 $sn->init();

include '../inwordConv.php';


class PDF extends FPDF
{
	public $name;
	public $address;
	public function setInfo($name,$add)
	{
		$this->name = $name;
		$this->address = $add;
	}

	function Header()
	{
	    $this->SetFont('Arial','I',10);
		$this->cell(190,20,$this->image('../uploads/companylogo/'.$this->name,5,1,-300),0,1,'C');
		$this->cell(190,5,$this->address,'B',1,'L');
		$this->cell(190,5,'',0,1,'L');
	}
	function Footer()
	{
	    // Go to 1.5 cm from bottom
	    $this->SetY(-15);
	    // Select Arial italic 8
	    $this->SetFont('Arial','I',10);
	    // Print centered page number
		$this->Cell(195,5,'Page '.$this->PageNo(),0,1,'C');
		$this->Cell(195,5,'This Invoice is Generated by LINE CRM System.',0,0,'R');
	}
}

function CreatPDF($value,$action)
{
	$data = array();
//getting all the info
    $obj = new newList();
//invoice list
    $sql="SELECT * FROM invoicelist_tb WHERE invoSerial = :id ORDER BY id DESC";
    $par =":id";
    $id = $value;
    $row1 = $obj->sqlFun($sql,$par,$id);
    $id = $row1["id"];
//invoice Info
    $sql="SELECT * FROM invoicesinfo_tb WHERE ILI = :id";
    $par =":id";
    $row2 = $obj->Fun($sql,$par,$id);
//To(company)
    $sql="SELECT * FROM customerinfo_tb WHERE customId = :id";
    $par =":id";
    $row3 = $obj->sqlFun($sql,$par,$row1["invoTo"]);

//To(company)
    $sql="SELECT * FROM companyinfo_tb WHERE cmpId = :id";
    $par =":id";
    $row4 = $obj->sqlFun($sql,$par,$row1["invoFrom"]);
//signature
    $sql="SELECT * FROM signature_tb WHERE id = :id";
    $par =":id";
    $row5 = $obj->sqlFun($sql,$par,$row1["signature"]);
//Note
    $sql="SELECT * FROM note_tb WHERE invoId = :id";
    $par =":id";
    $note = $obj->Fun($sql,$par,$id);


 //return array with information
    $data["cmpID"]= $row1["invoFrom"];
    $data["email"]= $row3["cmpEmail"];
    $data["serial"]= $value;
    $data["towork"]= $row1["toWork"];

// company information:-
 //Right side
	date_default_timezone_set('Asia/Dhaka');
	$date = date('Y-M-d');
	$serial = $value;

// left side
	$fcompanyName = $row4["logoname"];
	$faddress = $row4["address"];
	$tcompanyName =$row3["cmpName"];
	$taddress = $row3["cmpAddress"];
	$work = $row1["toWork"];
	$Money = '';
	$name = $row5["name"];
	$designation = $row5["designation"];
	$logo1 = '../uploads/signature/'.$row5["signame"];

//class obj
	$pdf = new PDF('p','mm','A4');
	$pdf->setInfo($fcompanyName,$faddress);
	$pdf->AddPage();
	
	// $pdf->Image($logo1,1,1,-300);
	$pdf->SetFont('Arial','B',20);
	$pdf->cell(190,5,"Invoice",0,1,'C');
	$pdf->cell(190,10,"",0,1,'C');

//name of the company:
	$pdf->SetFont('Arial','',10);
	$pdf->cell(95,5,"Client: ".$tcompanyName,0,0,'L');
	$pdf->cell(100,5,"Date: ".$date,0,1,'R');
	$pdf->cell(100,5,"Address: ".$taddress,0,0,'L');
	$pdf->cell(95,5,"Serial: ".$serial,0,1,'R');
	$pdf->cell(190,2,"",0,1,'C');
	$pdf->cell(195,5,"To Work: ".$work,0,1,'L');
	$pdf->cell(190,2,"",0,1,'C');
	
//Table
	$pdf->SetFont('Arial','B',12);
	$pdf->cell(5,5,"#",1,0,'C');
	$pdf->cell(100,5,"Work",1,0,'C');
	$pdf->cell(30,5,"Unit",1,0,'C');
	$pdf->cell(20,5,"Quantity",1,0,'C');
	$pdf->cell(20,5,"Price",1,0,'C');
	$pdf->cell(20,5,"Total",1,1,'C');

	$pdf->SetFont('Arial','',10);
	$cnt=1;
	$sum = 0;
foreach ($row2 as $key) {
	
	$pdf->cell(5,5,$cnt,1,0,'C');
	$pdf->cell(100,5,$key["work"],1,0,'');
	$pdf->cell(30,5,$key["unit"],1,0,'C');
	$pdf->cell(20,5,$key["quantity"],1,0,'C');
	$pdf->cell(20,5,$key["unitCost"],1,0,'C');
	$pdf->cell(20,5,number_format($key["quantity"]*$key["unitCost"]),1,1,'C');
	$sum += $key["quantity"]*$key["unitCost"];
	$cnt++;
}
$pdf->SetFont('Arial','B',10);
$pdf->cell(155,5,"Total",1,0,'C');
$pdf->cell(40,5,number_format($sum).' /=',1,0,'C');
//footer:
//number formatter 
// $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
// $f->format($sum)
//



//notes

	$pdf->cell(190,10,"",0,1,'C');
	$pdf->SetFont('Arial','B',10);
	$pdf->cell(95,10,"Amount In Words: ".ucwords(trim(inword($sum))).' Taka Only',0,1,'L');
if (sizeof($note)>0) {
	$pdf->cell(100,10,"Notes: ",0,1,'L');
	$pdf->SetFont('Arial','',10);
	$cnt=1;
	foreach($note as $key) {
		$pdf->cell(10,5,"",0,0,'L');
		$pdf->cell(5,5,$cnt.'.',0,0,'C');
		$pdf->cell(100,5,$key["note"],0,1,'');
		$cnt++;
	}
} 



//invoice end
	$pdf->SetFont('Arial','',10);
	$pdf->cell(190,10,"",0,1,'C');
	$pdf->cell(95,5,"Sincerely ",0,1,'L');
	$pdf->Cell( 40, 10, $pdf->Image($logo1, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 1, 'L', false );
	$pdf->cell(100,10,'___________________',0,1,'L');
	$pdf->cell(100,5,$name,0,1,'L');
	$pdf->cell(95,5,$designation,0,1,'L');
	if($action=='pre'){
		$pdf->OutPut();
	}
	if ($action=='snd') {
		$pdf->OutPut('../uploads/invoices/'.$serial.'.pdf','F');
		return $data;
		
	}
}


// $data = CreatPDF(1001,'snd');

if (isset($_GET['pre']) && isset($_GET['ser'])){
	CreatPDF(scrypt($_GET['ser'],'D'),'pre');
}
if (isset($_GET['snd']) && isset($_GET['ser'])){
	$_SESSION["open"]='yes';
	$_SESSION["invoiceAr"] = CreatPDF(scrypt($_GET['ser'],'D'),'snd');
	$obj = new CustomerEntry();
	$obj->invoSendStatus(scrypt($_GET['ser'],'D'));
	header('location:../proposalSend.php');
}
