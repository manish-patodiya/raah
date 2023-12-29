<?php

namespace App\Controllers\Admin\Product;

use App\Controllers\Admin\AdminController;

class Categories extends AdminController
{
    public $categorymodel;
    public function __construct()
    {
        parent::__construct();
        check_access('categories');
        $this->categorymodel = model('CategoryModel');
    }

    public function index()
    {
        check_method_access('categories', 'view');
        $data = [
            'session' => $this->session,
        ];
        return view('admin/product/category/category_list', $data);
    }
    public function get_categories()
    {
        $categories_list = model('CategoryModel')->getAll();
        $data = ['categories_list' => $categories_list];
        $html = view('admin/product/category/category_list_view', $data);
        echo json_encode([
            'html' => $html,
            'list' => $categories_list,
        ]);
    }
    public function add()
    {
        check_method_access('categories', 'add');
        $image = $this->_upload_image();
        $data = array(
            "category_name" => format_name($this->request->getPost('category_name')),
            "image" => $image,
            "pid" => $this->request->getPost('parent_cat'),
        );
        $cate_id = $this->categorymodel->insertData($data);
        if ($cate_id) {
            echo json_encode([
                "status" => 1,
                "msg" => "Insert Successfully category ",
            ]);
        }
    }

    public function edit()
    {
        check_method_access('categories', 'edit');
        if ($this->request->getPost('submit')) {
            $id = $this->request->getPost('cate_id');
            $data = array(
                "category_name" => format_name($this->request->getPost('category_name')),
                "pid" => $this->request->getPost('parent_cat'),
            );

            if ($this->request->getFile('cat_image')) {
                $image = $this->_upload_image();
                $data["image"] = $image;
            }
            $category = $this->categorymodel->updateRow($data, "id=$id");
            if ($category) {
                echo json_encode([
                    "status" => 1,
                    "msg" => "updated Successfully category ",
                ]);
            }
        } else {
            $data['unit'] = $this->categorymodel->getAll_unit();
            return view('sub_modals/edit_category_modal', $data);
        }
    }

    private function _upload_image()
    {
        $img_file = $this->request->getFile('cat_image');

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

        //Return the image name
        return base_url(PRODUCT_IMG_PATH . $name);
    }

    public function deleted()
    {
        check_method_access('categories', 'delete');
        $id = $this->request->getPost('id');
        $this->categorymodel->deleteRow($id);
        echo json_encode([
            'status' => 1,
            'msg' => 'category was deleted successfully',
        ]);
    }
    public function get_categories_id()
    {
        $id = $this->request->getPost('id');
        $res = $this->categorymodel->get_category($id);

        if (!empty($res)) {
            json_response(1, 'Successfully Fetched', $res);
        } else {
            json_response(0, 'Category not found', $res);
        }
    }

    public function uploadCSV()
    {
        check_method_access('categories', 'add');
        $file = $this->request->getFile('csv');
        $type = $file->guessExtension();
        if ($file->isValid() && $type == "csv") {
            $rows = array_map('str_getcsv', file($file));
            $header = array_shift($rows);
            $csv = array();
            foreach ($rows as $row) {
                if ($row) {
                    $csv[] = array_combine($header, $row);
                }
            }
            $all = [];
            foreach ($csv as $value) {
                array_shift($value);
                array_push($all, $value);
            }
            foreach ($all as $key => $cate_name) {
                $data = array(
                    "category_name" => format_name(strtolower($cate_name['category'])),
                );
                $cate_id = $this->categorymodel->insertData($data);
            }
            if ($cate_id) {
                echo json_encode([
                    "status" => 1,
                    "msg" => "CSV import successfully",
                ]);
            }
        } else {
            echo json_encode([
                "status" => 0,
                "msg" => "Not a CSV file",
            ]);
        }
    }
}