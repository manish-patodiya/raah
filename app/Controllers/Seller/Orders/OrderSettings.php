<?php
namespace App\Controllers\Seller\Orders;

use App\Controllers\Seller\SellerController;

class OrderSettings extends SellerController
{
    public function __construct()
    {
        parent::__construct();
        // check_access('orderssetting');
        $this->OrderModel = model('OrderModel');
    }

    public function index()
    {
        $data = [
            'session' => $this->session,
        ];
        return view('seller/orders/order_settings', $data);
    }

    public function ordersetting_list()
    {
        // check_method_access('orderssetting', 'view');
        $order_setting = $this->OrderModel->getAll_order_setting();

        $arr = [];
        $i = 0;
        foreach ($order_setting as $k => $v) {
            $action .= '<a title="Edit" class="text-warning sup_update me-1" href="#" uid="' . $v->id . '" style="font-size: 1.2rem;"> <i class="fa fa-pencil-square-o"></i></a><a title="Delete" class="text-danger sup_delete me-1"  uid="' . $v->id . '" href="#" title="Delete" style="font-size: 1.2rem;" > <i class="fa fa-trash-o"></i></a>';
            $cancel_reason = '<div style=" display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
            overflow: hidden;">' . $v->cancel_reason . '</div>';
            $arr[] = [
                ++$i,
                $cancel_reason,
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
        // check_method_access('orderssetting', 'view');
        $check = $this->validate([
            'cancel_reason' => 'required',
        ]);
        if ($check) {
            $post_data = $this->request->getPost();
            $data = [
                'cancel_reason' => format_name($post_data['cancel_reason']),
            ];
            $order_setting = $this->OrderModel->insertData($data);
            if ($this->request->getPost('order_id')) {
                $data = [
                    "status" => 2,
                ];
                $data1 = [
                    "cancel_reason_id" => $order_setting,
                ];
                $oid = $this->request->getPost('order_id');
                $pid = $this->request->getPost('product_id');
                $this->OrderModel->updateOrder($data, $oid, $pid);
                $this->OrderModel->updateRow($data1, 'id=' . $oid);
            }
            if ($order_setting) {
                echo json_encode([
                    "status" => 1,
                    "msg" => "Cancel reason inserted successfully",
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
        $data = $this->OrderModel->getOrderSetting($uid);
        if ($data) {
            json_response(1, "Succesfully fetched", $data);
        } else {
            json_response(0, "Something went wrong");
        }
    }

    public function edit()
    {
        // check_method_access('orderssetting', 'edit');
        $check = $this->validate([
            'cancel_reason' => 'required',
        ]);
        if ($check) {
            $post_data = $this->request->getPost();
            $id = $post_data['order_setting'];
            $data = [
                'cancel_reason' => format_name($post_data['cancel_reason']),
            ];
            $order_setting = $this->OrderModel->updateRow($data, "id=$id");
            if ($order_setting) {
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
        // check_method_access('orderssetting', 'delete');
        $uid = $this->request->getPost('id');
        $res = $this->OrderModel->deleteRow($uid);
        if ($res) {
            json_response(1, "Succesfully Deleted");
        } else {
            json_response(0, "Something went wrong");
        }
    }

}