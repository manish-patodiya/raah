<?php

namespace App\Controllers\Admin\Product;

use App\Controllers\Admin\AdminController;

class Product extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        check_access('product');
        $this->product_id = "";
        $this->categorymodel = model('CategoryModel');
        $this->productmodel = model('ProductModel');
        $this->unitModel = model('UnitModel');
        $this->attributeModel = model('AttributeModel');
        $this->hsnmodel = model('HsnModel');
        $this->notificationmodel = model('NotificationModel');

    }

    public function datatable_json()
    {
        check_method_access('product', 'view');
        $limit = $this->request->getGet("length");
        $offset = $this->request->getGet("start");
        $filter = $this->request->getGet("search[value]");
        $totalRecords = $this->hsnmodel->getCount($filter);

        $details = $this->hsnmodel->getAll($limit, $offset, $filter);
        // prd($details);
        $arr = [];
        // $i = $offset;
        foreach ($details as $k => $v) {
            $arr[] = [
                $v->hsn_code,
                $v->details,
                $v->gst_rate,
                '<button title="Select" class="delete btn btn-success btn-sm select_hsn" gst_rate="' . $v->gst_rate . '"  hsn_id="' . $v->id . '" details="' . $v->details . '" hsn_code="' . $v->hsn_code . '"href="#" data-bs-toggle="modal" data-bs-target="#modal-center" > Select</button>',

            ];
        }
        echo json_encode([
            "status" => 1,
            "iTotalDisplayRecords" => $totalRecords,
            "recordsTotal" => 0,
            "details" => $arr,
        ]);
    }

    public function manage_products()
    {
        check_method_access('product', 'view');

        $category = $this->categorymodel->getAll();
        $data = [
            'session' => $this->session,
            'category' => $category,
        ];
        return view('admin/product/product/manage_product_list', $data);
    }

    public function manage_product_list()
    {
        check_method_access('product', 'view');
        $catid = $this->request->getGet('cid');
        $statusid = $this->request->getGet('sid');
        $outofstock = $this->request->getGet('stock');
        $man_pro = $this->productmodel->getAllAdminProducts($catid, $statusid, $outofstock);
        // prd($man_pro);
        $arr = [];
        $i = 0;
        $label = '';
        $action = '';
        foreach ($man_pro as $k => $v) {
            switch ($v->status) {
                case 2:
                    $label = "<label class='badge badge-primary-light'>Pending</label>";
                    $action = '<a class="btn btn-sm btn-success status_btn mb-2" sid="3" pid="' . $v->id . '" uid="' . $v->user_id . '">Accept</a><a class="btn btn-sm btn-danger status_btn mb-2" sid="4" pid="' . $v->id . '" uid="' . $v->user_id . '">Reject</a>';
                    break;
                case 3:
                    $label = "<label class='badge badge-success-light'>Published</label>";
                    $action = '<a class="btn btn-sm btn-danger status_btn" sid="5" pid="' . $v->id . '" uid="' . $v->user_id . '">Disable</a>';
                    break;
                case 4:
                    $label = "<label class='badge badge-danger-light'>Rejected</label>";
                    $action = '';
                    break;
                case 5:
                    $label = "<label class='badge badge-warning-light'>Disable</label>";
                    $action = '<a class="btn btn-sm btn-success status_btn" sid="3" pid="' . $v->id . '" uid="' . $v->user_id . '">Enable</a>';
                    break;

            }
            $product_img = '<img src="' . $v->product_image . '" style="width: 50px">';
            $hsn_details = '<div class="row"><span>' . $v->hsn_code . '</span></div><div class="row"><span>GST: ' . $v->gst_rate . '%</span></div>';
            if (check_method_access('product', 'edit', true)) {
            }
            $arr[] = [
                $product_img,
                '<h5>' . $v->title . '</h5> <p>' . $v->product_details . '</p>',
                $v->category_name,
                $label,
                $hsn_details,
                $action,
            ];
        }
        echo json_encode([
            "status" => 1,
            "details" => $arr,
        ]);
    }
    public function change_status()
    {
        $data = [
            "status" => $this->request->getGet('sid'),
        ];
        $result = $this->productmodel->change_status($data, $this->request->getGet('pid'));
        $data = $this->request->getGet('data');
        $this->notificationmodel->add_user_notification($data[0]);
        if ($result) {
            // prd("rahul");
            echo json_encode([
                "status" => 1,
                "msg" => "Product status was changed successfully",
            ]);
        }
    }
}