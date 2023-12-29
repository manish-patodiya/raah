<?php
namespace App\Controllers\admin;

use App\Controllers\Admin\AdminController;
use App\Libraries\Generateqr;

class Referrals extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        check_access('referrals');
        $this->ReferralModel = model('ReferralModel');
        $this->StateModel = model('StateModel');
        $this->CityModel = model('CityModel');
    }

    public function index()
    {
        check_method_access('referrals', 'view');
        $states = $this->StateModel->getAll();
        $list = $this->ReferralModel->get();
        $data = [
            'session' => $this->session,
            'states' => $states,
            'list' => $list,
        ];
        return view('admin/referral/referral_list', $data);
    }

    public function add()
    {
        check_method_access('referrals', 'add');
        $check = $this->validate([
            'name' => "required|min_length[4]",
            'email' => "required|is_unique[referral_list.email]",
            'contact' => "required|exact_length[10]|is_unique[referral_list.contact_no]",
            'pincode' => "required",
            'state' => "required",
            'city' => "required",
        ], [
            'contact' => [
                "exact_length" => "Not a valid contact no.",
                'is_unique' => 'Contact no. is already exist',
            ],
            'email' => [
                'is_unique' => 'Email is already exist',
            ],
        ]);
        if ($check) {
            $post_data = $this->request->getPost();
            $id = $this->ReferralModel->insertOrg($post_data);
            if ($id) {
                echo json_encode([
                    "status" => 1,
                    "msg" => "Successfully Inserted.",
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

    public function get()
    {
        $rfid = $this->request->getGet('id');
        $data['org_details'] = $this->ReferralModel->get($rfid);
        $states_id = $data['org_details']->state_id;
        $data['city'] = $this->CityModel->get_citys_state_by_id($states_id);
        if ($data) {
            json_response(1, "Succesfully fetched", $data);
        } else {
            json_response(0, "Something went wrong");
        }
    }

    public function generate_qr($rfid)
    {
        $categories = model('CategoryModel')->getAll();
        $data = [
            'session' => $this->session,
            'rfid' => $rfid,
            'categories_list' => $categories,
        ];
        return view('admin/referral/generate_qr', $data);
    }

    public function get_product()
    {
        $request_data = $this->request->getGet();
        $all_details = model('ProductModel')->getProducts($request_data);
        $products = [];
        foreach ($all_details as $v) {
            $img = @getimagesize($v->product_image) ? $v->product_image : base_url('public/images/product/product-1.png');
            $obj = new \stdClass;
            $obj->id = $v->id;
            $obj->img = $img;
            $obj->title = $v->title;
            $obj->details = $v->product_details . $v->product_details . $v->product_details . $v->product_details . $v->product_details;
            $obj->slug = $v->slug;
            $products[] = $obj;
        }
        // prd($products);
        json_response(1, "Successfull", ["products" => $products]);
    }

    public function product_qr()
    {
        $get_data = $this->request->getGet();
        $slug = $get_data['slug'];
        $rfid = $get_data['rfid'];
        $qr = new Generateqr;
        $product_details_url = base_url("products/detail/$slug?rfid=$rfid");
        $result = $qr->generate($product_details_url);
        if ($result != false) {
            $result = explode("\\", $result);
            $i = sizeof($result);
            $result = $result[$i - 1];
            $qr_url = base_url("public/uploads/qrcodes/$result");
            return view('admin/referral/qr_list', ['url' => $qr_url, 'per_page' => $get_data['per_page']]);
        }
    }

    public function edit()
    {
        check_method_access('referrals', 'edit');
        $check = $this->validate([
            'rfid' => 'required',
            'name' => "required|min_length[4]",
            'email' => "required|is_unique[referral_list.email,id,{rfid}]",
            'contact' => "required|exact_length[10]|is_unique[referral_list.contact_no,id,{rfid}]",
            'pincode' => "required",
            'state' => "required",
            'city' => "required",
        ], [
            'contact' => [
                "exact_length" => "Not a valid contact no.",
                'is_unique' => 'Contact no. is already exist',
            ],
            'email' => [
                'is_unique' => 'Email is already exist',
            ],
        ]);
        if ($check) {
            $post_data = $this->request->getPost();
            $res = $this->ReferralModel->updateOrg($post_data);

            if ($res) {
                echo json_encode([
                    "status" => 1,
                    "msg" => "Succesfully Updated",
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
        check_method_access('referrals', 'delete');
        $rfid = $this->request->getPost('id');
        $res = $this->ReferralModel->deleteOrg($rfid);
        if ($res) {
            json_response(1, "Succesfully Deleted");
        } else {
            json_response(0, "Something went wrong");
        }
    }

}