<?php
namespace App\Controllers\admin;

use App\Controllers\Admin\AdminController;

class Customers extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        check_access('members');
        $this->UserModel = model('UserModel');
        $this->statemodel = model('StateModel');
        $this->Profilemodel = model('ProfileModel');
        $this->UserRolesModel = model('UserRolesModel');
        $this->citymodel = model('CityModel');
    }

    public function index()
    {
        $states = $this->statemodel->getAll();
        $cities = $this->citymodel->getAll();
        $data = [
            'session' => $this->session,
            'states' => $states,
            'city' => $cities,
        ];
        return view('admin/users/members', $data);
    }

    public function members_list()
    {
        check_method_access('members', 'view');
        $limit = $this->request->getGet("length");
        $offset = $this->request->getGet("start");
        $filter['search'] = $this->request->getGet("search[value]");
        $filter['is_member'] = 1;
        $totalRecords = $this->UserModel->getCount($filter);
        $details = $this->UserModel->getAllMembers($limit, $offset, $filter);
        $arr = [];
        $i = $offset;
        // prd($details);
        foreach ($details as $k => $v) {
            $label = '';
            // switch ($v->status) {
            //     case 1:
            //         $label .= "<label class='badge badge-success'>Verified</label>";
            //         break;
            //     case 2:
            //         $label .= "<label class='badge badge-primary'>Suspended</label>";
            //         break;
            //     case 3:
            //         $label .= "<label class='badge badge-danger'>Not Verified</label>";
            //         break;
            // }
            $action = '';
            if (check_method_access('sellers', 'view', true)) {
                $action .= '<a title="View" style="font-size: 1.2rem;" class="text-primary sup_view me-1" href="#" uid="' . $v->user_id . '"><i class="fa fa-eye"></i> </a>';
            }
            if (check_method_access('member', 'edit', true)) {
                $action .= '<a title="Edit" style="font-size: 1.2rem;" class="text-warning sup_update me-1" href="#" uid="' . $v->user_id . '" > <i class="fa fa-pencil-square-o"></i></a>';
            }
            if (check_method_access('member', 'delete', true)) {
                $action .= '<a title="Delete" style="font-size: 1.2rem;" class="text-danger sup_delete me-1"  uid="' . $v->user_id . '" href="#" title="Delete" data-bs-toggle="modal" data-bs-target="#modal-center" > <i class="fa fa-trash-o"></i></a>';
            }
            $address = $v->address . ',' . $v->city_name . ', ' . $v->state_name . ', ' . $v->pincode;
            $arr[] = [
                ++$i,
                $v->full_name,
                $v->phone,
                $v->email . '<br>' . "<span> $address</span>",
                $action,
            ];
        }
        echo json_encode([
            "status" => 1,
            "iTotalDisplayRecords" => $totalRecords,
            "recordsTotal" => 0,
            "details" => $arr,
        ]);
    }

    public function add()
    {
        check_method_access('members', 'add');
        $check = $this->validate([
            'full_name' => "required|min_length[4]",
            'email' => "required|is_unique[users.email]",
            'phone' => "required|min_length[10]|max_length[10]|is_unique[users.phone]",
            'password' => "required|min_length[4]",
            'pincode' => "required",
            'address' => "required",
            'state_id' => "required",
            'city_id' => "required",
            'cpassword' => 'required|matches[password]',
        ], [
            'phone' => [
                "min_length" => "Not a valid phone no.",
            ],
            'email' => [
                'is_unique' => 'Email is already exist',
            ],
            'phone' => [
                'is_unique' => 'Phone no. is already exist',
            ],
        ]);
        if ($check) {
            $post_data = $this->request->getPost();
            $data = [
                "full_name" => format_name($this->request->getPost('full_name')),
                "phone" => $this->request->getPost('phone'),
                "email" => $this->request->getPost('email'),
                "password" => encrypt_password($this->request->getPost('password')),
                "status" => 1,
            ];
            $user_id = $this->UserModel->insertData($data);
            $data1 = [
                "user_id" => $user_id,
                "full_name" => format_name($this->request->getPost('full_name')),
                "email" => $this->request->getPost('email'),
                "phone" => $this->request->getPost('phone'),
                "pincode" => $this->request->getPost('pincode'),
                "address" => $this->request->getPost('address'),
                "state_id" => $this->request->getPost('state_id'),
                "city_id" => $this->request->getPost('city_id'),
            ];
            $user_profile_id = model('ProfileModel')->insertData($data1);
            $data2 = [
                'user_id' => $user_id,
                'role_id' => CUSTOMER_ROLE_ID,
            ];
            $role_id = $this->UserRolesModel->insertData($data2);

            if ($role_id) {
                echo json_encode([
                    "status" => 1,
                    "msg" => "succesfully insertion",
                    "user_id" => $user_id,
                    "phone" => $this->request->getPost('phone'),
                ]);
            } else {
                echo json_encode([
                    "status" => 0,
                    "msg" => "Something went wrong!",
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

    public function getCustomer()
    {
        $uid = $this->request->getGet('id');
        $data['customer'] = model('ProfileModel')->getCustomer($uid);
        $states_id = $data['customer']->state_id;
        $data['city'] = $this->citymodel->get_citys_state_by_id($states_id);
        if ($data) {
            json_response(1, "Succesfully fetched", $data);
        } else {
            json_response(0, "Something went wrong");
        }
    }
    public function getViewcustomer()
    {
        $uid = $this->request->getGet('id');
        $data = model('ProfileModel')->getViewcustomer($uid);
        if ($data) {
            json_response(1, "Succesfully fetched", $data);
        } else {
            json_response(0, "Something went wrong");
        }
    }
    public function edit()
    {
        check_method_access('members', 'edit');
        $check = $this->validate([
            'full_name' => "required|min_length[4]",
            'email' => "required|is_unique[users.email,id,{user_id}]",
            'phone' => "required|min_length[10]|max_length[10]|is_unique[users.phone,id,{user_id}]",
            'user_id' => "required",
            'pincode' => "required",
            'address' => "required",
            'city_id' => "required",
            'state_id' => "required",
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
            $post_data = $this->request->getPost();
            $user_id = $post_data['user_id'];
            $user_pro_id = $post_data['users_profile_id'];
            $data = [
                "full_name" => format_name($this->request->getPost('full_name')),
                "phone" => $this->request->getPost('phone'),
                "email" => $this->request->getPost('email'),
                "password" => encrypt_password($this->request->getPost('password')),
                "status" => 1,
            ];
            $res = $this->UserModel->updateRow($data, "id=$user_id");
            $data1 = [
                "user_id" => $user_id,
                "full_name" => format_name($this->request->getPost('full_name')),
                "email" => $this->request->getPost('email'),
                "phone" => $this->request->getPost('phone'),
                "pincode" => $this->request->getPost('pincode'),
                "address" => $this->request->getPost('address'),
                "state_id" => $this->request->getPost('state_id'),
                "city_id" => $this->request->getPost('city_id'),
            ];
            $user_profile_id = model('ProfileModel')->updateRow($data1, $user_id);

            if ($user_profile_id) {
                echo json_encode([
                    "status" => 1,
                    "msg" => "succesfully insertion",
                    "user_id" => $user_id,
                    "phone" => $this->request->getPost('phone'),
                ]);
            } else {
                echo json_encode([
                    "status" => 0,
                    "msg" => "Something went wrong!",
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

    public function delete()
    {
        check_method_access('members', 'delete');
        $uid = $this->request->getPost('id');
        $res = model('ProfileModel')->deleteUser($uid);
        $res = $this->UserModel->deleteUser($uid);
        if ($res) {
            json_response(1, "Succesfully Deleted");
        } else {
            json_response(0, "Something went wrong");
        }
    }

}