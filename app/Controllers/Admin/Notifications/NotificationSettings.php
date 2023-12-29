<?php
namespace App\Controllers\Admin\Notifications;

use App\Controllers\Admin\AdminController;

class NotificationSettings extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->NotificationModel = model('NotificationModel');
    }

    public function index()
    {
        $data = [
            'session' => $this->session,
            'setting' => $this->NotificationModel->get_notification_settings(),
        ];
        return view('admin/notifications/settings', $data);
    }

    public function save_settings()
    {
        if ($this->request->isAJAX()) {
            $arr = [];
            $arr = array_merge($arr, [
                'per_page' => 'required|is_natural',
                'email_limit' => 'required|is_natural',
                'notification_text_limit' => 'required|is_natural',
            ]);
            $check = $this->validate($arr, [
                'per_page' => [
                    'is_natural' => 'Per Page must be greater than or equal to 0',
                ],
                'email_limit' => [
                    'is_natural' => 'Email limit must be greater than or equal to 0',
                ],
                'notification_text_limit' => [
                    'is_natural' => 'Notification text limit must be Greater than or equal to 0',
                ],
            ]);

            if ($check) {
                $post_data = $this->request->getPost();
                $data = [
                    'per_page' => $post_data['per_page'],
                    'email_limit' => $post_data['email_limit'],
                    'notification_text_limit' => $post_data['notification_text_limit'],
                ];
                $res = $this->NotificationModel->set_notification_settings($data);
                if ($res) {
                    echo json_encode([
                        'status' => 1,
                        'msg' => 'Update Successfully',
                    ]);
                } else {
                    echo json_encode([
                        'status' => 0,
                        'msg' => 'Something went wrong',
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => 0,
                    'msg' => 'Form validation Error',
                    'errors' => $this->validation->getErrors(),
                ]);
            }
        } else {
            error404();
        }
    }
}