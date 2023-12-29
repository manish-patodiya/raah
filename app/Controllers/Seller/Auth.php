<?php

namespace App\Controllers\Seller;

use App\Controllers\BaseController;
use App\Libraries\SendEmail;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        $uri = service('uri');
        if ($this->session->get('is_login') && $this->session->get('is_seller') && !($uri->getTotalSegments() > 2 && ($uri->getSegment(3) == 'logout'))) {
            header("Location:" . base_url("seller/dashboard"));
            exit;
        }

        $this->UserModel = model('UserModel');
        $this->ProfileModel = model('ProfileModel');
        $this->UserRolesModel = model('UserRolesModel');
        $this->GeneralSetting = model('GeneralSetting');
        $this->OTPModel = model('OTPConfigurationModel');
        $this->StoreModel = model('StoreModel');
        $this->NotificationModel = model('NotificationModel');
    }

    public function index()
    {
        return $this->login();
    }

    public function signUp()
    {
        $data['login_url'] = base_url("seller/auth/login");
        return view('seller/auth/register', $data);
    }

    public function register()
    {
        $post_data = $this->request->getPost();
        $otp_row_id = decrypt_var($post_data['row_id']);
        $post_data['row_id'] = $otp_row_id;
        $post_data['email_regex'] = EMAIL_REGEX;
        $post_data['password_regex'] = PASSWORD_REGEX;

        $this->validation->reset();

        if ($this->validation->run($post_data, 'seller_registration')) {
            $user_id = $this->UserModel->insertData($post_data);
            $post_data['user_id'] = $user_id;
            $this->ProfileModel->insertData($post_data);

            $this->UserRolesModel->insertSellerRole($user_id);

            $this->_sendVerificationEmail($user_id);

            echo json_encode([
                "status" => 1,
                "msg" => "Account is created successfully!",
            ]);
        } else {
            echo json_encode([
                'status' => 0,
                "msg" => "Form is not validate",
                "errors" => $this->validation->getErrors(),
            ]);
        }
    }

    private function _sendVerificationEmail($uid)
    {
        $user_data = $this->UserModel->get($uid);
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
    }

    public function login()
    {
        $data['sign_up_url'] = base_url("seller/auth/signup");
        $data['fgt_url'] = base_url("seller/auth/forgot_password");
        return view('seller/auth/login', $data);
    }

    public function checklogin()
    {
        $post_data = $this->request->getPost();
        $this->validation->reset();
        if ($this->validation->run($post_data, 'seller_login')) {
            $phone = $post_data['phone'];
            $password = $post_data['password'];
            $role_id = SELLER_ROLE_ID;

            $user = $this->UserModel->login($phone, $role_id);
            if ($user) {
                if (decrypt_password($user->password) != $password) {
                    echo json_encode([
                        'status' => 0,
                        'message' => "Wrong password",
                    ]);
                    die;
                }
            } else {
                echo json_encode([
                    'status' => 0,
                    'message' => "Invalid Credentials",
                ]);
                die;
            }

            $this->setSession($user->user_id, $role_id);
            echo json_encode([
                'status' => 1,
                'message' => 'Login success',
            ]);

        } else {
            echo json_encode([
                'status' => 0,
                'message' => "Form is not validate",
                'errors' => $this->validation->getErrors(),
            ]);
        }
    }

    public function setSession($uid, $active_role)
    {
        $profile = $this->ProfileModel->getUser($uid);
        $store_count = model('StoreModel')->getSellerStoreCount($uid);
        $seller_info = [
            "user_id" => $uid,
            "seller_id" => $uid,
            "name" => format_name($profile->full_name),
            "profile_photo" => $profile->profile_photo && file_exists("public/uploads/users_profile/" . $profile->profile_photo) ? base_url("public/uploads/users_profile/" . $profile->profile_photo) : base_url("public/images/avatar/avatar-1.png"),
            "active_role_id" => $active_role,
            "general_setting" => $this->GeneralSetting->getAll(),
            "store_count" => $store_count,
            "notifications" => $this->NotificationModel->get_user_screen_notification($uid, 10),
            "notification_fetch_time" => date('Y-m-d H:i:s'),
        ];
        $this->session->set("seller_info", $seller_info);
        $this->NotificationModel->updateRow(["notification_fetch_time" => $this->session->seller_info['notification_fetch_time']], $uid);

        if (!$this->session->get('site_info')) {
            $general_setting = $this->GeneralSetting->getAll();
            if (!@getimagesize($general_setting->favicon)) {
                $general_setting->favicon = base_url('public/images/logo-letter.png');
            }
            if (!@getimagesize($general_setting->logo)) {
                $general_setting->logo = base_url('public/images/logo-letter.png');
            }
            $site_info = $general_setting;
            $this->session->set("site_info", $site_info);
        }

        $this->session->set("is_login", 1);
        $this->session->set("is_seller", 1);
    }

    //forgot password..............
    public function forgot_password()
    {
        $data['login_url'] = base_url("seller/auth/login");
        $data['sign_up_url'] = base_url("seller/auth/signup");
        return view('auth/forgot_password', $data);
    }

    public function logout()
    {
        $url = 'seller';
        $this->session->remove('seller_info');
        $this->session->remove('is_seller');
        header("Location:" . base_url($url));
        exit;
    }
}