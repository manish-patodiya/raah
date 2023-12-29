<?php

namespace App\Controllers\Customer;

use App\Controllers\Customer\CustomerController;

class Notifications extends CustomerController
{
    public function __construct()
    {
        parent::__construct();
        $this->NotificationModel = model('NotificationModel');
    }

    public function index()
    {
        $uid = $this->session->customer_info['user_id'];
        $notifications = $this->NotificationModel->get_user_screen_notification($uid);

        $data = [
            'session' => $this->session,
            'notifications' => $notifications,
        ];
        return view('customer/notifications', $data);
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $res = $this->NotificationModel->delete_user_screen_notification($id);
        if ($res) {
            json_response(1, "Successfully deleted");
        } else {
            json_response(0, 'Something went wrong');
        }
    }

}