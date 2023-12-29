<?php
namespace App\Controllers\Admin\Support;

use App\Controllers\Admin\AdminController;

class FAQs extends AdminController
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
        return view('admin/support/faqs', $data);
    }
}