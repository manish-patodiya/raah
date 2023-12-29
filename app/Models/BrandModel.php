<?php
namespace App\Models;

use CodeIgniter\Model;

class BrandModel extends Model
{
    public $builder;
    public $db;
    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table('master_brand');
    }
    public function insert_data($data)
    {
        $builder = $this->builder;
        $data1 = [
            "updated_at" => date('Y-m-d'),
            "created_at" => date('Y-m-d'),
        ];
        $data = array_merge($data, $data1);
        $builder->insert($data);
        return $this->db->insertID();
    }
    public function getAll($filter = false, $limit = false, $offset = false)
    {
        $this->builder->select('*');
        if ($filter) {
            $this->builder->like('name', $filter, 'after');
        }
        $this->builder->limit($limit, $offset)
            ->where('deleted_at', null);
        return $this->builder->get()->getResult();
    }
    public function getCount($filter = '')
    {
        $this->builder->select('count(*) as count');
        if ($filter) {
            $this->builder->like('name', $filter, 'after');
        }
        return $this->builder->get()->getRow()->count;
    }
    public function updateRow($data, $where)
    {
        $data1 = [
            "updated_at" => date('Y-m-d'),
        ];
        $data = array_merge($data, $data1);
        $builder = $this->builder;
        $builder->set($data);
        $builder->where('id', $where);
        return $builder->update();

    }
    public function deleteRow($id)
    {
        $builder = $this->builder;
        $builder->set(['deleted_at' => date('Y-m-d')]);
        $builder->where('id', $id);
        $builder->update();
    }
    public function get_product_by_id($id)
    {
        $builder = $this->builder;
        $builder->select("master_brand.*")
            ->where('id', $id);
        return $builder->get()->getRowArray();
    }
}