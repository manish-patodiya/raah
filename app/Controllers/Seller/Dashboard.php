<?php

namespace App\Controllers\Seller;

use App\Controllers\Seller\SellerController;

class Dashboard extends SellerController
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
        return view('seller/dashboard', $data);
    }

}