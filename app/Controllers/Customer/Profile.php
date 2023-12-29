<?php

namespace App\Controllers\Customer;

use App\Controllers\Customer\CustomerController;

class Profile extends CustomerController
{
    public function __construct()
    {
        parent::__construct();
        $this->usermodel = model('UserModel');
        $this->profilemodel = model('ProfileModel');
    }

    public function index()
    {
        $id = $this->session->customer_info['user_id'];
        $details = $this->profilemodel->getUser($id);
        $sid = $details->state_id;
        $states = model('StateModel')->getAll();
        $city = model('CityModel')->getAllState_id($sid);

        $user_id = $this->session->customer_info['user_id'];
        $user_detail = model('UserModel')->get($user_id);
        $data = [
            'session' => $this->session,
            'info' => $details,
            'user_detail' => $user_detail,
            'states' => $states,
            'city' => $city,
        ];
        return view('customer/profile', $data);
    }

}