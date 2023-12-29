<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
    public function __construct()
    {
        $uri = service('uri');
        if (count($uri->getSegments()) > 3 && strtolower($uri->getSegment(4)) == 'getcities') {
            return true;
        } else {
            check_admin_login();
        }
    }
}