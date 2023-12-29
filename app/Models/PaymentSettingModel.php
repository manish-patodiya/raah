<?php
namespace App\Models\product_models;

use CodeIgniter\Model;

class productModel extends Model
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();

        $this->db = db_connect();
        $this->builder = $this->db->table('payment_settings');
    }

    public function get()
    {
        return $this->builder->get()->getResult();
    }

    public function add($data)
    {
        $res = $this->builder->where('payment_type', $data['payment_type'])->countAllResults();
        if ($res) {
            return $this->builder->set($data)->where('payment_type', $data['payment_type'])->update();
        } else {
            $this->builder->insert($data);
            return $this->db->insertID();
        }
    }

    public function get_details($type)
    {
        return $this->builder->where('payment_type', $type)->get()->getRow();
    }

    public function update_gateway($type)
    {
        $this->builder->set('is_active', 0)->update();

        if ($type != "none") {
            $this->builder->set('is_active', 1)->where('payment_type', $type)->update();
        }
    }

    public function update_detail($data, $type)
    {
        $this->builder->set($data)->where('payment_type', $type)->update();
    }

    public function delete_detail($type)
    {
        $this->builder->where('payment_type', $type)->delete();
    }
}