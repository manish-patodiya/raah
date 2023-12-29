<?php

namespace App\Controllers;

use App\Libraries\SendEmail;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        $this->UserModel = model('UserModel');
        $this->ProfileModel = model('ProfileModel');
        $this->UserRolesModel = model('UserRolesModel');
        $this->GeneralSetting = model('GeneralSetting');
        $this->OTPModel = model('OTPConfigurationModel');
    }

    public function forget_password()
    {
        if ($this->request->isAJAX()) {
            $check = $this->validate([
                'text' => "required|min_length[10]",
            ], [
                'text' => [
                    'min_length' => "Wrong Input",
                ],
            ]);
            if ($check) {
                $text = $this->request->getPost('text');
                $user = $this->UserModel->getUserByIdentifier("phone='$text' OR email='$text'");
                if ($user) {
                    $this->_sendForgetPwdEmail($user);
                    echo json_encode([
                        "status" => 1,
                        "msg" => "We have send an email to your registered email id. Please check your email.",
                    ]);
                } else {
                    echo json_encode([
                        "status" => 0,
                        "msg" => "Does not exist",
                    ]);
                }

            } else {
                echo json_encode([
                    'status' => 0,
                    'msg' => "Form is not validate",
                    'errors' => $this->validation->getErrors(),
                ]);
            }
        } else {
            error404();
        }
    }

    private function _sendForgetPwdEmail($user)
    {
        if (!$user->email) {
            return false;
        }
        //Get template information
        $link = base_url("auth/reset_password?token=" . $user->id);
        $template = model('TemplateModel')->getTemplateById(1);
        $body = str_replace("{base_url}", base_url(), $template->content);
        $body = str_replace("{reset_pwd_link}", $link, $template->content);
        $email_obj = new SendEmail();
        $res = $email_obj->send($user->email, 'Forgot Password', $body);
        return 1;
    }

    public function reset_password()
    {
        $token = $this->request->getGet('tk');
        $role = $this->request->getGet('r');
        try {
            decrypt_var($token);
            decrypt_var($role);
        } catch (\Exception $e) {
            // echo 'Message: ' . $e->getMessage();
            url_expired();
        }
        $res = $this->UserModel->get(decrypt_var($token));
        if ($res && !$res->password) {
            $data = [
                "token" => $token,
                "role" => $role,
            ];
            return view('auth/reset_password', $data);
        } else {
            url_expired();
        }
    }

    public function set_pass()
    {
        if ($this->request->isAJAX()) {
            $check = $this->validate([
                'password' => 'required|min_length[4]',
                'cpassword' => 'required|min_length[4]|matches[password]',
            ], [
                'cpassword' => [
                    'matches' => 'Password Does Not Match',
                ],
            ]);
            if ($check) {
                $post_data = $this->request->getPost();
                $uid = decrypt_var($post_data['token']);
                $new_pass = encrypt_password($this->request->getPost('password'));
                $data = [
                    'password' => $new_pass,
                ];
                if ($post_data['role']) {
                    $this->_sendVerificationEmail($uid);
                }
                $this->UserModel->updateRow($data, "id='$uid'");
                echo json_encode([
                    "status" => 1,
                    "msg" => "Successful",
                    "role" => $post_data['role'] ? decrypt_var($post_data['role']) : '',
                ]);
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

    public function triggerVeificationEmail()
    {
        if ($this->request->isAJAX()) {
            $user_id = $this->request->getGet('utk');
            try {
                $uid = decrypt_var($user_id);
            } catch (\Exception $e) {
                // echo $e->getMessage();
                json_response(0, 'Email has not trigger');
                die;
            }
            $res = $this->_sendVerificationEmail($uid);
            if ($res) {
                json_response(1, 'Email sent');
            } else {
                json_response(0, 'Email has not trigger');
            }
        } else {
            error404();
        }
    }

    public function changeEmail()
    {
        $check = $this->validate([
            'email' => "required|isUniqueWithWhere[users.email,is_email_verify = 1]",
        ], [
            'email' => [
                'isUniqueWithWhere' => 'Email is already exist',
            ],
        ]);
        if ($check) {
            // make post data variable
            $post_data = $this->request->getPost();
            $user_id = $post_data['user_id'];

            // decrypt user_id
            try {
                $uid = decrypt_var($user_id);
            } catch (\Exception $e) {
                // echo $e->getMessage();
                json_response(0, 'Something went wrong');
                die;
            }

            // update email in db
            $data = [
                "email" => $post_data['email'],
            ];
            $this->UserModel->updateUser($data, $uid);

            $data1 = [
                "email" => $post_data['email'],
            ];
            $this->ProfileModel->updateRow($data, $uid);

            // send verification email
            $res = $this->_sendVerificationEmail($uid);
            if ($res) {
                json_response(1, 'Email sent');
            } else {
                json_response(0, 'Email has not trigger');
            }
        } else {
            echo json_encode([
                'status' => 0,
                'msg' => 'Form is not validate',
                'errors' => $this->validation->getErrors(),
            ]);
        }
    }

    private function _sendVerificationEmail($uid)
    {
        $user_data = $this->UserModel->get($uid);
        if ($user_data->email && !$user_data->is_email_verify) {
            $token = generate_uniqcode();
            $data = [
                'verification_token' => $token,
                'email_verification_time' => time(),
            ];
            $this->UserModel->updateRow($data, "id='$uid'");

            //Get template information
            $template = model('TemplateModel')->getTemplateById(2);
            $general_setting = $this->GeneralSetting->getAll();

            // templateing data
            $verification_url = base_url("auth/verify_email?etk=" . $token);
            $unsubscribe_url = base_url("notifcations");
            $user_name = $user_data->full_name;
            $site_name = $general_setting->application_name;

            // replace variables in templates
            $body = str_replace(['{verification_url}', '{unsubscribe_url}', '{site_name}', '{user_name}'],
                [$verification_url, $unsubscribe_url, $site_name, $user_name],
                $template->content);
            $email_obj = new SendEmail();
            $res = $email_obj->send($user_data->email, 'Verify your email', $body);
            return 1;
        } else {
            die('Your email is already verified');
        }
    }

    public function verify_email()
    {
        $token = $this->request->getGet('etk');
        $user_data = $this->UserModel->getUserByToken($token);
        if ($user_data) {
            $time_diff = time() - $user_data->email_verification_time;
            if (!$user_data->is_email_verify && $user_data->email && $time_diff < URL_EXPIRATION_TIME) {
                $data = [
                    'is_email_verify' => 1,
                    'verification_token' => null,
                    'email_verification_time' => null,
                ];
                $this->UserModel->updateRow($data, "id='$user_data->id'");
                $data = [
                    'user_data' => $user_data,
                ];
                return view('auth/email_verify_success', $data);
            } else {
                url_expired();
            }
        } else {
            header("Location:" . base_url());
            exit;
        }

    }

    public function change_password()
    {
        $token = $this->request->getGet('token');
        $role = $this->request->getGet('role');
        try {
            decrypt_var($token);
            decrypt_var($role);
        } catch (\Exception $e) {
            // echo 'Message: ' . $e->getMessage();
            url_expired();
        }
        $res = $this->UserModel->get(decrypt_var($token));
        if ($res && $res->password) {
            $data = [
                "token" => $token,
                "role" => $role,
            ];
            return view('auth/change_password', $data);
        } else {
            url_expired();
        }
    }

    public function change_pass()
    {
        if ($this->request->isAJAX()) {
            $check = $this->validate([
                'password' => 'required|min_length[4]',
                'cpassword' => 'required|min_length[4]|matches[password]',
            ], [
                'cpassword' => [
                    'matches' => 'Password Does Not Match',
                ],
            ]);
            if ($check) {
                $post_data = $this->request->getPost();
                $uid = decrypt_var($post_data['token']);
                $new_pass = encrypt_password($this->request->getPost('password'));
                $data = [
                    'password' => $new_pass,
                ];
                $this->UserModel->updateRow($data, "id='$uid'");
                echo json_encode([
                    "status" => 1,
                    "msg" => "Successful",
                    "role" => decrypt_var($post_data['role']),
                ]);
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

    public function request_otp()
    {
        $post_data = $this->request->getPost();
        $this->validation->reset();
        if ($this->validation->run($post_data, 'request_otp')) {
            $insert_id = $this->OTPModel->set_user_otp($post_data);
            $config = $this->OTPModel->get_otp_configuartion();
            json_response(1, "We have sent an OTP in a SMS to your mobile number", ['row_no' => encrypt_var($insert_id), 'otp_resend_time' => $config->time_limit]);
        } else {
            echo json_encode([
                'status' => 0,
                'msg' => 'Form is not validate',
                'errors' => $this->validation->getErrors(),
            ]);
        }
    }

    public function verify_otp()
    {
        $check = $this->validate([
            'row_id' => 'required',
            'otp' => 'required|exact_length[6]|is_natural',
            'phone' => 'required|exact_length[10]|is_natural',
        ]);
        if ($check) {
            $post_data = $this->request->getPost();
            $result = $this->OTPModel->verifyOTP($post_data);
            switch ($result) {
                case 0:
                    json_response(0, 'Please enter the correct OTP sent to your mobile number.');
                    break;
                case 1:
                    json_response(1, 'Successfully Verified.');
                    break;
                case 2:
                    json_response(0, 'OTP has been expired. Please click on reset OTP.');
                    break;
            }
        } else {
            json_response(0, 'Please enter the correct OTP sent to your mobile number.');
            // echo json_encode(["status" => 0, "msg" => 'Form not validate', "errors" => $this->validation->getErrors()]);
        }
    }

}