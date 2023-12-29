<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    public $db;
    public $builder;

    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table('users');
    }

    // function to insert data in the table
    public function insertData($post_data)
    {
        $data = [
            "full_name" => format_name($post_data['full_name']),
            "phone" => $post_data['phone'],
            "email" => $post_data['email'],
            "password" => encrypt_password($post_data['password']),
            "updated_at" => date('Y-m-d'),
            "created_at" => date('Y-m-d'),
        ];
        $this->builder->insert($data);
        return $this->db->insertID();
    }

    public function updateUser($data, $uid)
    {
        $data1 = [
            "updated_at" => date('Y-m-d'),
        ];
        $data = array_merge($data, $data1);
        $builder = $this->builder;
        $builder->set($data);
        $builder->where('id', $uid);
        $builder->update();
    }

    public function login($phone, $role_id)
    {
        $this->builder->select('users.*,ur.role_id,ur.user_id');
        $this->builder->join('user_roles ur', 'ur.user_id = users.id');
        $this->builder->where(["users.phone" => "$phone", 'ur.role_id' => $role_id]);
        $this->builder->where("deleted_at", null);
        $result = $this->builder->get()->getRow();
        return $result;
    }

    // funtion to get rows on the basis of condition
    public function get($uid)
    {
        $builder = $this->builder;
        $builder->select('*,users.id uid, s.id as store_id')
            ->join('store_details as s', 's.user_id=users.id', 'left')
            ->join('master_states ms', 'ms.state_id=s.state_id', 'left')
            ->join('master_cities mc', 'mc.city_id=s.city_id', 'left');
        $builder->where('users.id', $uid);
        $builder->where('users.deleted_at is NULL');
        return $builder->get()->getRow();
    }

    public function getUser($where)
    {
        $builder = $this->builder;
        $builder->select('*');
        $builder->where($where);
        $builder->where('deleted_at is NULL');
        return $builder->get()->getRow();
    }

    public function getFeilds($select, $where = "")
    {
        $builder = $this->builder;
        $builder->select($select);
        if ($where) {
            $builder->where($where);
        }
        $builder->where('deleted_at is NULL');
        return $builder->get()->getResultArray();
    }

    //function to get all row in the table
    public function getAll()
    {
        $builder = $this->builder;
        $builder->select("*");
        $builder->where('deleted_at is NULL');
        return $builder->get()->getResultArray();
    }

    public function getAllMembers($limit, $offset, $filter)
    {
        $builder = $this->builder;
        $builder->select('users.*,users.id as user_id,up.address_id,up.pincode,ms.state_name,mc.city_name, ua.id, ua.address, ua.state_id, ua.city_id, ua.country_id')
            ->join('user_roles ur', 'users.id = ur.user_id')
            ->join('users_profile as up', 'up.user_id=users.id')
            ->join('users_address as ua', 'up.address_id=ua.id', 'left')
            ->join('master_states as ms', 'ua.state_id=ms.state_id', 'left')
            ->join('master_cities as mc', 'ua.city_id=mc.city_id')
            ->where('ur.role_id', CUSTOMER_ROLE_ID)
            ->where('users.deleted_at is NULL');
        $builder->limit($limit, $offset);
        if ($filter) {
            if (isset($filter['search']) && $filter['search']) {
                $builder->like('full_name', $search, 'after')
                    ->orlike('phone', $search, 'after')
                    ->orlike('email', $search, 'after');
            }
        }
        return $builder->get()->getResult();
    }

    public function getAllSellers($limit, $offset, $filter)
    {
        $builder = $this->builder;
        $builder->select('users.*,users.id as user_id')
            ->join('user_roles ur', 'users.id = ur.user_id')
            ->where('ur.role_id', SELLER_ROLE_ID)
            ->where('deleted_at is NULL');
        $builder->limit($limit, $offset);
        if ($filter) {
            if (isset($filter['search']) && $filter['search']) {
                $builder->like('full_name', $search, 'after')
                    ->orlike('phone', $search, 'after')
                    ->orlike('email', $search, 'after');
            }
        }
        return $builder->get()->getResult();
    }

    public function getCount($filter)
    {
        $builder = $this->builder;
        $builder->join('user_roles ur', 'ur.user_id = users.id');
        if (!empty($filter)) {
            if (isset($filter['search']) && $filter['search']) {
                $search = $filter['search'];
                $builder->like('full_name', $search, 'after')
                    ->orlike('phone', $search, 'after')
                    ->orlike('email', $search, 'after');
            }
            if (isset($filter['is_seller']) && $filter['is_seller']) {
                $builder->where('ur.role_id', SELLER_ROLE_ID);
            }
            if (isset($filter['is_member']) && $filter['is_member']) {
                $builder->where('ur.role_id', CUSTOMER_ROLE_ID);
            }
        }
        $builder->where('deleted_at is NULL');
        return $builder->countAllResults();
    }

    // function to update any row
    public function updateRow($data, $where)
    {
        $data1 = [
            "updated_at" => date('Y-m-d'),
        ];
        $data = array_merge($data, $data1);
        $builder = $this->builder;
        $builder->set($data);
        $builder->where($where);
        $builder->update();

    }

    public function deleteUser($id)
    {
        $builder = $this->builder;
        $builder->set(['deleted_at' => date('Y-m-d')]);
        $builder->where('id', $id);
        return $builder->update();
    }

    public function getUserByIdentifier($where)
    {
        $builder = $this->builder;
        $builder->select('*');
        $builder->where($where);
        $builder->where('deleted_at is NULL');
        return $builder->get()->getRow();
    }

    public function getUserByToken($token)
    {
        return $this->builder->where('verification_token', $token)->get()->getRow();
    }

    public function getSellerInfo($id)
    {
        $this->builder->select('*')
            ->join('users_profile as up', 'up.user_id=users.id')
            ->join('users_address as ua', 'up.address_id=ua.id', 'left')
            ->join('master_states as ms', 'ua.state_id=ms.state_id', 'left')
            ->join('master_cities as mc', 'ua.city_id=mc.city_id', 'left')
            ->where('users.id', $id);
        return $this->builder->get()->getResult();
    }
}