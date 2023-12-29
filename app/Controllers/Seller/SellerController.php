<?php
namespace App\Controllers\Seller;

use App\Controllers\BaseController;

class SellerController extends BaseController
{
    public function __construct()
    {
        check_seller_login();
        $uri = service('uri');
        $uri_arr = $uri->getSegments();
        $exceptional_uri = ['support', 'notifications'];
        if (!check_seller_store()) {
            if (!in_array($uri_arr[1], $exceptional_uri)) {}
            header("Location:" . base_url('seller/store'));
            exit;
        }
    }
}