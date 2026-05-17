<?php

require_once('fpdf/fpdf.php');

try{

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db   = "report_db";

    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $stmt = $pdo->query("SELECT id, name, grade, score FROM students");

}  catch (PDOEexcepion $e){
    die("koneksi gagal: " . $e->getMessage()); 
}

//================CLASS PDF ======================
class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial','B',14 );
        $this->Cell(0,10,'Student Report', 0,1,'C');
        $this->Ln(5);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page' . $this->PageNo(),0,0,'C');
    }
}
//=================
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B', 10);

$pdf->Cell(20,10,'ID',1,0,'C');
$pdf->Cell(60,10,'Name',1,0,'C');
$pdf->Cell(40,10,'Grade',1,0,'C');
$pdf->Cell(40,10,'Score',1,1,'C');

$pdf->SetFont('Arial','',10);
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $pdf->Cell(20,10,$row['id'],1,0,'C');
    $pdf->Cell(60,10,$row['name'],1,0,'C');
    $pdf->Cell(40,10,$row['grade'],1,0,'C');
    $pdf->Cell(40,10,$row['score'],1,1,'C');

}

$pdf->Output('I','student_report.pdf');
?>