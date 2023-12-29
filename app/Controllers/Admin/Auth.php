<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        $uri = service('uri');
        if ($this->session->get('is_login') && $this->session->get('is_admin') && !($uri->getTotalSegments() > 2 && ($uri->getSegment(3) == 'logout' || $uri->getSegment(3) == 'loginAs'))) {
            header("Location:" . base_url("admin/dashboard"));
            exit;
        }

        $this->UserModel = model('UserModel');
        $this->ProfileModel = model('ProfileModel');
        $this->UserRolesModel = model('UserRolesModel');
        $this->GeneralSetting = model('GeneralSetting');
    }

    public function index()
    {
        return $this->login();
    }

    public function login()
    {
        return view('admin/auth/login');
    }

    public function checklogin()
    {
        if ($this->request->isAJAX()) {
            $check = $this->validate([
                'phone' => "required|min_length[10]|max_length[10]",
                'password' => "required",
            ], [
                'phone' => [
                    "min_length" => "Not a valid phone no.",
                ],
            ]);

            if ($check) {
                $phone = $this->request->getPost('phone');
                $password = $this->request->getPost('password');
                $role_id = ADMIN_ROLE_ID;
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
                        'message' => "Invalid credentials",
                    ]);
                    die;
                }
                $roles = $this->UserRolesModel->getUserRoles($user->id, $role_id);
                sort($roles);
                if (count($roles) > 1) {
                    $this->setSession($roles, $user->id);
                    echo json_encode([
                        'status' => 1,
                        'id' => $user->id,
                        'roles' => $roles,
                        'message' => 'Have various roles',
                    ]);
                } else {
                    $this->setSession($roles, $user->id, $roles[0]->role_id);
                    echo json_encode([
                        'status' => 1,
                        'message' => 'Login success',
                    ]);
                }

            } else {
                echo json_encode([
                    'status' => 0,
                    'message' => "Form is not validate",
                    'errors' => $this->validation->getErrors(),
                ]);
            }
        } else {
            error404();
        }
    }

    public function setSession($roles, $id, $active_role = null)
    {
        $profile = $this->ProfileModel->getUser($id);
        $admin_info = [
            "user_id" => $id,
            "email" => $profile->email,
            "name" => format_name($profile->full_name),
            "profile_photo" => $profile->profile_photo && file_exists("public/uploads/users_profile/" . $profile->profile_photo) ? base_url("public/uploads/users_profile/" . $profile->profile_photo) : base_url("public/images/avatar/avatar-1.png"),
            "user_roles" => $roles,
            "active_role_id" => $active_role,
            "general_setting" => $this->GeneralSetting->getAll(),
        ];
        $this->session->set("admin_info", $admin_info);
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
        $this->session->set("is_admin", 1);
        if ($active_role) {
            set_permissions_in_session();
        }
    }

    public function loginAs($activeID = null)
    {
        if (!$this->session->is_login) {
            header("Location:" . base_url("auth"));
            exit;
        }
        if ($activeID) {
            $admin_info = $this->session->admin_info;
            $admin_info['active_role_id'] = $activeID;
            $this->session->set('admin_info', $admin_info);
            set_permissions_in_session();
            header("Location:" . base_url('admin/dashboard'));
            exit;
        } else {
            return view('admin/auth/login_as', ['session' => $this->session->get('admin_info')]);
        }
    }

    public function logout()
    {
        $url = 'admin';
        $this->session->remove('admin_info');
        $this->session->remove('is_admin');
        header("Location:" . base_url($url));
        exit;
    }
}