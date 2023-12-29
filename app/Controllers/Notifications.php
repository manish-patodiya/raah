<?php
namespace App\Controllers;

class Notifications extends BaseController
{
    // public $notification_model;
    public function _construct()
    {
        // $this->notification_model = model('NotificationModel');
    }
    public function index()
    {
        $this->notification_model = model('NotificationModel');
        $data["user_email"] = $this->request->getGet('email');
        $data["reasons"] = $this->notification_model->getAllReasons();
        return view('frontend/notifications', $data);
    }
    public function unsubscribe_user()
    {
        $check = $this->validate([
            'email' => "required|is_unique[notification_dnd.user_email]",
            'reason' => "required|min_length[5]",
        ], [
            'email' => [
                'is_unique' => "This email is already unsubscribed",
            ],
            'reason' => [
                "min_length" => "Enter atleast 5 characters",
            ],
        ]);

        if ($check) {
            $this->notification_model = model('NotificationModel');
            $data = [
                "user_email" => $this->request->getPost("email"),
                "reason" => $this->request->getPost("other"),
            ];
            // prd($data);
            $result = $this->notification_model->unsubscribe_user($data);
            if ($result) {
                echo json_encode([
                    "status" => 1,
                    "msg" => "You are unsubscribed successfully",
                ]);
            }
        } else {
            echo json_encode([
                'status' => 0,
                'message' => "Form is not validate",
                'errors' => $this->validation->getErrors(),
            ]);
        }
    }
}