<?php
namespace App\Controllers\admin;

use App\Controllers\Admin\AdminController;

class Sellers extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        check_access('sellers');
        $this->UserModel = model('UserModel');
        $this->ProfileModel = model('ProfileModel');
        $this->UserRolesModel = model('UserRolesModel');
        $this->StoreModel = model('StoreModel');
        $this->statemodel = model('StateModel');
        $this->citymodel = model('CityModel');
        $this->NotificationModel = model('NotificationModel');
    }

    public function index()
    {

        $states = $this->statemodel->getAll();
        // $pending_stores = ;
        $data = [
            'session' => $this->session,
            'states' => $states,
            'pending_stores' => model("StoreModel")->count_pending_stores(),
        ];
        return view('admin/users/sellers', $data);
    }

    public function sellers_list()
    {
        check_method_access('sellers', 'view');
        $limit = $this->request->getGet("length");
        $offset = $this->request->getGet("start");
        $filter['search'] = $this->request->getGet("search[value]");
        $filter['is_seller'] = 1;
        $totalRecords = $this->UserModel->getCount($filter);
        $details = $this->StoreModel->getAllSellers();
        // prd($details);
        $arr = [];
        // $i = 0;
        foreach ($details as $k => $v) {
            $label = '';
            $seller_info = '<a style="cursor:pointer;" href="' . base_url("admin/sellers/seller_detail/" . $v->id) . '" store_id="' . $v->sid . '">' . $v->full_name . '</a><br><small>' . $v->phone . '</small>, <small>' . $v->email . '</small>';
            switch ($v->status) {
                case 0:
                    $label = "<small><label class='badge badge-warning'>Pending</label></smll>";
                    break;
                case 1:
                    $label = "<small><label class='badge badge-success'>Verified</label></small>";
                    break;
                case 2:
                    $label = "<small><label class='badge badge-danger'>Rejected</label></small>";
                    break;
            }
            $store_name = '<a title="Store" style="cursor:pointer;" href="' . base_url("admin/sellers/seller_detail/" . $v->id) . '"class="" store_id="' . $v->sid . '">' . $v->name . '</a> ' . $label . '<br><small>' . $v->store_address . '</small>';
            $action = '';
            // if (check_method_access('sellers', 'view', true)) {
            //     $action .= '<a title="View" style="font-size: 1.2rem;" class="text-primary sup_view me-1" href="#" uid="' . $v->sid . '"><i class="fa fa-eye"></i> </a>';
            // }
            if (check_method_access('sellers', 'edit', true)) {
                $action .= '<a title="Edit" style="font-size: 1.2rem;" class="text-warning sup_update me-1" href="#" uid="' . $v->sid . '" > <i class="fa fa-pencil-square-o"></i></a>';
            }
            if (check_method_access('sellers', 'delete', true)) {
                $action .= '<a title="Delete" style="font-size: 1.2rem;" class="text-danger sup_delete me-1"  uid="' . $v->sid . '" href="#" title="Delete"> <i class="fa fa-trash-o"></i></a>';
            }
            $arr[] = [
                $seller_info,
                $store_name,
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
        check_method_access('sellers', 'add');
        $check = $this->validate([
            'full_name' => "required|min_length[4]",
            'email' => "required|is_unique[users.email]",
            'phone' => "required|min_length[10]|max_length[10]|is_unique[users.phone]",
            'password' => "required|min_length[4]",
            'pincode' => "required",
            'address' => "required",
            'gst' => "required",
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
                'gstin' => $post_data['gst'],
            ];
            $seller_id = $this->StoreModel->CreateStore($data1);
            $data2 = [
                "user_id" => $user_id,
                "full_name" => format_name($this->request->getPost('full_name')),
                "email" => $this->request->getPost('email'),
                "phone" => $this->request->getPost('phone'),
                'address' => $post_data['address'],
                'city_id' => $post_data['city_id'],
                'state_id' => $post_data['state_id'],
                'pincode' => $post_data['pincode'],
                'profile_photo' => $this->_upload_logo(),

            ];
            prd($data2);
            $this->ProfileModel->insertData($data2);
            $data3 = [
                'user_id' => $user_id,
                'role_id' => SELLER_ROLE_ID,
            ];
            $role_id = $this->UserRolesModel->insertData($data3);

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

    public function getSeller()
    {
        $uid = $this->request->getGet('id');
        $data['seller'] = $this->StoreModel->getSeller($uid);
        $states_id = $data['seller']->state_id;
        $data['city'] = $this->citymodel->get_citys_state_by_id($states_id);

        if ($data) {
            json_response(1, "Succesfully fetched", $data);
        } else {
            json_response(0, "Something went wrong");
        }
    }
    public function getViewSeller()
    {
        $uid = $this->request->getGet('id');
        $data = $this->StoreModel->getviewSeller($uid);
        if ($data) {
            json_response(1, "Succesfully fetched", $data);
        } else {
            json_response(0, "Something went wrong");
        }
    }

    public function edit()
    {
        check_method_access('sellers', 'edit');
        $check = $this->validate([
            'full_name' => "required|min_length[4]",
            'email' => "required|is_unique[users.email,id,{user_id}]",
            'phone' => "required|min_length[10]|max_length[10]|is_unique[users.phone,id,{user_id}]",
            'user_id' => "required",
            'pincode' => "required",
            'address' => "required",
            'gst' => "exact_length[15]|is_natural",
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
            $seller_id = $post_data['seller_id'];
            $user_pro_id = $post_data['users_profile_id'];
            $data = [
                "full_name" => format_name($this->request->getPost('full_name')),
                "phone" => $this->request->getPost('phone'),
                "email" => $this->request->getPost('email'),
            ];
            $res = $this->UserModel->updateRow($data, "id=$user_id");
            $data1 = [
                'gstin' => $post_data['gst'],
            ];
            $seller = $this->StoreModel->updateRow($data1, $seller_id);
            $data2 = [
                "full_name" => format_name($this->request->getPost('full_name')),
                "email" => $this->request->getPost('email'),
                "phone" => $this->request->getPost('phone'),
                'address' => format_name($post_data['address']),
                'city_id' => $post_data['city_id'],
                'state_id' => $post_data['state_id'],
                'pincode' => $post_data['pincode'],
            ];
            if (!empty($_FILES['logo']['name'])) {
                $data2 = array_merge($data2, ['profile_photo' => $this->_upload_logo()]);
            }
            $res = $this->ProfileModel->updateRow($data2, $user_pro_id);

            if ($res) {
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
        check_method_access('sellers', 'delete');
        $uid = $this->request->getPost('id');
        $res = $this->StoreModel->deleteUser($uid);
        if ($res) {
            json_response(1, "Succesfully Deleted");
        } else {
            json_response(0, "Something went wrong");
        }
    }
    private function _upload_logo()
    {
        $logo = $this->request->getFile('logo');
        $file_path = '';
        if ($logo->isValid()) {
            $upload_path = 'public/uploads/product_images/';
            $logo_name = $logo->getRandomName();
            $res = $logo->move($upload_path, $logo_name);
            if ($res) {
                $file_path = base_url($upload_path . $logo_name);
            }
        }
        return $file_path;

    }

    public function get_store_detail_by_store_id($id)
    {
        $details = $this->StoreModel->getStoreDetailById($id);
        // prd($details);
        echo json_encode([
            "status" => 1,
            "detail" => $details,
        ]);
    }
    public function change_store_status($id)
    {
        $data = [
            "status" => $this->request->getGet('data'),
        ];
        $result = $this->StoreModel->updateRow($data, $id);
        $seller_id = $this->StoreModel->get_seller_id($id);
        switch ($data['status']) {
            case 1:
                $text = "Your store was now successfully permitted by admin now you can add your products or manage your orders";
                break;
            case 2:
                $text = "Your store was rejected by admin";
                break;
        }
        if ($data['status']) {
            $data = [
                "user_id" => $seller_id->user_id,
                "type" => 1,
                "text" => $text,
                "date" => date('Y-m-d H:i:s'),
                "fa_icon" => "star",
            ];
            $notification_id = $this->NotificationModel->add_user_notification($data);
        }
        if ($result) {
            echo json_encode([
                "status" => 1,
                "msg" => "Status was updated successfully",
            ]);}
    }
    public function seller_detail($id)
    {
        $data = [
            'session' => $this->session,
            'seller_info' => $this->StoreModel->getSeller($id),
            'store_info' => $this->StoreModel->getStoreDetailById($id),
        ];
        // prd($data);
        return view("/admin/seller_details", $data);
    }
}