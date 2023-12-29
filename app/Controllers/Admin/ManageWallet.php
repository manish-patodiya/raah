<?php
namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminController;

class ManageWallet extends AdminController
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
        return view('admin/manage_wallet', $data);
    }
}
