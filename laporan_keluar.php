<?php
session_start();
include 'config/koneksi.php';
require('fpdf/fpdf.php');

// CEK LOGIN SESUAI SISTEM KAMU
if(!isset($_SESSION['login'])){
    echo "<script>
        alert('Anda harus login dulu!');
        window.location='login.php';
    </script>";
    exit;
}

// Ambil nama user untuk tanda tangan
$id = $_SESSION['id_user'];
$q = mysqli_query($conn,"SELECT nama FROM users WHERE id_user='$id'");
$user = mysqli_fetch_array($q);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,'LAPORAN KAS KELUAR UKM ENGLISH CLUB',0,1,'C');

$pdf->SetFont('Arial','',12);
$pdf->Cell(0,6,'PERIODE 2025/2026',0,1,'C');

$pdf->SetFont('Arial','',10);
$pdf->Cell(0,6,'Tanggal Cetak: '.date('d-m-Y'),0,1,'C');

$pdf->Ln(5);

// HEADER TABEL
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,8,'No',1,0,'C');
$pdf->Cell(30,8,'Tanggal',1,0,'C');
$pdf->Cell(40,8,'Jumlah',1,0,'C');
$pdf->Cell(90,8,'Keterangan',1,0,'C');
$pdf->Ln();

$pdf->SetFont('Arial','',10);

$query = mysqli_query($conn,"SELECT * FROM kas_keluar ORDER BY tanggal ASC");

$no = 1;
$total = 0;

while($d = mysqli_fetch_array($query)){

    $rupiah = "Rp " . number_format($d['jumlah'],0,',','.');
    $tgl = date('d-m-Y', strtotime($d['tanggal']));

    $pdf->Cell(10,8,$no++,1,0,'C');
    $pdf->Cell(30,8,$tgl,1,0,'C');
    $pdf->Cell(40,8,$rupiah,1,0,'C');
    $pdf->Cell(90,8,$d['keterangan'],1,0,'L');
    $pdf->Ln();

    $total += $d['jumlah'];
}

// TOTAL
$pdf->Ln(5);
$pdf->SetFont('Arial','B',11);

$pdf->Cell(40,8,'TOTAL KAS KELUAR : ',0,0,'L');
$pdf->Cell(50,8,'Rp '.number_format($total,0,',','.'),0,1,'L');

// TTD
$pdf->Ln(10);
$pdf->SetFont('Arial','',10);

$pdf->Cell(0,6,'Mengetahui,',0,1,'R');
$pdf->Cell(0,6,'Bendahara UKM',0,1,'R');

$pdf->Ln(15);
$pdf->Cell(0,6,'Anisa Febrianti',0,1,'R');

$pdf->Output();
?>
