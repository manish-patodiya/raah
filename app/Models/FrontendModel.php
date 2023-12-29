<?php

namespace App\Models;

use CodeIgniter\Model;

class FrontendModel extends Model
{
    public $builder;
    public $db;
    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table('frontend_cms');
    }

    public function updateRow($post_data)
    {
        if (isset($post_data['id']) && $post_data['id']) {
            $data = [
                "title" => ucwords(trim($post_data["title"])),
                "name" => ucwords(trim($post_data["name"])),
                "url" => $post_data["url"],
                "seo_title" => ucwords(trim($post_data["seo_title"])),
                "seo_description" => ucfirst($post_data["seo_description"]),
                "content" => isset($post_data['content']) ? ucfirst($post_data["content"]) : '',
            ];

            return $this->builder->set($data)->where('id', $post_data['id'])->update();
        } else {
            return false;
        }
    }

    public function get_by_id($id)
    {
        $this->builder->select('*')->where('id', $id);
        return $this->builder->get()->getRowArray();
    }

    public function add_contact_enquiry($post_data)
    {
        $data = [
            "first_name" => format_name($post_data['first_name']),
            "last_name" => format_name($post_data['last_name']),
            "email" => $post_data['email'],
            "phone" => $post_data['phone'],
            "subject" => $post_data['subject'],
            "message" => $post_data["message"],
            "updated_at" => date('Y-m-d'),
            "created_at" => date('Y-m-d'),
        ];
        $this->db->table('contact_page_enquiries')->insert($data);
        return $this->db->insertID();
    }

    public function subscribe_newslater($email)
    {
        $data = [
            "email" => $email,
            "updated_at" => date('Y-m-d'),
            "created_at" => date('Y-m-d'),
        ];
        $this->db->table('newslater_subscriptions')->insert($data);
        return $this->db->insertID();
    }

    public function faqs()
    {
        return $this->db->table('faqs')->select('*')->get()->getResult();
    }
}