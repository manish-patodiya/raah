<?php

namespace App\Controllers\Customer;

use App\Controllers\Customer\CustomerController;

class ReviewAndRating extends CustomerController
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
        return view('customer/reviews_and_ratings', $data);
    }

}