<?php

namespace App\Models;

use CodeIgniter\Model;

class SellerModel extends Model
{
    public function __construct()
    {
        $this->session = service('session');
        $this->db = db_connect();
        $this->builder = $this->db->table('orders');
        $this->order_products = $this->db->table('order_products');
        $this->order_setting_builder = $this->db->table('order_cancel_reasons');
        $this->payment_builder = $this->db->table('order_payment');
    }

    public function getSellerOrders($oids)
    {
        $builder = $this->builder;
        $builder->select('orders.*, u.id as uid, u.full_name, u.phone, u.email, up.user_id, up.address_id, up.id as up_id, ua.id as Ua_id, ua.address, ua.user_id, ua.city_id, ua.state_id, ua.country_id, ua.zipcode, ua.is_default, ms.state_id, ms.state_name, mc.city_id, mc.city_name, mc.state_id')
            ->join('users as u', 'u.id=orders.customer_user_id')
            ->join('users_profile as up', 'up.user_id=u.id')
            ->join('users_address as ua', 'up.address_id=ua.id', 'left')
            ->join('master_states as ms', 'ua.state_id=ms.state_id', 'left')
            ->join('master_cities as mc', 'ua.city_id=mc.city_id', 'left')
            ->where('orders.deleted_at', null)
            ->whereIn('orders.id', $oids)
            ->where('orders.payment_status', 2);
        return $builder->get()->getResult();
    }

    public function getOrderProducts($oids = false, $uids = false, $fltr_data = [])
    {
        $builder = $this->order_products;
        $builder->select('order_products.*, p.title, p.product_details, p.mrp, pi.product_image, pi.is_default')
            ->join('products as p', 'p.id=order_products.product_id')
            ->join('product_images pi', 'pi.product_id=p.id', 'left')
            ->where("(is_default = 1 OR is_default is NULL) AND (type = '200X200' OR type is NULL)");
        if ($uids) {

            if (!isset($fltr_data['search'])) {
                // filter with date range
                if (!$fltr_data || !isset($fltr_data['from']) || !isset($fltr_data['to'])) {
                    $to = date("Y-m-d");
                    $from = date('Y-m-d', strtotime('-1 month', strtotime($to)));
                } else {
                    $from = $fltr_data['from'];
                    $to = $fltr_data['to'];
                }
                $builder->where("date(order_products.created_at) BETWEEN '$from' AND '$to'");

                // filter with status
                if (isset($fltr_data['status'])) {
                    $status = $fltr_data['status'];
                    $builder->where("order_products.status", $status);
                }

            } else {
                // filter with product order id
                $order_id = $fltr_data['search'];
                $arr = explode("-", $order_id);
                $builder->where("order_products.product_order_id", $arr[0]);
            }

            // filter with sellerwise
            $builder->whereIn("order_products.seller_user_id", $uids);
        }
        if ($oids) {
            $builder->whereIn("order_products.fk_order_id", $oids);
        }
        return $builder->get()->getResult();
        // prd($this->db->getLastQuery()->getQuery());
    }

    public function getOrderDetails($oid)
    {
        $builder = $this->order_products;
        $builder->select('order_products.*, p.title, p.product_details, p.mrp, pi.product_image, pi.is_default')
            ->join('products as p', 'p.id=order_products.product_id')
            ->join('product_images pi', 'pi.product_id=p.id', 'left')
            ->where("(is_default = 1 OR is_default is NULL) AND (type = '200X200' OR type is NULL)")
            ->where("order_products.fk_order_id", $oid);
        return $builder->get()->getResult();
    }

    public function addOrder($details)
    {
        // make array to push in orders table
        $data = [
            "customer_user_id" => $details['customer_id'],
            "total_amt" => $details['grand_total'],
            "updated_at" => date('Y-m-d'),
            "payment_status" => 1,
        ];
        $this->builder->insert($data);
        $insertID = $this->db->insertID();

        $order_id = $this->_update_order_id($insertID);

        // push all products id along with order_id
        foreach ($details['products_details'] as $v) {
            $prod_data = [
                "seller_user_id" => $v->seller_id,
                "fk_order_id" => $insertID,
                "product_id" => $v->product_id,
                "qty" => $v->quantity,
                "product_amt" => $v->sale_price,
            ];
            $this->order_products->insert($prod_data);
            $opid = $this->db->insertID();
            $this->_update_product_order_id($opid);
        }
        return $order_id;
    }

