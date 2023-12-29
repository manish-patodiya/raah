<?php
namespace App\Models\shipping;

use CodeIgniter\Model;

class PickupLocations extends Model
{
    public function __construct()
    {
        $this->session = service('session');
        $this->db = db_connect();
        $this->builder = $this->db->table('pickuplocations');
    }

    public function insertData($data)
    {
        $data1 = [
            "created_at" => date('Y-m-d'),
        ];
        $data2 = array_merge($data, $data1);
        return $this->builder->insert($data2);
    }

    public function getAllpickuplocations()
    {
        $Ord_Set_builder = $this->builder;
        $Ord_Set_builder->select('*')->where('deleted_at is null');
        return $Ord_Set_builder->get()->getResult();

    }
    public function getOrderSetting($id)
    {
        $Ord_Set_builder = $this->builder;
        $Ord_Set_builder->select('*')->where("id=$id");
        return $Ord_Set_builder->get()->getRow();

    }
    public function updateRow($data, $uid)
    {
        $data1 = [
            "updated_at" => date('Y-m-d'),
        ];
        $builder = $this->builder;
        $data = array_merge($data, $data1);
        $builder->set($data);
        $builder->where($uid);
        return $builder->update();
    }

    public function deleteRow($id)
    {
        $builder = $this->builder;
        $builder->where('id', $id);
        return $builder->delete();
    }
}