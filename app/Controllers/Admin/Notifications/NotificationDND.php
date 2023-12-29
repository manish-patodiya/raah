<?php
namespace App\Controllers\Admin\Notifications;

use App\Controllers\Admin\AdminController;

class NotificationDND extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->notification_dnd = model('NotificationModel');
    }

    public function index()
    {
        $data = [
            'session' => $this->session,
        ];
        return view('admin/notifications/notification_dnd', $data);
    }
    public function datatable_json()
    {
        check_method_access('notification_dnd', 'view');
        $details = $this->notification_dnd->notification_dnd();
        $arr = [];
        $i = 0;
        foreach ($details as $k => $v) {
            $arr[] = [
                ++$i,
                $v->user_email,
                $v->reason,
            ];
        }
        echo json_encode([
            "status" => 1,
            "details" => $arr,
        ]);
    }

}