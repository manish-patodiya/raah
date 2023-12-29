<?php
namespace App\Models;

use CodeIgniter\Model;

class ReferralModel extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table('referral_list');
    }

    public function get($id = '')
    {
        $this->builder->select('referral_list.*,ms.state_name,mc.city_name')->join('master_states ms', 'ms.state_id = referral_list.state_id', 'left')->join('master_cities mc', 'mc.city_id = referral_list.city_id', 'left')->where('deleted_at', null);
        if ($id) {
            $this->builder->where('id', $id);
            return $this->builder->get()->getRow();
        } else {
            return $this->builder->get()->getResult();
        }
    }

    public function insertOrg($post_data)
    {
        $data = [
            'name' => format_name($post_data['name']),
            'email' => $post_data['email'],
            'contact_no' => $post_data['contact'],
            'about' => trim(ucfirst($post_data['about'])),
            'pincode' => $post_data['pincode'],
            'city_id' => $post_data['city'],
            'state_id' => $post_data['state'],
            'address' => ucfirst($post_data['address']),
        ];
        $this->builder->insert($data);
        return $this->db->insertID();
    }

    public function updateOrg($post_data)
    {
        $data = [
            'name' => format_name($post_data['name']),
            'email' => $post_data['email'],
            'contact_no' => $post_data['contact'],
            'about' => trim(ucfirst($post_data['about'])),
            'pincode' => $post_data['pincode'],
            'city_id' => $post_data['city'],
            'state_id' => $post_data['state'],
            'address' => ucfirst($post_data['address']),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        return $this->builder->set($data)->where('id', $post_data['rfid'])->update();
    }

    public function deleteOrg($id)
    {
        return $this->builder->set('deleted_at', date('Y-m-d H:i:s'))->where('id', $id)->update();
    }
}