<?php

namespace App\Controllers\Seller;

use App\Controllers\Seller\SellerController;

class Profile extends SellerController
{
    public $usermodel;
    public function __construct()
    {

        check_seller_login();
        $this->usermodel = model('UserModel');
        $this->profilemodel = model('ProfileModel');
    }

    public function index()
    {
        $id = $this->session->seller_info['user_id'];
        $details = $this->profilemodel->getUser($id);
        $sid = $details->state_id;
        $states = model('StateModel')->getAll();
        $city = model('CityModel')->getAllState_id($sid);

        $user_id = $this->session->seller_info['user_id'];
        $user_detail = model('UserModel')->get($user_id);
        // prd($user_detail);
        $data = [
            'session' => $this->session,
            'info' => $details,
            'user_detail' => $user_detail,
            'states' => $states,
            'city' => $city,
        ];
        return view('seller/profile/profile', $data);
    }

    public function updateUserProfile()
    {

        $check = $this->validate([
            'full_name' => "required|min_length[4]",
            'update_email' => "required|is_unique[users.email,id,{user_id}]",
            'update_phone' => "required|min_length[10]|max_length[10]|is_unique[users.phone,id,{user_id}]",
            'update_address' => "required",
        ], [
            'phone' => [
                "min_length" => "Not a valid phone no.",
                'is_unique' => 'Phone no. is already exist',
            ],
            'email' => [
                'is_unique' => 'Email is already exist',
            ],
        ]);
        if ($check) {
            $id = $this->request->getPost('user_id');
            $data = array(
                'full_name' => format_name($this->request->getPost('full_name')),
                'email' => $this->request->getPost('update_email'),
                'phone' => $this->request->getPost('update_phone'),
            );
            $user_id = $this->usermodel->updateRow($data, "id=$id");
            $data1 = array(
                'full_name' => format_name($this->request->getPost('full_name')),
                'email' => $this->request->getPost('update_email'),
                'phone' => $this->request->getPost('update_phone'),
                'address' => $this->request->getPost('update_address'),
                'state_id' => $this->request->getPost('state'),
                'city_id' => $this->request->getPost('city'),
            );
            if (!empty($_FILES['logo']['name'])) {
                $logo_path = $this->_upload_logo();
                $data1 = array_merge($data1, ['profile_photo' => $logo_path]);
                $admin_info = $this->session->get('admin_info');
                $admin_info['profile_photo'] = $logo_path;
                $this->session->set('admin_info', $admin_info);
            }
            $user_id = $this->profilemodel->updateRow($data1, "$id");

            if ($user_id) {
                echo json_encode([
                    "status" => 1,
                    "msg" => "User Profile Updated Successfully  ",
                ]);
            }
        } else {
            echo json_encode([
                'status' => 0,
                "msg" => "Form is not validate",
                "errors" => $this->validation->getErrors(),
            ]);
        }
    }

    private function _upload_logo()
    {
        $logo = $this->request->getFile('logo');
        $file_path = '';
        if ($logo->isValid()) {
            $upload_path = 'public/uploads/user_img/';
            $logo_name = $logo->getRandomName();
            $res = $logo->move($upload_path, $logo_name);
            if ($res) {
                $file_path = base_url($upload_path . $logo_name);
            }
        }
        return $file_path;
    }

    public function changePass()
    {
        $check = $this->validate([
            'old_password' => 'required|min_length[4]',
            'new_password' => 'required|min_length[4]',
            'confirm_password' => 'required|min_length[4]|matches[new_password]',
        ], [
            'confirm_password' => [
                'matches' => 'Password Does Not Match',
            ],
        ]);
        if ($check) {
            $id = $this->session->admin_info['user_id'];
            $model = $this->usermodel;
            $password = encrypt_password($this->request->getPost('old_password'));
            $pass = decrypt_password($password);
            $exist = $model->get($id);
            if (decrypt_password($exist->password) == $pass) {
                $new_pass = encrypt_password($this->request->getPost('new_password'));
                $data = [
                    'password' => $new_pass,
                ];
                $model->updateRow($data, "id='$id'");
                echo json_encode([
                    "status" => 1,
                    "msg" => "Successful Update Password",
                ]);
            } else {
                echo json_encode([
                    "status" => 0,
                    "msg" => "Old Password is Rougn",
                ]);
            }
        } else {
            echo json_encode([
                'status' => 0,
                'msg' => 'Form is not validate',
                'errors' => $this->validation->getErrors(),
            ]);
        }
    }
}