<?php
namespace App\Controllers\Admin\Notifications;

use App\Controllers\Admin\AdminController;

class Notification extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->NotificationModel = model('NotificationModel');
    }

    public function index()
    {
        $uid = $this->session->admin_info['user_id'];
        $notifications = $this->NotificationModel->get_user_screen_notification($uid);

        $data = [
            'session' => $this->session,
            'notifications' => $notifications,
        ];
        return view('admin/notifications/notification', $data);
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