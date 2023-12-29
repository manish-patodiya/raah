<?php
namespace App\Models;

use CodeIgniter\Model;

class Modules extends Model
{

    public function __construct()
    {
        $this->db = db_connect();
        $this->AdminModuleBuilder = $this->db->table('module_admin');
        $this->SellerModuleBuilder = $this->db->table('module_seller');
    }

    public function getAllAdminModules()
    {
        return $this->AdminModuleBuilder->select('*')->orderBy('sort_order', 'asc')->get()->getResult();
    }

    public function getAdminModules()
    {
        return $this->AdminModuleBuilder->select('*')->where('pid', 0)->orderBy('sort_order', 'asc')->get()->getResult();
    }

    public function getAdminSubModulesByID($id)
    {
        return $this->AdminModuleBuilder->select('*')->where('pid', $id)->orderBy('sort_order', 'asc')->get()->getResult();
    }

    public function getSellerModules()
    {
        return $this->SellerModuleBuilder->select('*')->where('pid', 0)->orderBy('sort_order', 'asc')->get()->getResult();
    }

    public function getSellerSubModulesByID($id)
    {
        return $this->SellerModuleBuilder->select('*')->where('pid', $id)->orderBy('sort_order', 'asc')->get()->getResult();
    }

    public function getPermissions($role_id)
    {
        return $this->db->table('module_access')->select('*')->where('role_id', $role_id)->get()->getResult();
    }

    public function deletePermissions($role_id)
    {
        return $this->db->table('module_access')->where('role_id', $role_id)->delete();
    }

    public function setPermissions($data)
    {
        return $this->db->table('module_access')->insertBatch($data);
    }

    public function getPermissionsForSession($role_id)
    {
        return $this->db->table('module_access')->select('operation,controller,title')->join('module_admin', 'module_admin.id = module_access.module_id', 'right')->where('role_id', $role_id)->get()->getResult();
    }

}