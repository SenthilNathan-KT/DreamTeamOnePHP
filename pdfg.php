<?php
//include connection file 
include "dbconnect.php";
include_once('fpdf184/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    
	$this->Image('logo/conestogalogo.png',95,10,30);
	$this->Ln(10);
    $this->SetFont('Arial','B',13);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,35,'Conestoga Collge');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}


$result = mysqli_query($conn, "SELECT
  student.Name as name,
  student.ID as id,
  databse.Course_Title as dbCrs,
  databse.Letter_Grade as dbLg,
  javascript.Course_Title as jsCrs,
  javascript.Letter_Grade as jsLtr
FROM student
JOIN databse ON student.id=databse.id
JOIN javascript
  ON student.id = javascript.id;") or die("database error:". mysqli_error($conn));


$pdf = new PDF();
foreach($result as $row) {


//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->Ln();
$tDate=date('d-m-Y');
$pdf->SetFont('Arial','B',16);
$pdf->Cell(130,10,'Name of the Student: '.$row['name']);
$pdf->Cell(0,10,'Date: '.$tDate,0, 1);
$pdf->Cell(0,10,'Student ID: '.$row['id'],0,10);
$pdf->Ln(20);
$pdf->Cell(130,10,$row['dbCrs']);
$pdf->Cell(0,10,$row['dbLg'],0,1);
$pdf->Cell(130,10,$row['jsCrs']);
$pdf->Cell(50,10,$row['jsLtr'],50,1);
$pdf -> Line(140, 200, 200, 200);
$pdf->Ln(70);
$pdf -> SetX(140);
$pdf->Cell(0, 0,'Signature');


}
$pdf->Output();

?>
