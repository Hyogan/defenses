<?php
require_once '/home/tiagho/Desktop/DKAH/projects/defenses/phoneline-manage/App/lib/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(40, 10, 'Hello, Helvetica!');
$pdf->Output();
?>
