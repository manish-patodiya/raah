<?php
namespace App\Controllers\Admin\Orders;

use App\Controllers\Admin\AdminController;

class MyOrders extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        check_access('myorders');
        $this->ProfileModel = model('ProfileModel');
        $this->UserRolesModel = model('UserRolesModel');
        $this->OrderModel = model('OrderModel');
        $this->UserModel = model('UserModel');
    }

    public function index()
    {
        $data = [
            'session' => $this->session,
        ];
        return view('admin/orders/my_orders', $data);
    }
    public function orders_list()
    {
        check_method_access('myorders', 'view');
        $limit = $this->request->getGet("length");
        $offset = $this->request->getGet("start");
        $filter['search'] = $this->request->getGet("search[value]");
        $filter['is_seller'] = 1;
        $totalRecords = $this->UserModel->getCount($filter);
        $details = $this->OrderModel->getAllOrders();
        $arr = [];
        foreach ($details as $k => $v) {
            $label = '';
            switch ($v->status) {
                case 1:
                    $label .= "<label class='badge badge-danger'>Pending</label>";
                    break;
                case 2:
                    $label .= "<label class='badge badge-primary'>Suspended</label>";
                    break;
                case 3:
                    $label .= "<label class='badge badge-danger'>Not Verified</label>";
                    break;
            }
            $action = '';
            // if (check_method_access('sellers', 'view', true)) {
            //     $action .= '<a title="View" style="font-size: 1.2rem;" class="text-primary sup_view me-1" href="#" uid="' . $v->oid . '"><i class="fa fa-eye"></i> </a>';
            // }
            // if (check_method_access('sellers', 'edit', true)) {
            //     $action .= '<a title="Edit" style="font-size: 1.2rem;" class="text-warning sup_update me-1" href="#" uid="' . $v->oid . '" > <i class="fa fa-pencil-square-o"></i></a>';
            // }
            // if (check_method_access('sellers', 'delete', true)) {
            //     $action .= '<a title="Delete" style="font-size: 1.2rem;" class="text-danger sup_delete me-1"  uid="' . $v->oid . '" href="#" title="Delete"> <i class="fa fa-trash-o"></i></a>';
            // }
            $img = '<img src="' . $v->product_img . '" id="logo"class="logo" style="max-height:50px; max-width:50px;">';
            $arr[] = [
                $img,
                '<div style=" display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;
                    overflow: hidden;"><h6>' . $v->title . '</h6></div> <div style=" display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
                    overflow: hidden;">' . $v->product_details . '</div>',
                '<h5>' . $v->full_name . '</h5>' . '<span>' . $v->email . '<br>' . $v->phone . '<span>',
                $label,
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
}