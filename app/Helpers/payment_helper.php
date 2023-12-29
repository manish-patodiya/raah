<?php
function check_in_array($find, $array)
{
    if (!empty($array)) {

        foreach ($array as $element) {

            if ($find == $element->payment_type) {
                return $element;
            }
        }
    }
    $object = new stdClass();
    $object->id = "";
    $object->username = "";
    $object->api_secret_key = "";
    $object->salt = "";
    $object->api_publishable_key = "";
    $object->paytm_website = "";
    $object->paytm_industrytype = "";
    $object->api_password = "";
    $object->api_signature = "";
    $object->api_email = "";
    $object->paypal_demo = "";
    $object->account_no = "";
    $object->is_active = "";
    return $object;
}