    private function _update_order_id($id)
    {
        $transction_id = strtoupper(unique_string(3) . $id);
        $this->builder->set('order_id', $transction_id)->where('id', $id)->update();
        return $transction_id;
    }

    private function _update_product_order_id($id)
    {
        $product_order_id = strtoupper(unique_string(3) . $id);
        $this->order_products->set('product_order_id', $product_order_id)->where('id', $id)->update();
        return $product_order_id;
    }

    public function updateOrderStatus($status, $order_id)
    {
        return $this->builder->set('payment_status', 2)->where('order_id', $order_id)->update();
    }

    public function insertPayment($post_data)
    {
        $res = $this->builder->where('order_id', $post_data['order_id'])->get()->getRow();
        $data = [
            'payment_id' => $post_data['payment_id'],
            'fk_order_id' => $res->id,
            'payment_type' => 'Paid',
            'paid_amt' => $post_data['paid_amt'],
        ];
        $this->payment_builder->insert($data);
        return $this->db->insertID;
    }

    public function deleteOrder($order_id)
    {
        $order = $this->builder->where('order_id', $order_id)->get()->getRow();
        $order_id = $order->id;

        // delete data from order table
        $this->builder->where('id', $order_id)->delete();

        // delete data from order products table
        $this->order_products->where('fk_order_id', $order_id)->delete();
        return $order_id;
    }

    public function getAllOrders()
    {
        // oid(order id), uid(user id) and pid (user profile id)..................
        $builder = $this->builder;
        $builder->select('*, orders.id as oid, u.id as uid, p.id as pid, orders.created_at as created_at')
            ->join('users as u', 'u.id=orders.customer_user_id')
            ->join('products as p', 'p.id=orders.product_id')
            ->join('product_images as pi', 'p.id=pi.product_id')
            ->join('users_profile as up', 'up.user_id=u.id')
            ->join('users_address as ua', 'up.address_id=ua.id', 'left')
            ->join('master_states as ms', 'ua.state_id=ms.state_id', 'left')
            ->join('master_cities as mc', 'ua.city_id=mc.city_id', 'left')
            ->where('p.user_id=orders.seller_user_id')
            ->where('orders.deleted_at is NULL')
            ->where('pi.is_default', 1);
        return $builder->get()->getResult();
    }

    public function getOrderProductsByTransactionID($order_id)
    {
        // get datetime before 5 minute
        $date = date('Y-m-d H:i:s', time() - 300);

        $this->builder->select('op.qty as quantity, p.title, p.product_details, p.mrp, p.sale_price, p.discount, pi.product_image')
            ->join('order_products op', 'orders.id = op.fk_order_id')
            ->join('products as p', 'p.id=op.product_id')
            ->join('product_images pi', 'pi.product_id=p.id', 'left')
            ->where("(is_default = 1 OR is_default is NULL) AND (type = '200X200' OR type is NULL)")
            ->where("orders.order_id", $order_id)
            ->where('orders.created_at >=', "$date");

        return $this->builder->get()->getResult();
    }

    // master table  this (order_cancel_reasons) aer used for........................
    // order_setting_builder this builder name

    public function insertData($data)
    {
        $data1 = [
            "created_at" => date('Y-m-d'),
        ];
        $data2 = array_merge($data, $data1);
        $this->order_setting_builder->insert($data2);
        return $this->db->insertID();
    }

    public function getAll_order_setting()
    {
        $Ord_Set_builder = $this->order_setting_builder;
        $Ord_Set_builder->select('*')->where('deleted_at is null');
        return $Ord_Set_builder->get()->getResult();
    }

    public function getOrderSetting($id)
    {
        $Ord_Set_builder = $this->order_setting_builder;
        $Ord_Set_builder->select('*')->where("id=$id");
        return $Ord_Set_builder->get()->getRow();
    }

