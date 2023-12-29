<?php
namespace App\Controllers\Seller\Shipping;

use App\Controllers\Seller\SellerController;

class PickupLocations extends SellerController
{
    public function __construct()
    {
        parent::__construct();
        // check_access('pickuplocations');
        $this->pickuplocations = model('shipping/PickupLocations');
    }

    public function index()
    {
        $data = [
            'session' => $this->session,
        ];
        return view('seller/shipping/pickup_locations', $data);
    }
    public function pickuplocations_list()
    {
        // check_method_access('pickuplocations', 'view');
        $order_setting = $this->pickuplocations->getAllpickuplocations();
        // prd($order_setting);
        $arr = [];
        $i = 0;
        foreach ($order_setting as $k => $v) {

            $action = '';
            if (check_method_access('pickuplocations', 'edit', true)) {
                $action .= '<a title="Edit" class="text-warning sup_update me-1" href="#" uid="' . $v->id . '" style="font-size: 1.2rem;"> <i class="fa fa-pencil-square-o"></i></a>';
            }
            if (check_method_access('pickuplocations', 'delete', true)) {
                $action .= '<a title="Delete" class="text-danger sup_delete me-1"  uid="' . $v->id . '" href="#" title="Delete" style="font-size: 1.2rem;" > <i class="fa fa-trash-o"></i></a>';
            }
            $pickuplocations = '<div style=" display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
            overflow: hidden;">' . $v->pickuplocations . '</div>';
            $arr[] = [
                ++$i,
                $pickuplocations,
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
        // check_method_access('pickuplocations', 'view');
        $check = $this->validate([
            'pickuplocations' => 'required',
        ]);
        if ($check) {
            $post_data = $this->request->getPost();
            $data = [
                'pickuplocations' => format_name($post_data['pickuplocations']),
            ];
            $order_setting = $this->pickuplocations->insertData($data);
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
        $data = $this->pickuplocations->getOrderSetting($uid);
        if ($data) {
            json_response(1, "Succesfully fetched", $data);
        } else {
            json_response(0, "Something went wrong");
        }
    }

    public function edit()
    {
        // check_method_access('pickuplocations', 'edit');
        $check = $this->validate([
            'pickuplocations' => 'required',
        ]);
        if ($check) {
            $post_data = $this->request->getPost();
            $id = $post_data['pl_id'];
            $data = [
                'pickuplocations' => format_name($post_data['pickuplocations']),
            ];
            $pickuplocations = $this->pickuplocations->updateRow($data, "id=$id");
            if ($pickuplocations) {
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
        // check_method_access('pickuplocations', 'delete');
        $uid = $this->request->getPost('id');
        $res = $this->pickuplocations->deleteRow($uid);
        if ($res) {
            json_response(1, "Succesfully Deleted");
        } else {
            json_response(0, "Something went wrong");
        }
    }
}