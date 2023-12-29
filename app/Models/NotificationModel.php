<?php
namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{

    public function __construct()
    {
        $this->db = db_connect();
        $this->ScreenNotificationBuilder = $this->db->table('user_screen_notifications');
        $this->reasons = $this->db->table('unsubscribe_reason');
        $this->notification_dnd = $this->db->table('notification_dnd');
        $this->TemplateBuilder = $this->db->table('notification_template');
    }

    public function add_user_notification($data)
    {
        $notification_builder = $this->ScreenNotificationBuilder;
        $notification_builder->insert($data);
        return $this->db->insertID();
    }

    public function get_notification_settings()
    {
        return $this->db->table('notification_setting')->get()->getRow();
    }

    public function set_notification_settings($data)
    {
        return $this->db->table('notification_setting')->set($data)->update();
    }

    public function get_user_screen_notification($uid, $limit = false)
    {
        // prd($notification_fetch_time);
        $this->ScreenNotificationBuilder->select('*')
            ->orderBy('date', 'desc');
        if (isset($limit)) {
            $this->ScreenNotificationBuilder->limit($limit);
        }
        $this->ScreenNotificationBuilder->where(['user_id' => $uid, 'deleted_at' => null]);
        return $this->ScreenNotificationBuilder->get()->getResult();
    }

    public function delete_user_screen_notification($id)
    {
        return $this->ScreenNotificationBuilder->set('deleted_at', date('Y-m-d H:i:s'))->where('id', $id)->update();
    }

    public function getAllTemplates()
    {
        return $this->TemplateBuilder->where('deleted_at', null)->get()->getResult();
    }

    public function getTemplate($id)
    {
        return $this->TemplateBuilder->where('id', $id)->get()->getRow();
    }

    public function insertTemplate($data)
    {
        $this->TemplateBuilder->insert($data);
        return $this->db->insertID();
    }

    public function updateTemplate($data, $id)
    {
        return $this->TemplateBuilder->set($data)->where('id', $id)->update();
    }

    public function deleteTemplate($id)
    {
        return $this->TemplateBuilder->set('deleted_at', date('Y-m-d H:i:s'))->where('id', $id)->update();
    }
    public function getAllReasons()
    {
        $this->reasons->select('*');
        return $this->reasons->get()->getResult();
    }

    public function unsubscribe_user($data)
    {
        $this->notification_dnd->insert($data);
        return $this->db->insertID();
    }
    public function notification_dnd()
    {
        $this->notification_dnd->select('*');
        return $this->notification_dnd->get()->getResult();
    }
    public function updateRow($data, $id)
    {
        // prd($data);
        $this->ScreenNotificationBuilder->set($data)->where('user_id', $id)->update();
    }
}