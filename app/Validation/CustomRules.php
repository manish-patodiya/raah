<?php
namespace App\Validation;

class CustomRules
{
    // Rule is to validate mobile number digits
    public function isUniqueWithWhere($val, $tbl)
    {
        $params = explode(',', $tbl);
        $fparam = explode('.', $params[0]);

        $tbl_name = $fparam[0];
        $field = end($fparam);

        $db = db_connect();
        $builder = $db->table($tbl_name);
        $builder->where($field, $val);
        if (isset($params[1])) {
            $builder->where($params[1]);
        }
        $res = $builder->countAllResults();
        return !$res;
    }

    public function isPhoneVerified($val, $id)
    {
        $db = db_connect();
        $builder = $db->table('otp');
        $builder->where(['id' => $id, 'phone' => $val, 'is_verify' => 1]);
        $res = $builder->countAllResults();
        return $res;
    }
}