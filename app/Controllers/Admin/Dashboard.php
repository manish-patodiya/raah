<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminController;

class Dashboard extends AdminController
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
        return view('admin/dashboard', $data);
    }

}