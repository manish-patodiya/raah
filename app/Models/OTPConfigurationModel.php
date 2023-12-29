<?php
namespace App\Models;

use CodeIgniter\Model;

class OTPConfigurationModel extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
        $this->ConfigBuilder = $this->db->table('otp_configuration');
        $this->OTPBuilder = $this->db->table('otp');
    }

    public function set_otp_configuartion($data)
    {
        $res = $this->ConfigBuilder->countAllResults();
        if ($res) {
            return $this->ConfigBuilder->set($data)->update();
        } else {
            $this->ConfigBuilder->insert($data);
            return $this->db->insertID();
        }
    }

    public function get_otp_configuartion()
    {
        $res = $this->ConfigBuilder->get()->getRow();
        if ($res) {
            return $res;
        } else {
            $obj = new \stdClass;
            $obj->otp_limit = 500;
            $obj->time_limit = 59;
            return $obj;
        }
    }

    public function set_user_otp($post_data)
    {
        $data = [
            'phone' => $post_data['phone'],
            'otp' => generate_otp(),
            'time' => time(),
        ];
        if (!isset($post_data['rid']) || !$post_data['rid']) {
            $this->OTPBuilder->insert($data);
            return $this->db->insertID();
        } else {
            $id = decrypt_var($post_data['rid']);
            $this->OTPBuilder->set($data)->where('id', $id)->update();
            return $id;
        }
    }
    public function update_user_otp($data, $id)
    {
        return $this->OTPBuilder->set($data)->where('id', $uid)->update();
    }

    public function get_user_otp_count($uid)
    {
        $res = $this->OTPBuilder->select('otp_count')->where('user_id', $uid)->get()->getRow();
        if ($res) {
            return $res->otp_count;
        } else {
            return 0;
        }
    }

    public function verifyOTP($post_data)
    {
        // 0 = not match, 1 = matched, 2 = time expired
        $id = decrypt_var($post_data['row_id']);
        $phone = $post_data['phone'];
        $otp = $post_data['otp'];
        $res = $this->OTPBuilder->select('*')->where(['id' => $id, 'phone' => $phone])->get()->getRow();
        $time = (time() - $res->time);
        if ($time <= 300) {
            if ($res->otp == $otp) {
                $this->update_verification_flag($id);
                return 1;
            } else {
                return 0;
            }
        } else {
            return 2;
        }
    }

    private function update_verification_flag($id)
    {
        return $this->OTPBuilder->set(['is_verify' => 1])->where('id', $id)->update();
    }

}