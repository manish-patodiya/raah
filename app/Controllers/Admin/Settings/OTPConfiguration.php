<?php
namespace App\Controllers\Admin\Settings;

use App\Controllers\Admin\AdminController;

class OTPConfiguration extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->OTPModel = model('OTPConfigurationModel');
    }

    public function index()
    {
        $data = [
            'session' => $this->session,
            'otp_config' => $this->OTPModel->get_otp_configuartion(),
        ];
        return view('admin/settings/otp_configuration', $data);
    }

    public function save_settings()
    {
        if ($this->request->isAJAX()) {
            $arr = [];
            $arr = array_merge($arr, [
                'otp_limit' => 'required|is_natural',
                'time_limit' => 'required',
            ]);
            $check = $this->validate($arr, [
                'otp_limit' => [
                    'required' => 'OTP Limit field is required',
                    'is_natural' => 'Per Page must be greater than or equal to 0',
                ],
                'email_limit' => [
                    'required' => 'Time Limit field is required',
                ],
            ]);

            if ($check) {
                $post_data = $this->request->getPost();
                $data = [
                    'otp_limit' => $post_data['otp_limit'],
                    'time_limit' => $post_data['time_limit'],
                ];
                $res = $this->OTPModel->set_otp_configuartion($data);
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