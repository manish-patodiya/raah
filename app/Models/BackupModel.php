<?php
namespace App\Models;

use CodeIgniter\Model;

class AttributeModel extends Model
{
    public $builder;
    public $builder1;
    public $db;
    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table('backup_history');
    }

    public function insertRow($data)
    {
        $builder = $this->builder;
        $builder->insert($data);
        return $this->db->insertID();
    }

    public function getAll()
    {
        $this->builder->select('*')->orderBy('created_at', 'desc');
        return $this->builder->get()->getResult();
    }

    public function deleteRow($id)
    {
        $builder = $this->builder;
        $builder->where('id', $id);
        $builder->delete();
        return $this->db->affectedRows();
    }
}