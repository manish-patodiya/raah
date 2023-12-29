<?php
namespace App\Controllers\Seller\Product;

use App\Controllers\Seller\SellerController;

class Brands extends SellerController
{
    public function __construct()
    {
        parent::__construct();
        // check_access('brands');
        $this->brandmodel = model('BrandModel');
    }

    public function index()
    {
        // check_method_access('brands', 'view');
        $data = [
            'session' => $this->session,
        ];
        return view('seller/product/brands/manage_brands_list', $data);
    }

    public function datatable_json()
    {
        // check_method_access('brands', 'view');
        $limit = $this->request->getGet("length");
        $offset = $this->request->getGet("start");
        $filter = $this->request->getGet("search[value]");
        $totalRecords = $this->brandmodel->getCount($filter);
        $details = $this->brandmodel->getAll($filter, $limit, $offset);
        $arr = [];
        $i = $offset;
        foreach ($details as $k => $v) {
            $img_url = $v->logo != "" ? $v->logo : base_url('/public/uploads/image_found/no-image.jpg');
            $product_img = '<img src="' . $img_url . '" style="width: 50px">';
            $action = '<a title="Edit" style="font-size: 1.2rem;" class="text-warning sup_update me-1" href="' . base_url("/seller/product/brands/edit/" . $v->id) . '" brand_id="' . $v->id . '" > <i class="fa fa-pencil-square-o"></i></a><a title="Delete" style="font-size: 1.2rem;" class="text-danger brand_delete me-1"  brand_id="' . $v->id . '" href="#" title="Delete" data-bs-toggle="modal" data-bs-target="#modal-center" > <i class="fa fa-trash-o"></i></a>';
            $arr[] = [
                $product_img,
                $v->name,
                $v->description,
                $v->website_link,
                // $v->seo_title,
                // $v->seo_description,
                $action,
            ];
        }
        echo json_encode([
            "status" => 1,
            "iTotalDisplayRecords" => $totalRecords,
            "recordsTotal" => 0,
            "details" => $arr,
        ]);
    }

    private function _upload_logo()
    {
        $logo = $this->request->getFile('logo');
        if ($logo != "") {
            $file_path = '';
            if ($logo->isValid()) {
                $upload_path = 'public/uploads/brand_images/';
                $logo_name = $logo->getRandomName();
                $res = $logo->move($upload_path, $logo_name);
                if ($res) {
                    $file_path = base_url($upload_path . $logo_name);
                }
            }
            return $file_path;}

    }

    public function add()
    {
        // check_method_access('brands', 'add');
        $check = $this->validate([
            'name' => "required|min_length[2]",
        ], [
            'name' => [
                "required" => "Please enter your brand name",
                "min_length" => "Brand name cannot be less than 2 characters",
            ],
        ]);
        if ($this->request->getPost('name')) {
            $data = [
                "name" => format_name($this->request->getPost('name')),
                "logo" => $this->_upload_logo(),
                "description" => $this->request->getPost('description'),
                "status" => "1",
                "website_link" => $this->request->getPost('link'),
                "seo_title" => $this->request->getPost('seo_title'),
                "seo_description" => $this->request->getPost('seo_description'),
            ];
            $result = $this->brandmodel->insert_data($data);
            // prd($result);
            if ($result) {
                echo json_encode([
                    "status" => 1,
                    "msg" => "Brand details inserted successfully",
                ]);
            }
        } else {
            $data = [
                'session' => $this->session,
            ];
            return view('seller/product/brands/add_brands', $data);
        }
    }
    public function edit($id)
    {
        // check_method_access('brands', 'edit');
        $check = $this->validate([
            'name' => "required|min_length[2]",
        ], [
            'name' => [
                "required" => "Brand name cannot be empty",
                "min_length" => "Brand name cannot be less than 2 characters",
            ],
        ]);
        if ($this->request->getPost('name')) {
            $data = [
                "name" => format_name($this->request->getPost('name')),
                "description" => $this->request->getPost('description'),
                "status" => "1",
                "website_link" => $this->request->getPost('link'),
                "seo_title" => $this->request->getPost('seo_title'),
                "seo_description" => $this->request->getPost('seo_description'),
            ];
            if ($path = $this->_upload_logo()) {
                $data["logo"] = $path;
            }
            $result = $this->brandmodel->updateRow($data, $id);
            if ($result) {
                echo json_encode([
                    "status" => 1,
                    "msg" => "Brand details updated successfully",
                ]);
            }
        } else {
            $data = [
                'session' => $this->session,
                'brand_detail' => $this->brandmodel->get_product_by_id($id),
            ];
            return view('seller/product/brands/edit_brands', $data);
        }
    }
    public function deleted()
    {
        // check_method_access('brands', 'delete');
        $id = $this->request->getPost('id');
        $this->brandmodel->deleteRow($id);
        echo json_encode([
            'status' => 1,
            'msg' => 'Brand was deleted successfully',
        ]);
    }
}