<?php

namespace App\Controllers\Customer;

use App\Controllers\Customer\CustomerController;

class MyOrders extends CustomerController
{
    public function __construct()
    {
        parent::__construct();
        $this->OrderModel = model("OrderModel");
    }

    public function index()
    {
        $orders = $this->OrderModel->getCustomerOrders($this->session->customer_info['user_id']);
        $products = '';
        // prd($orders);
        if ($orders) {
            foreach ($orders as $k => $v) {
                $orders_ids[] = $v->id;
            }
            $products = $this->OrderModel->getOrderProducts($orders_ids);
        }
        $data = [
            'session' => $this->session,
            'orders' => $this->OrderModel->getCustomerOrders($this->session->customer_info["user_id"]),
        ];
        if ($products) {
            $data["order_products"] = $products;
        }
        // prd($data);  
        return view('customer/orders/my_orders', $data);
    }

    public function order_detail($order_id)
    {
        $data = [
            "session" => $this->session,
            'order_details' => $this->OrderModel->getOrderDetail($order_id),
            'order_products_details' => $this->OrderModel->getOrderProducts([$order_id]),
        ];
        return view('customer/orders/order_details', $data);
    }
}