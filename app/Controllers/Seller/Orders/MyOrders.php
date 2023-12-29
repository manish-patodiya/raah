<?php
namespace App\Controllers\Seller\Orders;

use App\Controllers\Seller\SellerController;

class MyOrders extends SellerController
{
    public function __construct()
    {
        parent::__construct();
        $this->ProfileModel = model('ProfileModel');
        $this->UserRolesModel = model('UserRolesModel');
        $this->OrderModel = model('OrderModel');
        $this->UserModel = model('UserModel');
    }

    public function index()
    {
        $fltr_data = $this->request->getGet();

        $orders = $this->OrderModel->getOrderProducts('', [$this->session->seller_info['user_id']], $fltr_data);
        // prd($orders);
        if ($orders) {
            foreach ($orders as $k => $v) {
                $orders_ids[] = $v->fk_order_id;
            }
            // prd($orders_ids);
            $orders_ids = array_unique($orders_ids);
            $products = $this->OrderModel->getSellerOrders($orders_ids);
            $data = [
                'session' => $this->session,
                'orders' => $products,
                'order_products' => $orders,
                'get_data' => $fltr_data ?: [],
            ];
        } else {
            $data = [
                'session' => $this->session,
                'get_data' => $fltr_data,
            ];
        }
        return view('seller/orders/my_orders', $data);
    }

    public function change_order_status($id = false)
    {
        $data = [
            "status" => $this->request->getGet('data'),
        ];
        $result = $this->OrderModel->updateOrder($data, $id, $this->request->getGet('pid'));
        if ($result) {
            echo json_encode([
                "msg" => "Status updated successfully",
                "status" => 1,
            ]);
        }
    }

    public function order_detail($order_id)
    {
        $data = [
            'session' => $this->session,
            'order_details' => $this->OrderModel->getOrderDetail($order_id),
            'order_products_details' => $this->OrderModel->getOrderDetails($order_id),
        ];
        // prd($data);
        return view("seller/orders/order_details", $data);
    }

    public function order_invoice($oid)
    {
        $data = [
            "session" => $this->session,
            "details" => $this->OrderModel->getInvoiceDetail($oid, $this->request->getGet('pid')),
        ];
        return view("seller/orders/order_invoice", $data);
    }

    public function add_orders()
    {
        $data = '';
        $order_id = $this->OrderModel->add($data);
        // prd($order_id);
    }
}