<?php

function generateQR($text)
{

//set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = FCPATH . 'public' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'qrcodes' . DIRECTORY_SEPARATOR;

//html PNG location prefix
    $PNG_WEB_DIR = 'temp/';
    include "qrlib.php";

//ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR)) {
        mkdir($PNG_TEMP_DIR);
    }

    $filename = $PNG_TEMP_DIR . uniqid() . ".png";

//processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'L';
    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L', 'M', 'Q', 'H'))) {
        $errorCorrectionLevel = $_REQUEST['level'];
    }

    $matrixPointSize = 4;
    if (isset($_REQUEST['size'])) {
        $matrixPointSize = min(max((int) $_REQUEST['size'], 1), 10);
    }

    if (isset($_REQUEST['data'])) {

        //it's very important!
        if (trim($_REQUEST['data']) == '') {
            die('data cannot be empty! <a href="?">back</a>');
        }

        // user data
        $filename = $PNG_TEMP_DIR . 'test' . md5($_REQUEST['data'] . '|' . $errorCorrectionLevel . '|' . $matrixPointSize) . '.png';
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);

    } else {

        QRcode::png($text, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
        if (file_exists($filename)) {
            return $filename;
        } else {
            return false;
        }

    }

// benchmark
    //QRtools::timeBenchmark();

    // return basename($filename);
}