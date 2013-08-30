<?php

// Include the main TCPDF library (search for installation path).
require_once('/home/wira/tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, 'mm', "A6", true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Schematics ITS');
$pdf->SetTitle('Kartu Peserta NLC Schematics');

$pdf->SetMargins(1,1,1);

$pdf->AddPage();
$pdf->SetAutoPageBreak(TRUE, 0);



$judul = <<<EOD
<br/>
<h2>
Kartu Peserta<br/>
National Logic Competition
</h2>
<h3>Tim Kestari</h3>
EOD;

$nama = <<<EOD
<strong>Novandi Banitama</strong><br/>
SMAN 1 ITS
EOD;

$pdf->Image('./assets/img/logo.png', '','', 40, 40, 'PNG', '', '', true, 150, 'C');
$pdf->writeHTMLCell('','', 0, 40, $judul, 0, 1, 0, true, 'C', true);
$pdf->Image('./assets/img/novandi-pasfoto.png', '','', 40, 50, 'PNG', '', '', true, 150, 'C', false, false, 1);
$pdf->writeHTMLCell('','', 0, 130, $nama, 0, 1, 0, true, 'C', true);


$pdf->Output('example_001.pdf', 'I');


?>
