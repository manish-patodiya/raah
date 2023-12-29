<?php
namespace App\Controllers\Admin\Product;

use App\Controllers\Admin\AdminController;

class ProductSettings extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->ProductModel = model('ProductModel');
    }

    public function index()
    {

        $data = [
            'session' => $this->session,
            'settings' => $this->ProductModel->get_product_settings(),
        ];
        return view('admin/product/settings', $data);
    }

    public function save_settings()
    {
        $arr = [];
        if ($this->request->getPost('cron_url')) {
            $arr['cron_url'] = "regex_match[/^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i]";
        }
        $arr = array_merge($arr, [
            'per_page_web' => 'required|is_natural',
            'per_page_mobile' => 'required|is_natural',
            'max_product_limit' => 'required|is_natural',
            'max_description_text_limit' => 'required|is_natural',
        ]);
        $check = $this->validate($arr, [
            'per_page_web' => [
                'is_natural' => 'Per Page (Website) Must be Greater than or equal to 0',
            ],
            'per_page_mobile' => [
                'is_natural' => 'Per Page (Mobile) Must be Greater than or equal to 0',
            ],
            'max_product_limit' => [
                'is_natural' => 'Max Product Limit Must be Greater than or equal to 0',
            ],
            'max_description_text_limit' => [
                'is_natural' => 'Max Description Text Limit Must be Greater than or equal to 0',
            ],
            'cron_url' => [
                'regex_match' => 'Not a valid cron URL',
            ],
        ]);

        if ($check) {
            if ($this->request->isAJAX()) {
                $post_data = $this->request->getPost();
                $data = [
                    'per_page_web' => $post_data['per_page_web'],
                    'per_page_mobile' => $post_data['per_page_mobile'],
                    'max_product_limit' => $post_data['max_product_limit'],
                    'max_description_text_limit' => $post_data['max_description_text_limit'],
                    'cron_url' => $post_data['cron_url'],
                ];
                $res = $this->ProductModel->set_product_settings($data);
                if ($res) {
                    echo json_encode([
                        'status' => 1,
                        'msg' => 'Update Successfully',
                    ]);
                } else {
                    echo json_encode([
                        'status' => 0,
                        'msg' => 'Something went wrong',
                    ]);
                }
            } else {
                die('Not a valid request');
            }
        } else {
            echo json_encode([
                'status' => 0,
                'msg' => 'Form validation Error',
                'errors' => $this->validation->getErrors(),
            ]);
        }
    }

}