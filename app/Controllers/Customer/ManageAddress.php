<?php

namespace App\Controllers\Customer;

use App\Controllers\Customer\CustomerController;

class ManageAddress extends CustomerController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = [
            'session' => $this->session,
        ];
        return view('customer/address/manage_address', $data);
    }

}