<?php
namespace App\Models;

use CodeIgniter\Model;

class Templates extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table('templates');
        $this->session = service('session');
    }

    public function getTemplateById($id)
    {
        $this->builder->select('*')
            ->where('templates.id', $id);
        return $this->builder->get()->getRow();
    }
}