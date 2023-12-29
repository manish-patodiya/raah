<?php

namespace App\Controllers\Admin\Settings;

use App\Controllers\Admin\AdminController;

class Hsn extends AdminController
{
    public $hsnmodel;

    public function __construct()
    {
        parent::__construct();
        check_access('hsn');
        $this->hsnmodel = model('HsnModel');
    }
    public function index()
    {
        check_method_access('hsn', 'view');
        $data = [
            'session' => $this->session,
        ];
        return view('admin/settings/hsn/hsn', $data);
    }
    public function datatable_json()
    {
        check_method_access('hsn', 'view');
        $limit = $this->request->getGet("length");
        $offset = $this->request->getGet("start");
        $filter = $this->request->getGet("search[value]");
        $totalRecords = $this->hsnmodel->getCount($filter);
        $details = $this->hsnmodel->getAll($limit, $offset, $filter);
        $arr = [];
        $i = $offset;
        foreach ($details as $k => $v) {
            $action = '';
            if (check_method_access('hsn', 'edit', true)) {
                $action .= '<a title="Edit" style="font-size: 1.2rem;" class="text-warning sup_update me-1" href="#" hsn_id="' . $v->id . '" > <i class="fa fa-pencil-square-o"></i></a>';
            }
            if (check_method_access('hsn', 'delete', true)) {
                $action .= '<a title="Delete" style="font-size: 1.2rem;" class="text-danger sup_delete me-1"  hsn_id="' . $v->id . '" href="#" title="Delete" data-bs-toggle="modal" data-bs-target="#modal-center" > <i class="fa fa-trash-o"></i></a>';
            }
            $arr[] = [
                ++$i,
                $v->hsn_code,
                $v->hsn_code_4_digits,
                $v->details,
                $v->gst_rate,
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
    public function add()
    {
        check_method_access('hsn', 'add');
        if ($this->request->getPost('submit')) {
            $data = array(
                "hsn_code" => $this->request->getPost('hsn_code'),
                "hsn_code_4_digits" => $this->request->getPost('hsn_code_4_digits'),
                "details" => $this->request->getPost('details'),
                "gst_rate" => $this->request->getPost('gst_rate'),
                "created_at" => date('Y-m-d : h:m:s'),
            );
            $inserted_id = $this->hsnmodel->insertData($data);
            if ($inserted_id) {
                echo json_encode([
                    "status" => 1,
                    "msg" => "Details inserted successfully",
                ]);
            }
        } else {
            $data = [
                'session' => $this->session,
            ];
            return view('admin/settings/hsn/add_hsn', $data);
        }

    }
    public function edit($id = '0')
    {
        check_method_access('hsn', 'edit');
        $id = $this->request->getPost('hsn_id');
        $data = array(
            "hsn_code" => $this->request->getPost('hsn_code'),
            "hsn_code_4_digits" => $this->request->getPost('hsn_code_4_digits'),
            "details" => $this->request->getPost('details'),
            "gst_rate" => $this->request->getPost('gst_rate'),
        );
        $updated_id = $this->hsnmodel->updateRow($data, "id=$id");
        if ($updated_id) {
            echo json_encode([
                "status" => 1,
                "msg" => "Details updated successfully",
            ]);
        }
    }

    public function delete_hsn()
    {
        check_method_access('hsn', 'delete');
        $id = $this->request->getPost('id');
        $this->hsnmodel->deleteRow($id);
        echo json_encode([
            'status' => 1,
            'msg' => 'Deleted successfully',
        ]);

    }

    public function getHSNCodes()
    {
        $search = $this->request->getGet('term');
        $res = $this->hsnmodel->getHSNCodes($search);
        if ($res) {
            json_response(1, 'Successful', $res);
        }
    }

    public function get_hsn_id()
    {
        $id = $this->request->getPost('id');
        $res = $this->hsnmodel->get_hsn_id($id);

        if (!empty($res)) {
            json_response(1, 'Successfully Fetched', $res);
        } else {
            json_response(0, 'Users not found', $res);
        }
    }

}