    public function updateRow($data, $where_condition)
    {
        // prd($where_condition);
        $data1 = [
            "updated_at" => date('Y-m-d'),
        ];
        $Ord_Set_builder = $this->order_setting_builder;
        $data = array_merge($data, $data1);
        $Ord_Set_builder->set($data);
        $Ord_Set_builder->where($where_condition);
        return $Ord_Set_builder->update();
    }

    public function updateOrder($data, $oid, $pid)
    {
        $builder = $this->builder;
        return $this->db->table('order_products')->set($data)
            ->where('fk_order_id', $oid)->where('product_id', $pid)->update();
    }

    public function deleteRow($id)
    {
        $Ord_Set_builder = $this->order_setting_builder;
        $Ord_Set_builder->where('id', $id);
        return $Ord_Set_builder->delete();
    }

    public function getOrderDetail($id)
    {
        $builder = $this->builder;
        // prd($id);
        $builder->select('orders.*, ua.id, ua.address')
            ->join('users_address as ua', 'orders.customer_user_id=ua.user_id', 'left')
            ->where('orders.id', $id);
        return $builder->get()->getRow();
    }

    public function getCustomerOrders($id)
    {
        // prd($id);
        $builder = $this->builder;
        $builder->select('orders.*, orders.id as id, u.id as uid, u.full_name, u.phone, u.email, up.user_id, up.address_id, up.id as upid, ua.id as uaid, ua.address, ua.user_id, ua.city_id, ua.state_id, ua.country_id, ua.zipcode, ua.is_default, ms.state_id, ms.state_name, mc.city_id, mc.city_name, mc.state_id')
            ->join('users as u', 'u.id=orders.customer_user_id')
            ->join('users_profile as up', 'up.user_id=u.id')
            ->join('users_address as ua', 'up.address_id=ua.id', 'left')
            ->join('master_states as ms', 'ua.state_id=ms.state_id', 'left')
            ->join('master_cities as mc', 'ua.city_id=mc.city_id', 'left')
            ->where('orders.deleted_at', null)
            ->where('orders.customer_user_id', $id);
        return $builder->get()->getResult();
    }

    public function getInvoiceDetail($oid, $pid = false)
    {
        $this->builder->select('orders.*, op.seller_user_id, op.fk_order_id, op.product_id, op.product_order_id, op.qty, op.status, op.product_amt,op.shipping_charges,opmt.payment_type, p.id, p.title, p.mrp, p.discount, p.gst_rate, pi.product_id, pi.is_default, pi.type, pi.product_image, u.id as uid, u.full_name, u.phone, u.email, up.user_id, up.address_id, up.id as upid, ua.id as uaid, ua.address, ua.user_id, ua.city_id, ua.state_id, ua.country_id, ua.zipcode, ms.state_id, ms.state_name, mc.city_id, mc.city_name, mc.state_id')
            ->join('order_products as op', 'op.fk_order_id=orders.id')
            ->join('order_payment as opmt', 'opmt.fk_order_id=orders.id')
            ->join('products as p', 'p.id=op.product_id')
            ->join('product_images pi', 'pi.product_id=p.id', 'left')
            ->join('users as u', 'u.id=orders.customer_user_id')
            ->join('users_profile as up', 'up.user_id=u.id')
            ->join('users_address as ua', 'up.address_id=ua.id', 'left')
            ->join('master_states as ms', 'ua.state_id=ms.state_id', 'left')
            ->join('master_cities as mc', 'ua.city_id=mc.city_id', 'left')
            ->where('op.fk_order_id', $oid)
            ->where('op.status', 1)
            ->where("(pi.is_default = 1 OR pi.is_default is NULL) AND (type = '200X200' OR type is NULL)");
        if ($pid) {
            $this->builder->where('op.product_id', $pid);
        }
        $product_detail = $this->builder->get()->getRow();
        $invoice_detail[] = $this->db->table('users as u')->select('u.id, u.full_name, u.phone, u.email, ua.id as uaid, ua.address, ua.user_id, ua.city_id, ua.state_id, ua.country_id, ua.zipcode')->join('users_address as ua', 'u.id=ua.user_id', 'left')->where('u.id', $product_detail->seller_user_id)->get()->getRow();
        $data[] = $product_detail;
        $invoice_detail = array_merge($data, $invoice_detail);
        return $invoice_detail;
    }
}