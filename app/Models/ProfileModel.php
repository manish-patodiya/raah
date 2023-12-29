<?php
namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{
    public function __construct()
    {
        $this->session = service('session');
        $this->db = db_connect();
        $this->builder = $this->db->table('users_profile');
    }

    public function insertData($post_data)
    {
        $data = [
            "user_id" => $post_data['user_id'],
            "full_name" => format_name($post_data['full_name']),
            "email" => $post_data['email'],
            "phone" => $post_data['phone'],
            "updated_at" => date('Y-m-d'),
            "created_at" => date('Y-m-d'),
        ];
        return $this->builder->insert($data);
    }

    // function to run query to get user detail
    public function getUserProfile($id)
    {
        $this->builder->where("user_id", $id);
        $this->builder->where("deleted_at is NULL");
        $result = $this->builder->get()->getRow();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    // function to run query to delete user from database
    public function deleteUser($id)
    {
        $builder = $this->builder;
        $builder->set(['deleted_at' => date('Y-m-d')]);
        $builder->where('user_id', $id);
        $res = $builder->update();
        return $res;
        // echo $this->db->getLastQuery()->getQuery();
    }

    // function to run query to select field as per condition
    public function getFields($select, $where = "")
    {
        $builder = $this->builder;
        $builder->select($select);
        if ($where) {
            $builder->where($where);
        }
        $builder->where('deleted_at is NULL');
        return $builder->get()->getRow();
    }

    //function to run query to update data in database
    public function updateRow($data, $uid)
    {
        $data1 = [
            "updated_at" => date('Y-m-d'),
        ];
        $data = array_merge($data, $data1);
        $builder = $this->builder;
        $builder->set($data);
        $builder->where('user_id', $uid);
        return $builder->update();
    }

    // function to get member profile detail form different table in database
    public function getUser($id)
    {
        $builder = $this->builder;
        $builder->select('users_profile.*, ua.id, ua.user_id, ua.address, ua.city_id, ua.state_id, ua.country_id');
        $builder->where('users_profile.user_id', $id)
            ->join('users_address as ua', 'users_profile.address_id=ua.id', 'left');
        return $builder->get()->getRow();
    }
    public function getCustomer($id)
    {
        $builder = $this->builder;
        $builder->select('*');
        $builder->where('users_profile.user_id', $id);
        return $builder->get()->getRow();
    }
    public function getViewcustomer($id)
    {
        $builder = $this->builder;
        $builder->select('*,ms.state_name,mc.city_name')->join('master_states as ms', 'ms.state_id=users_profile.state_id')->join('master_cities as mc', 'mc.city_id=users_profile.city_id')->where("users_profile.user_id=$id");
        return $builder->get()->getRow();
    }

}