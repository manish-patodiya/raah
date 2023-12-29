<?php
namespace App\Models;

use CodeIgniter\Model;

class StoreModel extends Model
{
    public function __construct()
    {
        $this->session = service('session');
        $this->db = db_connect();
        $this->builder = $this->db->table('store_details');
    }

    public function createStore($postData = false, $data = false)
    {
        if ($postData) {
            $data = [
                "user_id" => $this->session->seller_info["user_id"],
                "name" => $postData['name'],
                "gstin" => $postData['gst'],
                "pincode" => $postData['pincode'],
                "city_id" => $postData['city'],
                "state_id" => $postData['state'],
                "address" => $postData['address'],
            ];
        }
        if ($data) {
            // prd($data);
            $data1 = [
                "updated_at" => date('Y-m-d H:i:s'),
            ];
            $data2 = array_merge($data, $data1);
            $this->builder->insert($data2);
            return $this->db->insertId();
        }
    }

    public function updateRow($data, $id)
    {
        $data1 = [
            "updated_at" => date('Y-m-d'),
        ];
        $data = array_merge($data, $data1);
        $builder = $this->builder;
        $builder->set($data);
        $builder->where('id', $id);
        return $builder->update();
    }
    public function getAllSellers()
    {
        $builder = $this->builder;
        $builder->select('*, store_details.id as sid, store_details.address as store_address, up.id as up_id, u.id as id')
            ->join('users as u', 'u.id=store_details.user_id')
            ->join('users_profile as up', 'up.user_id=u.id')->where('store_details.deleted_at is NULL');
        return $builder->get()->getResult();
    }

    public function getSeller($id)
    {
        $builder = $this->builder;
        $builder->select('store_details.*, up.*, u.*, ua.*, ua.address as address, ms.state_name, ms.state_id, mc.city_name, mc.city_id, store_details.id as sid, store_details.address as address, up.user_id as upid,u.id as ui')
            ->join('users_profile as up', 'up.user_id=store_details.user_id')
            ->join('users as u', 'u.id=store_details.user_id', )
            ->join('users_address as ua', 'up.address_id=ua.id', 'left')
            ->join('master_states as ms', 'ua.state_id=ms.state_id', 'left')
            ->join('master_cities as mc', 'ua.city_id=mc.city_id', 'left')
            ->where("store_details.user_id", $id);
        return $builder->get()->getRow();
    }
    public function getviewSeller($id)
    {
        $builder = $this->builder;
        $builder->select('store_details.*, u.*, up.*, store_details.id as sid, up.user_id as upid, ms.state_name, ms.state_id, mc.city_name, mc.city_id')
            ->join('users as u', 'store_details.user_id=u.id', 'inner')
            ->join('users_profile as up', 'u.id=up.user_id', 'inner')
            ->join('master_states as ms', 'up.state_id=ms.state_id', 'left')
            ->join('master_cities as mc', 'up.city_id=mc.city_id', 'left');
        $builder->where("store_details.user_id", $id);
        return $builder->get()->getRow();
    }

    public function deleteUser($id)
    {
        $date = date('Y-m-d H:i:s');
        $res = $this->db->query("update store_details,users,users_profile set store_details.deleted_at='$date',users.deleted_at='$date',users_profile.deleted_at='$date' WHERE store_details.user_id=users.id and store_details.user_id=users_profile.user_id and store_details.id=$id");
        return $res;
    }

    public function getSellerStoreCount($uid)
    {
        return $this->builder->where(['user_id' => $uid, 'deleted_at' => null])->countAllResults();
    }

    public function count_pending_stores()
    {
        $this->builder->where('status', 0);
        $pending_sellers = $this->builder->get()->getResult();
        $pending_sellers = sizeof($pending_sellers);
        return $pending_sellers;
    }
    public function getAllStoreDetails()
    {
        $this->builder->select('*')
            ->where('status', 0);
        return $this->builder->get()->getResult();
    }
    public function getStoreDetailById($id)
    {
        $this->builder->select('user_id, name as Name, gstin as GSTIN, address as Address, account_no as Account No, ifsc_code as IFSC Code, status, pincode as Pincode, about_store as About Store, ms.state_id, ms.state_name as State Name, mc.city_id, mc.city_name as City Name')
            ->join('master_states as ms', 'store_details.state_id=ms.state_id', 'left')
            ->join('master_cities as mc', 'store_details.city_id=mc.city_id', 'left')
            ->where('user_id', $id);
        return $this->builder->get()->getRow();
    }
    public function get_seller_id($id)
    {
        $this->builder->select('id, user_id')->where('id', $id);
        return $this->builder->get()->getRow();
    }

}