<?php
namespace App\Models;

use CodeIgniter\Model;

class GeneralSetting extends Model
{
    public $builder; // for transaction_settings table
    public $builder1; // for transaction_type table
    public $builder2;
    public $module;
    public $menu;
    public $db;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();

        $this->db = db_connect();
        $this->builder = $this->db->table('general_settings');
        // $this->builder1 = $this->db->table('transaction_type');
        // $this->builder2 = $this->db->table('trans_concept_master');
        // $this->module = $this->db->table('module');
        // $this->menu = $this->db->table('menu');
        // $this->master_menu = $this->db->table('master_menu');
    }
    public function getAll()
    {
        $builder = $this->builder;
        $builder->select('*')
            ->where('id', 1);
        return $this->builder->get()->getRow();
    }
    public function updateData($data)
    {
        $this->builder->set($data);
        $this->builder->where('id', 1);
        return $this->builder->update();
    }

    public function getTransType()
    {
        $builder1 = $this->builder1;
        $builder1->select('*');
        return $this->builder1->get()->getRow();
    }
    public function getTransConceptMaster($company_id)
    {
        $builder2 = $this->builder2;
        $builder2->select('*');
        // ->join('companies c', 'trans_concept_master.id=c.trans_concept_id', 'left');
        // ->where('c.id', $company_id);
        return $this->builder2->get()->getResult();
    }
    public function updateStartNo($data, $branch_id)
    {
        $builder = $this->builder;
        foreach ($branch_id as $k => $v) {
            $builder->set($data);
            $builder->where('branch_id', $v);
            $builder->update();}
    }

    public function get_all_module()
    {
        $module = $this->module;
        return $module->select('*')->where('method != ""')->get()->getResult();

        // echo $this->db->getLastQuery()->getQuery();
    }
    public function get_all_menu()
    {
        $menu = $this->menu;
        return $menu->select('*')->get()->getResult();

    }
    public function insertData_menu($data)
    {
        $menu = $this->menu;
        $menu->insert($data);
        return $this->db->insertID();
    }

    public function insertData_mudole_id_and_menu_name($data)
    {
        $master_menu = $this->master_menu;
        $master_menu->insert($data);
        return $this->db->insertID();
    }

    public function get_all_master_menu_by_id($id)
    {

        $master_menu = $this->master_menu;
        return $master_menu->select('*')->where('menu_id', $id)->get()->getRow();
        // echo $this->db->getLastQuery()->getQuery();

    }
    public function get_all_master()
    {
        $master_menu = $this->master_menu;
        return $master_menu->select('*')->get()->getRow();

    }
    // public function updateData($data, $id)
    // {
    //     return $this->master_menu->set($data)->where('menu_id', $id)->update();
    // }
}