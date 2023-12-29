<?php

namespace App\Models;

use CodeIgniter\Model;

class TestimonialModel extends Model
{
    public $builder;
    public $db;
    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table('testimonials');
    }
    public function get_testimonials()
    {
        return $this->builder->get()->getResult();
    }
}