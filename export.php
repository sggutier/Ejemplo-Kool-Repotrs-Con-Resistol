<?php

if($_GET["peticion"]) {
    require_once "CoronaPorPais.php";
    $report = new CoronaPorPais();

    $report->run()->render('CoronaPorPaisPdf');
}
else {
    $nombrePdf = '';
    $vals = array_merge(range(0, 9), range('a', 'z'));
    for ($i = 0; $i < 50; $i++) {
        $nombrePdf .= $vals[array_rand($vals)];
    }
    $nombrePdf .= ".pdf";
    exec('./generaPdf.sh ' . $nombrePdf);
    $attachment_location = $_SERVER["DOCUMENT_ROOT"] . '/' . $nombrePdf;
    if (file_exists($attachment_location)) {
        header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
        header("Cache-Control: public"); // needed for internet explorer
        header("Content-Type: application/pdf");
        header("Content-Transfer-Encoding: Binary");
        header("Content-Length:".filesize($attachment_location));
        header("Content-Disposition: attachment; filename=reporte_covid.pdf");
        readfile($attachment_location);
        unlink($attachment_location);
        die();
    } else {
        die("Error: File not found.");
    }
}