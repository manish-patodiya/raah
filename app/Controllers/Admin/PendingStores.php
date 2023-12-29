<?php
namespace App\Controllers\Admin;

use App\Controllers\Admin\AdminController;

class PendingStores extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->StoreModel = model('StoreModel');
    }

    public function index()
    {
        $data = [
            'session' => $this->session,
            'store_details' => $this->StoreModel->getAllStoreDetails(),
        ];
        return view('admin/pending_stores', $data);
    }

    public function datatable_json()
    {
        $details = $this->StoreModel->getAllStoreDetails();
        $i = 0;
        foreach ($details as $k => $v) {
            $actions = '<a title="View" style="font-size:1.2rem;" class="text-primary sup_view me-1" href="#" store_id=' . $v->id . '><i class="fa fa-eye"></i> </a>';
            $arr[] = [
                ++$i,
                $v->name,
                $v->gstin,
                $v->address,
                $v->status,
                $actions,
            ];
        }
        if ($arr) {
            echo json_encode([
                "status" => 1,
                "details" => $arr,
            ]);}
    }
    public function get_store_detail_by_store_id($id)
    {
        $details = $this->StoreModel->getStoreDetailById($id);
        // prd($details);
        echo json_encode([
            "status" => 1,
            "detail" => $details,
        ]);
    }
    public function change_store_status($id)
    {
        $data = [
            "status" => 1,
        ];
        $this->StoreModel->updateRow($data, $id);
        echo json_encode([
            "status" => 1,
            "msg" => "Store was permited successfully",
        ]);
    }
}