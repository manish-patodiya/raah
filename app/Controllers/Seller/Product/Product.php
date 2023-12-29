<?php

namespace App\Controllers\Seller\Product;

use App\Controllers\Seller\SellerController;

class Product extends SellerController
{
    public function __construct()
    {
        parent::__construct();
        $this->product_id = "";
        $this->categorymodel = model('CategoryModel');
        $this->ProductModel = model('ProductModel');
        $this->attributeModel = model('AttributeModel');
        $this->hsnmodel = model('HsnModel');
        $this->BrandModel = model('BrandModel');
    }

    public function datatable_json()
    {
        $limit = $this->request->getGet("length");
        $offset = $this->request->getGet("start");
        $filter = $this->request->getGet("search[value]");
        $totalRecords = $this->hsnmodel->getCount($filter);

        $details = $this->hsnmodel->getAll($limit, $offset, $filter);
        $arr = [];
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

    public function index()
    {
        $data = [
            'session' => $this->session,
            "category" => $this->categorymodel->getAll(),
            'brands' => $this->BrandModel->getAll(),
        ];
        // prd($data['brands']);
        return view('seller/product/product/add_product', $data);
    }

    //Function to create new product (Add product from seller)
    public function add()
    {
        $data = $this->request->getPost();

        //Validate form data. Using Form Validation of CI.
        //All validations are defined in config validation.php

        if (!$this->validation->run($data, 'product_validation')) {
            json_response(0, "Failed to add product", $this->validation->getErrors());
        }

        //Upload the catelog file
        if ($this->request->getFile('pdf')) {
            $cat_file = $this->_upload_pdf();
            $data["catalog_file"] = $cat_file;
        }

        $user_id = $this->session->seller_info['user_id'];
        $this->product_id = $this->ProductModel->createProduct($data, $user_id);

        //If product added
        if (!$this->product_id) {
            json_response(0, "Failed to add product", ["error" => "Something went wrong."]);
        }

        // Add product properties
        $this->_update_product_properties();

        //If everything goes success print success response
        json_response(1, "Success", [
            "product_id" => $this->product_id,
        ]);
    }

    private function _upload_image()
    {
        $img_file = $this->request->getFile('product_image');

        //Check if file is valid or not
        if (!$img_file->isValid()) {
            json_response(0, "Failed to upload image", ["error" => "Your uploaded image is not valid"]);
        }

        $name = $img_file->getRandomName();

        //Upload file and move to the image directory
        $res = $img_file->move(PRODUCT_IMG_FILE_PATH, $name);

        if (!$res) {
            json_response(0, "Failed to upload image", ["error" => "Something went wrong."]);
        }

        //Resize the image
        $this->_resize_image(PRODUCT_IMG_FILE_PATH, $name);

        //Return the image name
        return $name;
    }

    // This function is used to resize an image in multiple sizes
    private function _resize_image($path, $name)
    {
        try {
            foreach (IMAGE_SIZES as $key => $value) {
                $image = \Config\Services::image()
                    ->withFile($path . $name)
                    ->resize($key, $key, true, 'height')
                    ->save(PRODUCT_IMG_FILE_PATH . $value . '/' . $name);
            }
        } catch (\Exception $e) {
            json_response(0, "Something went wrong.");
        }
    }

    // This function is used to make a array for updating image url in database
    private function _make_img_array($img_name, $is_default = 0)
    {
        $img_data = [
            "product_id" => $this->product_id,
            "product_image" => base_url(PRODUCT_IMG_PATH . $img_name),
            "is_default" => $is_default,
            "type" => '',
        ];
        $id = $this->ProductModel->add_product_image($img_data);

        $data = [];
        foreach (IMAGE_SIZES as $key => $value) {
            $data[] = [
                "product_id" => $this->product_id,
                "pid" => $id,
                "product_image" => base_url(PRODUCT_IMG_PATH . "$value/" . $img_name),
                "is_default" => $is_default,
                "type" => $value,
            ];
        }
        return $data;
    }

    //This function is used to upload and update image for a product
    public function save_image()
    {
        $check = $this->validate([
            'product_image' => 'max_size[product_image,1024]|ext_in[product_image,png,jpg,jpeg]',
        ], [
            'product_image' => [
                'max_size' => 'Size of image should not greater than 1 MB',
                'ext_in' => 'File type must be in  jpg,jpeg,png',
            ],
        ]);

        if (!$check) {
            json_response(0, "Uploaded file is not valid", ["errors" => $this->validation->getErrors()]);
        }

        $img_name = $this->_upload_image();

        $this->product_id = $id = $this->request->getPost("product_id");

        // check product have any image or not
        $count = $this->ProductModel->count_product_images($this->product_id);

        //Images are ready to update in db now. Lets update in database
        $is_default = $count ? 0 : 1;

        $img_data = $this->_make_img_array($img_name, $is_default);

        if ($this->ProductModel->add_product_images($img_data)) {

            json_response(1, "Image added successfully");
        }
    }

    public function get_product_images()
    {
        $id = $this->request->getGet('prod_id');
        $res = $this->ProductModel->get_multiple_product_images($id, "200X200");
        json_response(1, 'Succesfully fetched', ['all_images' => $res]);
    }

    public function remove_product_image()
    {
        $img_id = $this->request->getGet('img_id');
        $res = $this->ProductModel->remove_product_image_by_id($img_id);
        if ($res) {
            json_response(1, "Image is removed successfully");
        } else {
            json_response(0, "Something went wrong");
        }
    }

    public function make_default_image()
    {
        $img_id = $this->request->getGet('img_id');
        $prod_id = $this->request->getGet('prod_id');
        $res = $this->ProductModel->make_default_image($img_id, $prod_id);
        if ($res) {
            json_response(1, "Successfully updated");
        } else {
            json_response(0, "Something went wrong");
        }
    }

    private function _update_product_properties($action = 'insert')
    {
        $category_id = $this->request->getPost('category_id');
        $labels = $this->request->getPost('label');
        $values = $this->request->getPost('value');

        if ($action == 'update') {
            $this->ProductModel->deleteProperites($this->product_id);
        }
        if (!$labels) {
            return false;
        }
        $data1 = [];
        foreach ($labels as $k => $label) {
            // $properties = [];
            // if (!is_numeric($label)) {
            //     if ($label) {
            //         $label_id = $this->attributeModel->insertData(['label' => ucwords($label)]);
            //         $properties['label_id'] = $label_id;
            //         $value_id = $this->attributeModel->insertLabelValue([
            //             'label_id' => $label_id,
            //             'value' => ucwords($values[$k]),
            //             'product_cat_id' => $category_id,
            //         ]);
            //         $properties['value_id'] = $value_id;
            //     }
            // } else {
            //     if (isset($values[$k]) && !is_numeric($values[$k])) {
            //         $value_id = $this->attributeModel->insertLabelValue([
            //             'label_id' => $label,
            //             'value' => ucwords($values[$k]),
            //             'product_cat_id' => $category_id,
            //         ]);
            //         $properties['label_id'] = $label;
            //         $properties['value_id'] = $value_id;
            //     } else {
            //         $properties = [
            //             'label_id' => $label,
            //             'value_id' => $values[$k],
            //         ];
            //     }
            // }
            // $properties = array_merge(['product_id' => $this->product_id], $properties);
            $data1[] = [
                'label_id' => $label,
                'value_id' => $values[$k],
                'product_id' => $this->product_id,
            ];
        }
        if (!empty($data1)) {
            $this->ProductModel->insertProperties($data1);
        }
    }

    private function _upload_pdf()
    {
        $logo = $this->request->getFile('pdf');
        $file_path = '';
        if ($logo->isValid()) {
            $upload_path = 'public/uploads/catalog_pdf/';
            $logo_name = $logo->getRandomName();
            $res = $logo->move($upload_path, $logo_name);
            if ($res) {
                $file_path = base_url($upload_path . $logo_name);
            }
        }
        return $file_path;
    }

    public function manage_products()
    {

        $category = $this->categorymodel->getAll();
        $data = [
            'session' => $this->session,
            'category' => $category,
        ];
        return view('seller/product/product/manage_product_list', $data);
    }

    public function manage_product_list()
    {
        $catid = $this->request->getGet('cid');
        $statusid = $this->request->getGet('sid');
        $outofstock = $this->request->getGet('stock');
        $user_id = $this->session->seller_info['user_id'];
        $man_pro = $this->ProductModel->getAll($catid, $statusid, $outofstock, $user_id);
        $arr = [];
        $i = 0;
        $label = '';
        foreach ($man_pro as $k => $v) {
            switch ($v->status) {
                case 1:
                    $label = "<label class='badge badge-warning-light'>Draft</label>";
                    break;
                case 2:
                    $label = "<label class='badge badge-success-light'>Published</label>";
                    break;
                case 3:
                    $label = "<label class='badge badge-info-light'>Pending</label>";
                    break;
                case 4:
                    $label = "<label class='badge badge-danger-light'>Rejected</label>";
                    break;
            }
            $product_img = '<img src="' . $v->product_image . '" style="width: 50px">';
            $hsn_details = '<div class="row"><span>' . $v->hsn_code . '</span></div><div class="row"><span>GST: ' . $v->gst_rate . '%</span></div>';
            $action = '<a title="Edit" class="text-warning sup_update me-1" href="' . base_url('seller/product/product/edit/' . $v->id) . '" style="font-size: 1.2rem;" > <i class="fa fa-pencil-square-o"></i></a><a title="Delete" class="text-danger sup_delete me-1"  uid="' . $v->id . '" href="#" title="Delete"  style="font-size: 1.2rem;"> <i class="fa fa-trash-o"></i></a>';
            $arr[] = [
                $product_img,
                '<h5>' . $v->title . '</h5> <p>' . $v->product_details . '</p>',
                $v->category_name,
                $label,
                $v->quantity,
                $hsn_details,
                $action,
            ];
        }
        echo json_encode([
            "status" => 1,
            "details" => $arr,
        ]);
    }

    public function edit($id)
    {
        if ($this->request->getPost('submit')) {
            $data = $this->request->getPost();
            $this->product_id = $data['pro_id'];

            //Validate form data. Using Form Validation of CI.
            //All validations are defined in config validation.php

            if (!$this->validation->run($data, 'product_validation')) {
                json_response(0, "Failed to update product", $this->validation->getErrors());
            }

            //Upload the catelog file
            if ($this->request->getFile('pdf')->isValid()) {
                $cat_file = $this->_upload_pdf();
                $data["catalog_file"] = $cat_file;
            }

            $user_id = $this->session->seller_info['user_id'];
            $res = $this->ProductModel->updateRow($data);

            //If product added
            if (!$res) {
                json_response(0, "Failed to add product", ["error" => "Something went wrong."]);
            }

            // Add product properties
            $this->_update_product_properties('update');

            //If everything goes success print success response
            json_response(1, "Successfully updated.", [
                "product_id" => $this->product_id,
            ]);
        } else {
            $edit_data = $this->ProductModel->get_product_by_id($id);
            $data['details'] = "";
            $data['hsn_code'] = '';
            if (isset($edit_data['hsn_code']) && $edit_data['hsn_code'] != "") {
                $hsn_details = $this->hsnmodel->get_hsn_detail($edit_data['hsn_code']);
                // prd($hsn_details);
                $data['details'] = $hsn_details['details'];
                $data['hsn_code'] = $hsn_details['hsn_code'];
            }
            $data['product'] = $edit_data;

            // make properties array with index of label id
            $meta = $this->ProductModel->get_properties_of_product($id);
            $properties = [];
            foreach ($meta as $val) {
                $properties[$val->label_id] = $val->value_id;
            }

            $data['properties'] = $properties;
            $data['category'] = $this->categorymodel->getAll();
            $data['session'] = $this->session;
            $data["brands"] = $this->BrandModel->getAll();
            return view('seller/product/product/edit_product', $data);
        }
    }

    public function delete()
    {
        // check_method_access('product', 'delete');
        $id = $this->request->getGet('id');
        $this->ProductModel->deleteRow($id);
        echo json_encode([
            'status' => 1,
            'msg' => 'Product was deleted successfully',
        ]);
    }

    public function get_products_by_id()
    {

        $pids = $this->request->getPost('product_ids');
        $product_info = [];
        if ($pids) {
            $id_arr = explode(',', $pids);
            $product_info['product'] = $this->ProductModel->get_products_by_id($id_arr);
            // $product_info['unit'] = $this->unitModel->getAll_base_unit();
        }
        json_response(1, 'Fetched successfully', $product_info);
    }

    public function bulk_upload()
    {
        $data = [
            'session' => $this->session,
        ];
        return view('seller/product/product/bulk_upload', $data);
    }

    public function upload_csv()
    {
        // validate form
        $check = $this->validate([
            'csv_content' => 'uploaded[csv_content]|ext_in[csv_content,csv]',
        ], [
            'csv_content' => [
                'ext_in' => 'Only CSV File is allowed',
            ],
        ]);

        // after valid form
        if ($check) {
            // check is a ajax request or not
            if ($this->request->isAJAX()) {
                // get file
                $file = $this->request->getFile('csv_content');

                // upload csv file and get file path
                $file_path = '';
                if ($file->isValid() && !$file->hasMoved()) {
                    $upload_path = 'public/uploads/product_csv/';
                    $file_name = $file->getRandomName();
                    $moved = $file->move($upload_path, $file_name);
                    if ($moved) {
                        $file_path = base_url($upload_path . $file_name);
                    }
                }

                // open uploaded file so that we can read it
                $open = fopen($file_path, 'r');

                // get header of csv file and make it like the field available in db
                $header = fgetcsv($open);
                foreach ($header as $k => $hv) {
                    $header[$k] = str_replace(' ', '_', trim(strtolower($hv)));
                }
                // add two created_at and updated_at fields in header
                $header = array_merge($header, ['created_at', 'updated_at']);

                // make the final data which we have to push with batch insert
                $data = [];
                while ($body = fgetcsv($open)) {
                    $body = array_merge($body, [date('Y-m-d'), date('Y-m-d')]);
                    $data[] = array_combine($header, $body);
                }
                $res = $this->ProductModel->insert_batch($data);

                if ($res) {
                    echo json_encode([
                        'status' => 1,
                        'msg' => 'Data inserted Successfully!',
                    ]);
                } else {
                    echo json_encode([
                        'status' => 0,
                        'msg' => 'Something Went Wrong',
                    ]);
                }
            }
        } else {
            echo json_encode([
                'status' => 0,
                'msg' => 'Form validation Error',
                'errors' => $this->validation->getErrors(),
            ]);
        }
    }

    public function get_properties()
    {
        $cat_id = $this->request->getGet('cat_id');
        $res = $this->ProductModel->get_properties($cat_id);
        $properties = [];
        foreach ($res as $val) {
            $properties[$val->label_id]['label_id'] = $val->label_id;
            $properties[$val->label_id]['label'] = $val->label;
            $properties[$val->label_id]['values'][$val->value_id] = $val->value;
        }
        json_response(1, "Successfull", ['properties' => $properties]);
    }

    public function get_values($id = '0')
    {
        $id = $this->request->getPost('cat_id');
        $label_id = $this->request->getPost('label_id');
        $values = $this->attributeModel->getValues($id, $label_id);
        echo json_encode([
            "status" => '1',
            'values' => $values,
        ]);
    }
}