<?php
namespace App\Controllers\Seller\Shipping;

use App\Controllers\Seller\SellerController;

class ShippingRates extends SellerController
{
    public function __construct()
    {
        parent::__construct();
        // check_access('shippingrates');
        $this->shippingrates = model('shipping/ShippingRates');
    }

    public function index()
    {
        $data = [
            'session' => $this->session,
        ];
        return view('seller/shipping/shipping_rates', $data);
    }
    public function shippingrates_list()
    {
        // check_method_access('shippingrates', 'view');
        $order_setting = $this->shippingrates->getAllshippingrates();
        // prd($order_setting);
        $arr = [];
        $i = 0;
        foreach ($order_setting as $k => $v) {

            $action = '<a title="Edit" class="text-warning sup_update me-1" href="#" uid="' . $v->id . '" style="font-size: 1.2rem;"> <i class="fa fa-pencil-square-o"></i></a><a title="Delete" class="text-danger sup_delete me-1"  uid="' . $v->id . '" href="#" title="Delete" style="font-size: 1.2rem;" > <i class="fa fa-trash-o"></i></a>';

            $shippingrates = '<div style=" display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
            overflow: hidden;">' . $v->shippingrates . '</div>';
            $arr[] = [
                ++$i,
                $shippingrates,
                $action,
            ];
        }
        echo json_encode([
            "status" => 1,
            "details" => $arr,
        ]);
    }

    public function add()
    {
        // check_method_access('shippingrates', 'view');
        $check = $this->validate([
            'shipping_rates' => 'required',
        ]);
        if ($check) {
            $post_data = $this->request->getPost();
            $data = [
                'shippingrates' => format_name($post_data['shipping_rates']),
            ];
            $order_setting = $this->shippingrates->insertData($data);
            if ($order_setting) {
                echo json_encode([
                    "status" => 1,
                    "msg" => "succesfully insertion",
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

    public function getOrderSettings()
    {
        $uid = $this->request->getGet('id');
        $data = $this->shippingrates->getOrderSetting($uid);
        if ($data) {
            json_response(1, "Succesfully fetched", $data);
        } else {
            json_response(0, "Something went wrong");
        }
    }

    public function edit()
    {
        // check_method_access('carriers', 'edit');
        $check = $this->validate([
            'shippingrates' => 'required',
        ]);
        if ($check) {
            $post_data = $this->request->getPost();
            $id = $post_data['shipping-rates-id'];
            $data = [
                'shippingrates' => format_name($post_data['shippingrates']),
            ];
            $shippingrates = $this->shippingrates->updateRow($data, "id=$id");
            if ($shippingrates) {
                echo json_encode([
                    "status" => 1,
                    "msg" => "Updated succesfully",
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
        // check_method_access('carriers', 'delete');
        $uid = $this->request->getPost('id');
        $res = $this->shippingrates->deleteRow($uid);
        if ($res) {
            json_response(1, "Succesfully Deleted");
        } else {
            json_response(0, "Something went wrong");
        }
    }
}