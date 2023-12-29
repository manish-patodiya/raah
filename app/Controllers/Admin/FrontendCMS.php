<?php
namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminController;

class FrontendCMS extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->frontend_model = model('FrontendModel');
    }

    public function index()
    {
        $data = [
            'session' => $this->session,
            'home' => $this->frontend_model->get_by_id("1"),
            'about' => $this->frontend_model->get_by_id("2"),
            'terms_conditions' => $this->frontend_model->get_by_id("3"),
            'privacy_policy' => $this->frontend_model->get_by_id("4"),
            'cncl_policy' => $this->frontend_model->get_by_id("5"),
            'rrr_policy' => $this->frontend_model->get_by_id("6"),
            'disclosure_policy' => $this->frontend_model->get_by_id("7"),
            'intellectual_policy' => $this->frontend_model->get_by_id("8"),
            'anti_plishing_alert' => $this->frontend_model->get_by_id("9"),
        ];
        return view('admin/frontend_cms/frontend_cms', $data);
    }
    public function edit()
    {
        $post_data = $this->request->getPost();
        $result = $this->frontend_model->updateRow($post_data);
        if ($result) {
            echo json_response(1, "Update successfully.");
        } else {
            echo json_response(0, 'Something went wrong. Please try after some time.');
        }
    }
}