<?php
namespace App\Controllers\Seller\Notifications;

use App\Controllers\Seller\SellerController;

class Notification extends SellerController
{
    public function __construct()
    {
        check_seller_login();
        $this->NotificationModel = model('NotificationModel');
    }

    public function index()
    {
        $uid = $this->session->seller_info['user_id'];
        $notifications = $this->NotificationModel->get_user_screen_notification($uid);

        $data = [
            'session' => $this->session,
            'notifications' => $notifications,
        ];
        return view('seller/notifications/notification', $data);
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

    public function fetchNotifications()
    {
        $seller_info = $this->session->seller_info;
        // $notifications = $this->session->seller_info['notifications'];
        $notifications = $this->NotificationModel->get_user_screen_notification($seller_info["user_id"], 10);
        if ($notifications) {
            $new_notification_fetch_time = $notifications[0]->notification_fetch_time;
            // prd($notifications);
            if ($seller_info['notification_fetch_time'] < $new_notification_fetch_time) {
                $seller_info['notification_fetch_time'] = $new_notification_fetch_time;
                $seller_info['notifications'] = $notifications;
                $this->NotificationModel->updateRow(['notification_fetch_time' => $new_notification_fetch_time], $seller_info['user_id']);
                $this->session->set('seller_info', $seller_info);
            }
        }
        // $notifications = $this->session->seller_info;
        // prd($notifications);
    }
}