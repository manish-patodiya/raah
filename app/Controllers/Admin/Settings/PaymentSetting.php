<?php
namespace App\Controllers\Admin\Settings;

use App\Controllers\Admin\AdminController;

class PaymentSetting extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->PaymentSettingModel = model('PaymentSettingModel');
    }
    public function index()
    {
        $data = [
            'session' => $this->session,
        ];
        $payment_result = $this->PaymentSettingModel->get();
        $data['active_payment'] = '';
        foreach ($payment_result as $v) {
            if ($v->is_active) {
                $data['active_payment'] = $v->payment_type;
            }
        }
        $data['paymentlist'] = $payment_result;
        return view('admin/settings/payment_settings/payment_gateway', $data);
    }

    public function save_razorpay_creds()
    {
        $this->validation->reset();
        $check = $this->validate([
            'razorpay_secretkey' => 'required',
            'razorpay_keyid' => 'required',
        ]);
        if ($check) {
            $post_data = $this->request->getPost();
            $data = [
                'api_secret_key' => $post_data['razorpay_secretkey'],
                'api_publishable_key' => $post_data['razorpay_keyid'],
                'payment_type' => 'razorpay',
            ];
            $this->PaymentSettingModel->add($data);
            json_response(1, "Update succesfully.");
        } else {
            echo json_encode([
                'status' => 0,
                'msg' => 'Not validate.',
                'erros' => $this->validation->getErrors(),
            ]);
        }
    }

    public function save_paytm_creds()
    {
        $this->validation->reset();
        $check = $this->validate([
            'paytm_merchantkey' => 'required',
            'paytm_merchantid' => 'required',
            'paytm_website' => 'required',
            'paytm_industrytype' => 'required',
        ]);
        if ($check) {
            $post_data = $this->request->getPost();
            $data = [
                'api_secret_key' => $post_data['paytm_merchantkey'],
                'api_publishable_key' => $post_data['paytm_merchantid'],
                'paytm_website' => $post_data['paytm_website'],
                'paytm_industrytype' => $post_data['paytm_industrytype'],
                'payment_type' => 'paytm',
            ];
            $this->PaymentSettingModel->add($data);
            json_response(1, "Update succesfully");
        } else {
            echo json_encode([
                'status' => 0,
                'msg' => 'Not validate.',
                'erros' => $this->validation->getErrors(),
            ]);
        }
    }

    public function check_details_availiblity()
    {
        $type = $this->request->getGet('payment_type');
        $res = $this->PaymentSettingModel->get_details($type);
        if (!empty($res)) {
            json_response(1, 'Fetched successfully.');
        } else {
            json_response(0, 'Not available.');
        }
    }

    public function update_gateway()
    {
        $type = $this->request->getGet('payment_type');
        $details = $this->PaymentSettingModel->get_details($type);

        if (!empty($details) || $type == 'none') {
            $res = $this->PaymentSettingModel->update_gateway($type);
            json_response(1, 'Update successfully.');
        } else {
            json_response(0, 'Please fill the payment details first.');
        }
    }

    public function remove_details()
    {
        $type = $this->request->getGet('payment_type');
        $data = [
            'api_secret_key' => '',
            'api_publishable_key' => '',
            'paytm_website' => '',
            'paytm_industrytype' => '',
            'is_active' => 0,
        ];
        $res = $this->PaymentSettingModel->delete_detail($type);
        json_response(1, 'Remove successfully');
    }
}