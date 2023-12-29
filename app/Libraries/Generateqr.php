<?php
namespace App\Libraries;

include APPPATH . 'thirdparty/phpqrcode/generate.php';

class Generateqr
{
    public function __construct()
    {
    }

    public function generate($text)
    {
        return generateQR($text);
    }
}