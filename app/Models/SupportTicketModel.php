<?php
namespace App\Models;

use CodeIgniter\Model;

class SupportTicketModel extends Model
{
    public $builder;
    public $db;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
        $this->db = db_connect();
        $this->builder = $this->db->table('support_tickets');

    }

    public function getSupport($tid = false)
    {
        $builder = $this->builder;
        $builder->select("support_tickets.*,users.full_name,users.email,users.phone,stsm.id as stid,stsm.status_name")
            ->join('users', 'users.id=support_tickets.user_id')
            ->join('support_tickets_status_master stsm', 'stsm.id=support_tickets.status_id')
            ->where("support_tickets.deleted_at is NULL")
            ->orderBy('ticket_id', 'asc');

        if ($tid) {
            $builder->where('status_id', $tid);
        };
        return $builder->get()->getResult();
    }

    public function getStatus_id()
    {
        $builder = $this->builder = $this->db->table('support_tickets_status_master');
        $builder->select("*");
        return $builder->get()->getResult();
    }

    public function insertData($data)
    {
        $builder = $this->builder;
        $data1 = [
            "updeted_at" => date('Y-m-d'),
            "created_at" => date('Y-m-d'),
        ];
        $data = array_merge($data, $data1);
        $builder->insert($data);
        return $this->db->insertID();
    }

    public function updateRow($data, $where)
    {

        $data1 = [
            "updeted_at" => date('Y-m-d'),
        ];
        $data = array_merge($data, $data1);
        $builder = $this->builder;
        $builder->set($data);
        $builder->where($where);
        return $builder->update();
    }
    public function update_status_id($data, $ticket_id)
    {
        $data1 = [
            "updeted_at" => date('Y-m-d'),
        ];
        $data = array_merge($data, $data1);
        $builder = $this->builder;
        $builder->where('ticket_id', $ticket_id)->set($data);
        //echo $this->db->getLastQuery();die;
        return $builder->update();
    }
    public function deleteRow($ticket_id)
    {
        $builder = $this->builder;
        $builder->set(['deleted_at' => date('Y-m-d')]);
        $builder->where('ticket_id', $ticket_id);
        return $builder->update();
    }
    public function get_support_by_id($ticket_id)
    {
        $builder = $this->builder;
        $builder->select("support_tickets.*,users.full_name,users.email,users.phone,stsm.id as stid,stsm.status_name")
            ->join('users', 'users.id=support_tickets.user_id')
            ->join('support_tickets_status_master stsm', 'stsm.id=support_tickets.status_id')
            ->where("support_tickets.deleted_at is NULL")
            ->where('ticket_id', $ticket_id);
        return $builder->get()->getRow();
    }
    public function get_support_count()
    {
        $this->builder->select('*,status_id,count(status_id) as count');
        $this->builder->groupBy('status_id');
        $this->builder->where("deleted_at is NULL");
        $query = $this->builder->get()->getResult();
        return $query;
    }

    public function get_all_support_tickets()
    {

        $this->builder->select('*');
        $this->builder->where("deleted_at is NULL");
        return $this->builder->get()->getResult();
    }

    public function getFields($fields, $where)
    {
        $this->builder->select($fields);
        $this->builder->where("deleted_at is NULL");
        if ($where) {
            $this->builder->where($where);
        }
        return $this->builder->get()->getRowArray();
    }

    //....................Seller ........................//

    public function getSupportSeller()
    {
        $user_id = $this->session->get('seller_info')['user_id'];
        $builder = $this->builder;
        $builder->select("support_tickets.*,users.full_name,users.email,users.phone,stsm.id as stid,stsm.status_name")
            ->join('users', 'users.id=support_tickets.user_id')
            ->join('support_tickets_status_master stsm', 'stsm.id=support_tickets.status_id')
            ->where("support_tickets.deleted_at is NULL")
            ->orderBy('ticket_id', 'asc');

        $builder->where('support_tickets.user_id', $user_id);

        return $builder->get()->getResult();
    }

}