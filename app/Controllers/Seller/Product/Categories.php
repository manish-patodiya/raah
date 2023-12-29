<?php

namespace App\Controllers\Seller\Product;

use App\Controllers\Seller\SellerController;

class Categories extends SellerController
{
    public $categorymodel;
    public function __construct()
    {
        parent::__construct();
        // check_access('categories');
        $this->categorymodel = model('CategoryModel');
    }

    public function index()
    {
        // check_method_access('categories', 'view');
        $data = [
            'session' => $this->session,
        ];
        return view('seller/product/category/category_list', $data);
    }
    public function get_categories()
    {
        $categories_list = model('CategoryModel')->getAll();
        $data = ['categories_list' => $categories_list];
        $html = view('seller/product/category/category_list_view', $data);
        echo json_encode([
            'html' => $html,
            'list' => $categories_list,
        ]);
    }
    public function add()
    {

        // check_method_access('categories', 'add');
        $data = array(
            "category_name" => format_name($this->request->getPost('category_name')),
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
        // check_method_access('categories', 'edit');
        if ($this->request->getPost('submit')) {
            $id = $this->request->getPost('cate_id');
            $data = array(
                "category_name" => format_name($this->request->getPost('category_name')),
                "pid" => $this->request->getPost('parent_cat'),
            );
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
    public function deleted()
    {
        // check_method_access('categories', 'delete');
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
        // check_method_access('categories', 'add');
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
            $cate_id;
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