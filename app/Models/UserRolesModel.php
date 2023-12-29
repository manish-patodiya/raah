<?php
namespace App\Models;

use CodeIgniter\Model;

class UserRolesModel extends Model
{
    public $builder;
    public $db;
    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table('user_roles');

    }
    public function insertData($data)
    {
        $builder = $this->builder();
        $this->builder->insert($data);
        return $this->db->insertID();
    }

    public function insertCustomerRole($uid)
    {
        $data = [
            'role_id' => CUSTOMER_ROLE_ID,
            'user_id' => $uid,
        ];
        $this->builder->insert($data);
        return $this->db->insertID();
    }

    public function insertSellerRole($uid)
    {
        $data = [
            'role_id' => SELLER_ROLE_ID,
            'user_id' => $uid,
        ];
        $this->builder->insert($data);
        return $this->db->insertID();
    }

    public function deleteData($id, $role_id = false)
    {
        $this->builder->where("user_id", $id);
        if ($role_id) {
            $this->builder->where("role_id", $role_id);
        }
        $this->builder->delete();
        return $this->db->affectedRows();
    }

    public function getUserRoles($uid, $role_id)
    {
        $this->builder->select('role_id,role');
        $this->builder->join('roles r', 'user_roles.role_id=r.id', 'left');
        $this->builder->where('user_id ', $uid);
        $this->builder->where('role_id ', $role_id);
        $roles = $this->builder->get()->getResult();
        return $roles;
    }

    public function getRoles()
    {
        return $this->db->table('roles')->select('id as role_id,role')->get()->getResult();
    }

    public function getCount($id)
    {
        $builder = $this->builder;
        $builder->where('role_id', $id);
        return $builder->countAllResults();
    }

    public function checkRole($user_id)
    {
        $builder = $this->builder;
        $builder->select('id');
        $builder->where("user_id = $user_id AND role_id = 2");
        return $builder->countAllResults();
    }
}