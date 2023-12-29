<?php

namespace App\Controllers\Seller\Support;

use App\Controllers\Seller\SellerController;

class SupportTickets extends SellerController
{
    public $SupportModel;
    public function __construct()
    {

        check_seller_login();
        $this->SupportModel = model('SupportTicketModel');
    }
    public function index()
    {
        $data = [
            'session' => $this->session,
        ];
        return view('seller/support/support_list', $data);
    }

    public function support_list()
    {
        $support = $this->SupportModel->getSupportSeller();
        $arr = [];
        $i = 0;

        foreach ($support as $k => $v) {
            $class = '';
            // chnages label css for status names
            if ($v->status_id == 1) {
                $class = "badge-danger";
            } elseif ($v->status_id == 2) {
                $class = "badge-success";
            } elseif ($v->status_id == 3) {
                $class = "badge-warning";
            } elseif ($v->status_id == 4) {
                $class = "badge-danger bg-orange";
            }

            $label = '';
            $label .= '<label class="badge  ' . $class . '"  >' . $v->status_name . '</label>';

            //data formt
            $originalDate = $v->created_at;

            $action = '';

            $action .= '<a title="support ticket description " style="font-size: 1.2rem;" class="text-primary description me-1" href="#" support_id="' . $v->ticket_id . '"><i class="fa fa-eye"></i> </a>';
            $action .= '<a title="Delete" style="font-size: 1.2rem;" class="text-danger sup_delete me-1"  support_id="' . $v->ticket_id . '" href="#" title="Delete" > <i class="fa fa-trash-o"></i></a>';

            $action .= '<a title="Edit" style="font-size: 1.2rem;" class="text-warning sup_update me-1" href="#" support_id="' . $v->ticket_id . '" > <i class="fa fa-pencil-square-o"></i></a>';

            $arr[] = [
                $v->ticket_no,
                '<h5 class="m-0">' . $v->full_name . '</h5> <p>' . $v->email . '</p>',
                '<div style=" display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;
                    overflow: hidden;"><h6>' . $v->subject . '</h6></div> <div style=" display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
                    overflow: hidden;">' . $v->description . '</div>',
                '<h6 class="m-0">' . date('d M', strtotime($originalDate)) . '</h6>' . "<h4 class='m-0 text-primary'>" . date('Y', strtotime($originalDate)) . "</h4>",
                $label,
                $action,
            ];
        }

        echo json_encode([
            "status" => 1,
            "details" => $arr,
        ]);

    }

    public function add()
    {
        $data = array(
            'user_id' => $this->session->get('seller_info')['user_id'],
            "subject" => $this->request->getPost('subject'),
            "status_id" => 1,
            "description" => $this->request->getPost('descriptions'),
            'ticket_no' => unique_ticket_id(),
        );
        $support = $this->SupportModel->insertData($data);
        if ($support) {
            echo json_encode([
                "status" => 1,
                'msg' => 'inserted Successfully support ticket',
            ]);
        }
    }

    public function edit()
    {
        $support_id = $this->request->getPost('supprot_id');
        $data = array(
            "subject" => $this->request->getPost('subject'),
            "description" => $this->request->getPost('descriptions'),
        );
        $support = $this->SupportModel->updateRow($data, "ticket_id=$support_id");
        if ($support) {
            echo json_encode([
                "status" => 1,
                'msg' => 'Updated Successfully support ticket',
            ]);
        }
    }
    public function delete()
    {
        // check_method_access('support', 'delete');
        $ticket_id = $this->request->getPost('ticket_id');
        $res = $this->SupportModel->deleteRow($ticket_id);
        if ($res) {
            echo json_encode([
                "status" => 1,
                'msg' => 'Deleted Successfully support ticket',
            ]);
        }
    }

    public function get_support_id()
    {
        $ticket_id = $this->request->getPost('ticket_id');
        $data = $this->SupportModel->get_support_by_id($ticket_id);

        if (!empty($data)) {
            json_response(1, 'Successfully Fetched', $data);
        } else {
            json_response(0, 'Users not found', $data);
        }
    }

    public function get_support()
    {
        $support = $this->SupportModel;
        $id = $this->request->getPost('ticket_id');
        $data = $support->get_support_by_id($id);
        $originalDate = $data->created_at;
        $data->newdate = date("d M Y", strtotime($originalDate));

        if (!empty($data)) {
            echo json_encode([
                "status" => 1,
                "data" => $data,
            ]);
        } else {
            echo json_encode([
                "status" => 0,
                "data" => $data,
            ]);
        }
    }

}