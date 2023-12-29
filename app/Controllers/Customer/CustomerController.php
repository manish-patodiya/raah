<?php
namespace App\Controllers\Customer;

use App\Controllers\BaseController;

class CustomerController extends BaseController
{
    public function __construct()
    {
        check_customer_login();
    }
}